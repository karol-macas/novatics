<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleados;
use Illuminate\Support\Facades\Hash;
use App\Models\Departamento;
use App\Models\Cargos;
use App\Models\Rubro;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EmpleadosController extends Controller
{
    public function index()
    {
        $empleados = Empleados::with('departamento')
            ->latest()
            ->paginate(10);
        return view('Empleados.indexEmpleados', compact('empleados'));
    }

    public function create()
    {
        $empleado = new Empleados();
        $departamentos = Departamento::with('supervisor')->get();
        $cargos = Cargos::all();
        $rubros = Rubro::all();
        return view('empleados.createEmpleados', compact('empleado', 'departamentos', 'cargos', 'rubros'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre1' => 'required|string|max:255',
            'apellido1' => 'required|string|max:255',
            'nombre2' => 'nullable|string|max:255',
            'apellido2' => 'nullable|string|max:255',
            'cedula' => 'required|string|max:10|unique:empleados',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'nullable|string|max:15',
            'celular' => 'required|string|max:15',
            'correo_institucional' => 'required|email|unique:empleados,correo_institucional',
            'departamento_id' => 'required|exists:departamentos,id',
            'curriculum' => 'nullable|file|mimes:pdf,doc,docx',
            'contrato' => 'nullable|file|mimes:pdf,jpg,png',
            'contrato_confidencialidad' => 'nullable|file|mimes:pdf,jpg,png',
            'contrato_consentimiento' => 'nullable|file|mimes:pdf,jpg,png',
            'fecha_ingreso' => 'required|date',
            'supervisor_id' => 'required|exists:supervisores,id',
            'cargo_id' => 'required|exists:cargos,id',
            'jornada_laboral' => 'required|string|max:255',
            'fecha_contratacion' => 'required|date',
            'fecha_conclusion_contrato' => 'nullable|date',
            'terminacion_contrato' => 'nullable|string|max:255',
            'fecha_recontratacion' => 'nullable|date',
            'rubros' => 'nullable|array',  // Asegúrate de que los rubros sean opcionales
            'rubros.*' => 'exists:rubros,id', // Validar que los rubros existan en la base de datos
            'monto' => 'nullable|array',  // Los montos asociados a los rubros
            'monto.*' => 'numeric',  // Asegúrate de que los montos sean números
        ]);



        $empleados = new Empleados($validated);

        // Crear el usuario asociado al empleado
        $user = User::create([
            'name' => $validated['nombre1'] . ' ' . $validated['apellido1'],
            'email' => $validated['correo_institucional'],
            'password' => Hash::make($validated['cedula']),
            'role' => 'empleado',
        ]);


        $empleados->user_id = $user->id;

        // Subir archivos al disco 'public'
        if ($request->hasFile('curriculum')) {
            $empleados->curriculum = $request->file('curriculum')->store('curriculums', 'public');
        }

        if ($request->hasFile('contrato')) {
            $empleados->contrato = $request->file('contrato')->store('contratos_empleados', 'public');
        }

        if ($request->hasFile('contrato_confidencialidad')) {
            $empleados->contrato_confidencialidad = $request->file('contrato_confidencialidad')->store('contratos_confidencialidad', 'public');
        }

        if ($request->hasFile('contrato_consentimiento')) {
            $empleados->contrato_consentimiento = $request->file('contrato_consentimiento')->store('contratos_consentimiento', 'public');
        }

        $empleados->save();

        $empleadoId = $empleados->id;
        $rubros = $request->input('rubros', []);
        $montos = $request->input('montos', []);

        // Asignar rubros con sus montos
        foreach ($rubros as $rubroId) {
            $monto = $montos[$rubroId] ?? 0; // Obtener el monto asociado al rubro o 0 si no existe

            // Guardar en la base de datos (tabla empleado_rubro)
            DB::table('empleado_rubro')->insert([
                'empleado_id' => $empleadoId,
                'rubro_id' => $rubroId,
                'monto' => $monto,
            ]);
        }


        return redirect()->route('empleados.indexEmpleados')->with('success', 'Empleado creado con éxito.');
    }

    public function getSupervisor($id)
    {
        $departamento = Departamento::with('supervisor')->find($id);
        return response()->json([
            'supervisor' => $departamento->supervisor ? $departamento->supervisor->nombre_supervisor : 'Sin asignar'
        ]);
    }


    public function show($id)
    {
        $empleados = Empleados::find($id);
        $empleados = Empleados::with('departamento')->findOrFail($id);
        $empleado = Empleados::with('rubros')->findOrFail($id);

        // Calcular los totales de ingresos y egresos
        $totalIngreso = 0;
        $totalEgreso = 0;

        foreach ($empleado->rubros as $rubro) {
            if ($rubro->tipo_rubro == 'ingreso') {
                $totalIngreso += $rubro->pivot->monto;  // Acceder al monto a través del campo 'pivot'
            } elseif ($rubro->tipo_rubro == 'egreso') {
                $totalEgreso += $rubro->pivot->monto;
            }
        }

        return view('Empleados.show',  compact('empleado', 'totalIngreso', 'totalEgreso'));
    }

    public function edit($id)
    {
        $empleados = Empleados::find($id);
        $departamentos = Departamento::all();
        $supervisores = Supervisor::all();
        $cargos = Cargos::all();
        $rubros = Rubro::all();
        return view('empleados.editEmpleados', compact('empleados', 'departamentos', 'supervisores', 'cargos', 'rubros'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre1' => 'required|string|max:255',
            'apellido1' => 'required|string|max:255',
            'nombre2' => 'nullable|string|max:255',
            'apellido2' => 'nullable|string|max:255',
            'cedula' => [
                'required',
                'string',
                'max:10',
                Rule::unique('empleados')->ignore($id),
            ],
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required|string|max:15',
            'celular' => 'required|string|max:15',
            'correo_institucional' => 'required|string|email|max:255|unique:empleados,correo_institucional,' . $id,
            'departamento_id' => 'required|exists:departamentos,id',
            'curriculum' => 'nullable|file|mimes:pdf,doc,docx',
            'contrato' => 'nullable|file|mimes:pdf,jpg,png',
            'contrato_confidencialidad' => 'nullable|file|mimes:pdf,jpg,png',
            'contrato_consentimiento' => 'nullable|file|mimes:pdf,jpg,png',
            'fecha_ingreso' => 'required|date',
            'cargo_id' => 'required|exists:cargos,id',
            'supervisor_id' => 'required|exists:supervisores,id',
            'jornada_laboral' => 'required|string|max:255',
            'fecha_contratacion' => 'required|date',
            'fecha_conclusion_contrato' => 'nullable|date',
            'terminacion_contrato' => 'nullable|string|max:255',
            'fecha_recontratacion' => 'nullable|date',
            'rubros' => 'nullable|array',
            'rubros.*' => 'exists:rubros,id',
            'monto_rubro' => 'nullable|array',
            'monto_rubro.*' => 'numeric',
        ]);

        $empleados = Empleados::findOrFail($id);
        $empleados->fill($validated);

        // Subir nuevos archivos y eliminar los antiguos si existen
        if ($request->hasFile('curriculum')) {
            if ($empleados->curriculum) {
                Storage::disk('public')->delete($empleados->curriculum);
            }
            $empleados->curriculum = $request->file('curriculum')->store('curriculums', 'public');
        }

        if ($request->hasFile('contrato')) {
            if ($empleados->contrato) {
                Storage::disk('public')->delete($empleados->contrato);
            }
            $empleados->contrato = $request->file('contrato')->store('contratos_empleados', 'public');
        }

        if ($request->hasFile('contrato_confidencialidad')) {
            if ($empleados->contrato_confidencialidad) {
                Storage::disk('public')->delete($empleados->contrato_confidencialidad);
            }
            $empleados->contrato_confidencialidad = $request->file('contrato_confidencialidad')->store('contratos_confidencialidad', 'public');
        }

        if ($request->hasFile('contrato_consentimiento')) {
            if ($empleados->contrato_consentimiento) {
                Storage::disk('public')->delete($empleados->contrato_consentimiento);
            }
            $empleados->contrato_consentimiento = $request->file('contrato_consentimiento')->store('contratos_consentimiento', 'public');
        }

        $empleados->save();

        // Asignar rubros con sus montos
        if ($request->filled('rubros') && $request->filled('monto_rubro')) {
            $rubros = $request->input('rubros');
            $montos = $request->input('monto_rubro');

            // Sincronizar los rubros con sus montos en la tabla pivote
            $empleados->rubros()->sync(
                collect($rubros)->mapWithKeys(function ($rubroId) use ($montos) {
                    return [$rubroId => ['monto' => $montos[$rubroId] ?? 0]]; // Valor predeterminado si no está presente
                })->toArray()
            );
        }


        return redirect()->route('empleados.indexEmpleados')->with('success', 'Empleado actualizado con éxito.');
    }

    public function getEmployeeDetails($id)
    {
        $empleado = Empleados::with('departamento', 'cargo', 'supervisor')->findOrFail($id);

        return response()->json([
            'departamento' => $empleado->departamento->nombre ?? 'N/A',
            'cargo' => $empleado->cargo->nombre_cargo ?? 'N/A',
            'supervisor' => $empleado->supervisor->nombre_supervisor ?? 'N/A',
        ]);
    }



    public function destroy($id)
    {
        $empleados = Empleados::findOrFail($id);

        // Eliminar los archivos asociados antes de eliminar el empleado
        if ($empleados->curriculum) {
            Storage::disk('public')->delete($empleados->curriculum);
        }

        if ($empleados->contrato) {
            Storage::disk('public')->delete($empleados->contrato);
        }

        if ($empleados->contrato_confidencialidad) {
            Storage::disk('public')->delete($empleados->contrato_confidencialidad);
        }

        if ($empleados->contrato_consentimiento) {
            Storage::disk('public')->delete($empleados->contrato_consentimiento);
        }

        $empleados->delete();

        return redirect()->route('empleados.indexEmpleados')->with('success', 'Empleado eliminado con éxito.');
    }
}

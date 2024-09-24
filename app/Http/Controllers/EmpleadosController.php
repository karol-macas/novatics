<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleados;
use Illuminate\Support\Facades\Hash;
use App\Models\Departamento;
use Illuminate\Validation\Rule;
use App\Models\User;

class EmpleadosController extends Controller
{
    public function index()
    {
        $empleados = Empleados::with('departamento')->get();
        return view('Empleados.indexEmpleados', compact('empleados'));
        // Asegúrate de crear esta vista
    }
    public function create()
    {

        $departamentos = Departamento::all();
        return view('empleados.createEmpleados', compact('departamentos'));
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
            'telefono' => 'required|string|max:15',
            'celular' => 'required|string|max:15',
            'correo_institucional' => 'required|email|unique:empleados,correo_institucional',
            'departamento_id' => 'required|exists:departamentos,id',
            'curriculum' => 'nullable|file|mimes:pdf,doc,docx',
            'contrato' => 'nullable|file|mimes:pdf,jpg,png',
            'contrato_confidencialidad' => 'nullable|file|mimes:pdf,jpg,png',
            'contrato_consentimiento' => 'nullable|file|mimes:pdf,jpg,png',
            'fecha_ingreso' => 'required|date',
        ]);

        $empleados = new Empleados($validated);

        //crear el usuario asociado al empleado
        $user = User::create([
            'name' => $validated['nombre1'] . ' ' . $validated['apellido1'],
            'email' => $validated['correo_institucional'],
            'password' => Hash::make($validated['cedula']),
            'role' => 'empleado',
        ]);

        $empleados->user_id = $user->id;

        if ($request->hasFile('curriculum')) {
            $empleados->curriculum = $request->file('curriculum')->store('curriculums');
        }

        if ($request->hasFile('contrato')) {
            $empleados->contrato = $request->file('contrato')->store('contratos_empleados');
        }

        if ($request->hasFile('contrato_confidencialidad')) {
            $empleados->contrato_confidencialidad = $request->file('contrato_confidencialidad')->store('contratos_confidencialidad');
        }

        if ($request->hasFile('contrato_consentimiento')) {
            $empleados->contrato_consentimiento = $request->file('contrato_consentimiento')->store('contratos_consentimiento');
        }

        $empleados->save();

        return redirect()->route('empleados.indexEmpleados')->with('success', 'Empleado creado con éxito.');
    }

    public function show($id)
    {
        $empleados = Empleados::with('departamento')->findOrFail($id);
        return view('Empleados.show', compact('empleados'));
    }

    public function edit($id)
    {
        $empleados = Empleados::findOrFail($id);
        $departamentos = Departamento::all();
        return view('empleados.editEmpleados', compact('empleados', 'departamentos'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre1' => 'required|string|max:255',
            'apellido1' => 'required|string|max:255',
            'nombre2' => 'required|string|max:255',
            'apellido2' => 'required|string|max:255',
            'cedula' => [
            'required',
            'string',
            'max:10',
            Rule::unique('empleados')->ignore($id),   ],// Excluye la cédula del registro
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'nullable|string|max:20',
            'celular' => 'required|string|max:20',
            'correo_institucional' => 'required|string|email|max:255|unique:empleados,correo_institucional,' . $id,
            'departamento_id' => 'required|exists:departamentos,id',
            'curriculum' => 'nullable|file|mimes:pdf,doc,docx',
            'contrato' => 'nullable|file|mimes:pdf,jpg,png',
            'contrato_confidencialidad' => 'nullable|file|mimes:pdf,jpg,png',
            'contrato_consentimiento' => 'nullable|file|mimes:pdf,jpg,png',
            'fecha_ingreso' => 'required|date',
        ]);

        $empleados = Empleados::findOrFail($id);
        $empleados->fill($validated);

        if ($request->hasFile('curriculum')) {
            $empleados->curriculum = $request->file('curriculum')->store('curriculums');
        }

        if ($request->hasFile('contrato')) {
            $empleados->contrato = $request->file('contrato')->store('contratos_empledos');
        }

        if ($request->hasFile('contrato_confidencialidad')) {
            $empleados->contrato_confidencialidad = $request->file('contrato_confidencialidad')->store('contratos_empleados');
        }

        if ($request->hasFile('contrato_consentimiento')) {
            $empleados->contrato_consentimiento = $request->file('contrato_consentimiento')->store('contratos_empleados');
        }


        $empleados->save();

        return redirect()->route('empleados.indexEmpleados')->with('success', 'Empleado actualizado con éxito.');
    }

    public function destroy($id)
    {
        $empleados = Empleados::findOrFail($id);
        $empleados->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado con éxito.');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Actividades;
use App\Models\Empleados;
use App\Models\Departamento;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;


class ActividadesController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener todas las actividades basadas en el rol del usuario
        $actividades = Actividades::with('empleado', 'cliente', 'departamento')
            ->when($user->isEmpleado(), function ($query) use ($user) {
                return $query->where('empleado_id', $user->empleado->id);
            })
            ->paginate(10);



        // Obtener la lista de empleados (solo si es necesario)
        $empleados = Empleados::all();

          // Filtrar actividades por empleado si se seleccionó uno el administrador


        return view('Actividades.indexActividades', compact('actividades', 'empleados'));
    }

    public function create()
    {
        $user = Auth::user();
        $empleados = Empleados::all();
        $departamentos = Departamento::all();
        $clientes = Cliente::all();

        return view('Actividades.createActividades', compact('empleados', 'departamentos', 'clientes'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Validación de los demás campos de la actividad
        $validated = $request->validate([
            'cliente_id' => 'nullable|string|max:255',
            'descripcion' => 'required|string|max:255',
            'codigo_osticket' => 'nullable|string|max:255',
            'semanal_diaria' => 'required|string|in:SEMANAL,DIARIO',
            'fecha_inicio' => 'required|date',
            'avance' => 'required|numeric|min:0|max:100',
            'observaciones' => 'nullable|string|max:255',
            'estado' => 'required|string|in:EN CURSO,FINALIZADO,PENDIENTE',
            'tiempo_estimado' => 'required|integer',
            'repetitivo' => 'required|boolean',
            'prioridad' => 'required|string|in:ALTA,MEDIA,BAJA',
            'departamento_id' => 'required|exists:departamentos,id',
            'error' => 'required|string|in:CLIENTE,SOFTWARE,MEJORA ERROR,DESARROLLO,OTRO',
        ]);

       
        // Crea la actividad
        $actividad = new Actividades();
        $actividad->empleado_id = $request->input('empleado_id'); 
        $actividad->descripcion = $request->input('descripcion');
        $actividad->codigo_osticket = $request->input('codigo_osticket');
        $actividad->semanal_diaria = $request->input('semanal_diaria');
        $actividad->fecha_inicio = $request->input('fecha_inicio');
        $actividad->avance = $request->input('avance');
        $actividad->observaciones = $request->input('observaciones');
        $actividad->estado = $request->input('estado');
        $actividad->tiempo_estimado = $request->input('tiempo_estimado');
        $actividad->repetitivo = $request->input('repetitivo');
        $actividad->prioridad = $request->input('prioridad');
        $actividad->departamento_id = $request->input('departamento_id');
        $actividad->error = $request->input('error');
        $actividad->save();


        return redirect()->route('actividades.indexActividades')->with('success', 'Actividad creada con éxito.');
    }

    public function show($id)
    {
        $actividades = Actividades::findOrFail($id);
        return view('Actividades.show', compact('actividades'));
    }

   

    public function edit($id)
    {
        $actividades = Actividades::findOrFail($id);
        $empleados = Empleados::all();
        $departamentos = Departamento::all();
        $clientes = Cliente::all();
        return view('Actividades.editActividades', compact('actividades', 'empleados', 'departamentos', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'cliente_id' => 'nullable|string|max:255',
            'empleado_id' => 'required|exists:empleados,id',
            'descripcion' => 'required|string|max:255',
            'codigo_osticket' => 'nullable|string|max:255',
            'semanal_diaria' => 'required|string|in:SEMANAL,DIARIO',
            'fecha_inicio' => 'required|date',
            'avance' => 'required|numeric|min:0|max:100',
            'observaciones' => 'nullable|string|max:255',
            'estado' => 'required|string|in:EN CURSO,FINALIZADO,PENDIENTE',
            'tiempo_estimado' => 'required|integer',
            'tiempo_real_horas' => 'nullable|integer',
            'tiempo_real_minutos' => 'nullable|integer',
            'fecha_fin' => 'nullable|date',
            'repetitivo' => 'required|boolean',
            'prioridad' => 'required|string|in:ALTA,MEDIA,BAJA',
            'departamento_id' => 'required|exists:departamentos,id',
            'error' => 'required|string|in:CLIENTE,SOFTWARE,MEJORA ERROR,DESARROLLO,OTRO',
        ]);

        $actividades = Actividades::findOrFail($id);
        $actividades->fill($validated);
        $actividades->save();

        return redirect()->route('actividades.indexActividades')->with('success', 'Actividad actualizada con éxito.');
    }

    public function updateAvance(Request $request, $id)
    {
        $validated = $request->validate([
            'avance' => 'required|numeric|min:0|max:100',
        ]);

        $actividad = Actividades::findOrFail($id);
        $actividad->avance = $validated['avance'];
        $actividad->save();

        return redirect()->route('actividades.indexActividades')->with('success', 'Avance actualizado con éxito.');
    }

    public function updateEstado(Request $request, $id)
    {
        $validated = $request->validate([
            'estado' => 'required|string|in:EN CURSO,FINALIZADO,PENDIENTE',
        ]);

        $actividad = Actividades::findOrFail($id);
        $actividad->estado = $validated['estado'];

        if ($actividad->estado === 'EN CURSO' && is_null($actividad->fecha_inicio)) {
            $actividad->fecha_inicio = now();
        }

        if ($actividad->estado === 'FINALIZADO') {
            $actividad->fecha_fin = now();

            if ($actividad->fecha_inicio) {
                $inicio = \Carbon\Carbon::parse($actividad->fecha_inicio)->setTimezone('America/Guayaquil');
                $fin = \Carbon\Carbon::now()->setTimezone('America/Guayaquil');

                $duracionMinutos = $fin->diffInMinutes($inicio);
                $horas = floor($duracionMinutos / 60);
                $minutos = $duracionMinutos % 60;

                $actividad->tiempo_real_horas = $horas;
                $actividad->tiempo_real_minutos = $minutos;

                Log::info("Tiempo real calculado: {$horas} horas, {$minutos} minutos.");
            } else {
                return redirect()->back()->withErrors('No se puede finalizar una actividad sin fecha de inicio.');
            }
        }

        $actividad->save();

        return redirect()->route('actividades.indexActividades')->with('success', 'Estado actualizado con éxito.');
    }

    public function updateTiempoEstimado(Request $request, $id)
    {
        $validated = $request->validate([
            'tiempo_estimado' => 'required|integer',
        ]);

        $actividad = Actividades::findOrFail($id);
        $actividad->tiempo_estimado = $validated['tiempo_estimado'];
        $actividad->save();

        return redirect()->route('actividades.indexActividades')->with('success', 'Tiempo estimado actualizado con éxito.');
    }

    public function destroy($id)
    {
        $actividad = Actividades::findOrFail($id);
        $actividad->delete();

        return redirect()->route('actividades.indexActividades')->with('success', 'Actividad eliminada con éxito.');
    }
}

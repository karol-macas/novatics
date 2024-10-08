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
        // Obtenemos el usuario autenticado
        $user = Auth::user();

        // Obtenemos la consulta base de actividades
        $query = Actividades::query();

        // Si el usuario es un empleado, solo debe ver sus propias actividades
        if ($user->isEmpleado()) {
            $query->where('empleado_id', $user->id);
        }
        // Si el usuario es administrador, puede ver todas las actividades o filtrar por un empleado específico
        elseif ($user->isAdmin()) {
            $empleado_id = $request->input('empleado_id');

            // Si el administrador selecciona un empleado específico, mostramos solo las actividades de ese empleado
            if ($empleado_id) {
                $query->where('empleado_id', $empleado_id);
            }
            // Si no se selecciona ningún empleado, mostramos todas las actividades
        }

        // Ordenar las actividades por fecha de creación más reciente
        $actividades = $query->orderBy('created_at', 'desc')->paginate(10);

        // Obtener todos los empleados si es admin (para poder filtrarlos en la vista)
        $empleados = $user->isAdmin() ? Empleados::all() : [];

        // Mostrar la vista con las actividades

        



        return view('actividades.indexActividades', compact('actividades', 'empleados'));
    }



    public function create()
    {
        $user = Auth::user();
        $empleados = Empleados::all();
        $departamentos = Departamento::all();
        $clientes = Cliente::all();

        // Establecer el ID del empleado si el usuario es un empleado
        $empleado_id = $user->isEmpleado() ? $user->id : null;

        return view('Actividades.createActividades', compact('empleados', 'departamentos', 'clientes', 'empleado_id'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Verifica si el usuario logueado es un empleado
        if ($user->isEmpleado()) {
            $empleado_id = $user->id; // ID del empleado logueado
        } else {
            $validated = $request->validate([
                'empleado_id' => 'required|exists:empleados,id',
            ]);
            $empleado_id = $validated['empleado_id'];
        }

        // Valida los demás campos de la actividad
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
        Actividades::create([
            'empleado_id' => $empleado_id, // Usar el ID del empleado logueado
            'descripcion' => $validated['descripcion'],
            'codigo_osticket' => $validated['codigo_osticket'],
            'semanal_diaria' => $validated['semanal_diaria'],
            'fecha_inicio' => $validated['fecha_inicio'],
            'avance' => $validated['avance'],
            'observaciones' => $validated['observaciones'],
            'estado' => $validated['estado'],
            'tiempo_estimado' => $validated['tiempo_estimado'],
            'repetitivo' => $validated['repetitivo'],
            'prioridad' => $validated['prioridad'],
            'departamento_id' => $validated['departamento_id'],
            'error' => $validated['error'],
        ]);

        return redirect()->route('actividades.indexActividades')->with('success', 'Actividad creada con éxito.');
    }

    public function show($id)
    {
        $actividades = Actividades::with('empleados', 'cliente')->findOrFail($id);

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

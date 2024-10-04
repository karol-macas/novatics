<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Actividades;
use App\Models\Empleados;
use App\Models\Departamento;
use App\Models\Cliente;


class ActividadesController extends Controller
{
    public function index()
    {
        $actividades = Actividades::with(['empleados', 'cliente', 'departamento'])->get();

        return view('Actividades.indexActividades', compact('actividades'));
    }

    public function create()
    {
        $empleados = Empleados::all();
        $departamentos = Departamento::all();
        $clientes = Cliente::all();
        return view('Actividades.createActividades', compact('empleados', 'departamentos', 'clientes'));
    }


    public function store(Request $request)
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


            'repetitivo' => 'required|boolean',
            'prioridad' => 'required|string|in:ALTA,MEDIA,BAJA',
            'departamento_id' => 'required|exists:departamentos,id',
            'error' => 'required|string|in:CLIENTE,SOFTWARE,MEJORA ERROR,DESARROLLO',
        ]);

        $validated['fecha_inicio'] = now();
        $actividades = new Actividades($validated);
        $actividades->save();

        return redirect()->route('actividades.indexActividades')->with('success', 'Actividad creada con éxito.');
    }

    public function show($id)
    {
        $actividades = Actividades::with('empleados')->findOrFail($id);

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
            'error' => 'required|string|in:CLIENTE,SOFTWARE,MEJORA ERROR,DESARROLLO',
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

        // Actualizar el estado
        $actividad->estado = $validated['estado'];

        // Si el estado es EN CURSO, asegurarse de que la fecha_inicio se registre
        if ($actividad->estado === 'EN CURSO' && is_null($actividad->fecha_inicio)) {
            $actividad->fecha_inicio = now(); // Solo se asigna si no tiene una fecha de inicio previa
        }

        // Si el estado es FINALIZADO, actualizar la fecha_fin y calcular el tiempo real
        if ($actividad->estado === 'FINALIZADO') {
            $actividad->fecha_fin = now(); // Establecer la fecha de finalización

            // Calcular el tiempo real solo si hay una fecha de inicio válida
            if ($actividad->fecha_inicio) {
                $inicio = \Carbon\Carbon::parse($actividad->fecha_inicio)->setTimezone('America/Guayaquil');
                $fin = \Carbon\Carbon::now()->setTimezone('America/Guayaquil');

                // Calcular la duración en minutos
                $duracionMinutos = $fin->diffInMinutes($inicio);

                // Convertir a horas y minutos
                $horas = floor($duracionMinutos / 60);
                $minutos = $duracionMinutos % 60;

                // Guardar el tiempo real en horas y minutos
                $actividad->tiempo_real_horas = $horas;
                $actividad->tiempo_real_minutos = $minutos;

                // Registrar información para depuración
                Log::info("Tiempo real calculado: {$horas} horas, {$minutos} minutos.");
            } else {
                // Manejar error o establecer valores por defecto si no hay fecha_inicio
                return redirect()->back()->withErrors('No se puede finalizar una actividad sin fecha de inicio.');
            }
        }

        // Guardar los cambios
        $actividad->save();

        return redirect()->route('actividades.indexActividades')->with('success', 'Estado actualizado con éxito.');
    }



    public function destroy($id)
    {
        $actividades = Actividades::findOrFail($id);
        $actividades->delete();

        return redirect()->route('actividades.indexActividades')->with('success', 'Actividad eliminada con éxito.');
    }
}

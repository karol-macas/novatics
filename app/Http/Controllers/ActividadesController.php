<?php

namespace App\Http\Controllers;

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
            'cliente_id' => 'required|string|max:255',
            'empleado_id' => 'required|exists:empleados,id',
            'descripcion' => 'required|string|max:255',
            'codigo_osticket' => 'required|string|max:255',
            'semanal_diaria' => 'required|string|in:SEMANAL,DIARIO',
            'fecha_inicio' => 'required|date',
            'avance' => 'required|numeric|min:0|max:100',
            'observaciones' => 'nullable|string|max:255',
            'estado' => 'required|string|in:EN CURSO,FINALIZADO,PENDIENTE',
            'tiempo' => 'required|integer',
            'fecha_fin' => 'required|date',
            'repetitivo' => 'required|boolean',
            'prioridad' => 'required|string|in:ALTA,MEDIA,BAJA',
            'departamento_id' => 'required|exists:departamentos,id',
            'error' => 'required|string|in:CLIENTE,SOFTWARE,MEJORA ERROR,DESARROLLO',
        ]);

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
            'cliente_id' => 'required|string|max:255',
            'empleado_id' => 'required|exists:empleados,id',
            'descripcion' => 'required|string|max:255',
            'codigo_osticket' => 'required|string|max:255',
            'semanal_diaria' => 'required|string|in:SEMANAL,DIARIO',
            'fecha_inicio' => 'required|date',
            'avance' => 'required|numeric|min:0|max:100',
            'observaciones' => 'nullable|string|max:255',
            'estado' => 'required|string|in:EN CURSO,FINALIZADO,PENDIENTE',
            'tiempo' => 'required|integer',
            'fecha_fin' => 'required|date',
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



    public function destroy($id)
    {
        $actividades = Actividades::findOrFail($id);
        $actividades->delete();

        return redirect()->route('actividades.indexActividades')->with('success', 'Actividad eliminada con éxito.');
    }
}

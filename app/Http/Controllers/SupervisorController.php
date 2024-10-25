<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supervisor;
use App\Models\Empleados;

class SupervisorController extends Controller
{
    public function index()
    {
        $supervisores = Supervisor::all();
        return view('supervisores.index', compact('supervisores'));
    }

    public function create()
    {
        $empleados = Empleados::all(); // Asegúrate de que este modelo esté importado
        return view('supervisores.create', compact('empleados'));
        
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_supervisor' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ]);

        $supervisor = new Supervisor($validated);
        $supervisor->save();

        return redirect()->route('supervisores.index')->with('success', 'Supervisor creado con éxito.');
    }

    public function show($id)
    {
        $supervisor = Supervisor::findOrFail($id);
        return view('supervisores.show', compact('supervisor'));
    }

    public function edit($id)
    {
        $supervisor = Supervisor::findOrFail($id);
        return view('supervisores.edit', compact('supervisor'));
    }

    public function update(Request $request, $id)
    {
        $supervisor = Supervisor::findOrFail($id);

        $validated = $request->validate([
            'nombre_supervisor' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ]);

        $supervisor->fill($validated);
        $supervisor->save();

        return redirect()->route('supervisores.index')->with('success', 'Supervisor actualizado con éxito.');
    }

    public function destroy($id)
    {
        $supervisor = Supervisor::findOrFail($id);
        $supervisor->delete();

        return redirect()->route('supervisores.index')->with('success', 'Supervisor eliminado con éxito.');
    }
}

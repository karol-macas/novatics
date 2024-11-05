<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Supervisor;


class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all();
        return view('departamentos.index', compact('departamentos'));
    }


    public function create()
    {
        $supervisores = Supervisor::all();
        return view('departamentos.create', compact('supervisores'));
    }

    public function getSupervisor($id)
{
    $departamento = Departamento::with('supervisor')->find($id);
    return response()->json([
        'supervisor' => $departamento->supervisor ? $departamento->supervisor->nombre_supervisor : 'Sin asignar'
    ]);
}


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'supervisor_id' => 'nullable|exists:supervisores,id',
        ]);

        Departamento::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'supervisor_id' => $request->supervisor_id,
        ]);

        return redirect()->route('departamentos.index')->with('success', 'Departamento creado con éxito.');
    }

    public function show($id)
    {
        $departamento = Departamento::with('cargos')->findOrFail($id);
        return view('departamentos.show', compact('departamento'));
    }

    public function edit($id)
    {
        $departamento = Departamento::findOrFail($id);
        return view('departamentos.edit', compact('departamento'));
    }

    public function update(Request $request, $id)
    {
        $departamento = Departamento::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'supervisor_id' => 'nullable|exists:supervisores,id',
            'id_cargo' => 'required|numeric',
        ]);

        $departamento->fill($validated);
        $departamento->save();

        return redirect()->route('departamentos.index')->with('success', 'Departamento actualizado con éxito.');
    }

    public function destroy($id)
    {
        $departamento = Departamento::findOrFail($id);
        $departamento->delete();

        return redirect()->route('departamentos.index')->with('success', 'Departamento eliminado con éxito.');
    }
}

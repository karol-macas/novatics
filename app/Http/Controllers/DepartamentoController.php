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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'supervisor_id' => 'required|numeric',
        ]);
    
        
        $departamento = new Departamento($validated);
        $departamento->save();
    
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
            'id_supervisor' => 'required|numeric',
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

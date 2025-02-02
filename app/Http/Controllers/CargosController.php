<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargos;
use App\Models\Departamento;

class CargosController extends Controller
{
    public function index()
    {
        $cargos = Cargos::all();
        return view('cargos.index', compact('cargos'));
    }

    public function create()
    {
        $departamentos = Departamento::all();
        return view('cargos.create', compact('departamentos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_cargo' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255', // Cambiado a nullable si es opcional
            'codigo_afiliacion' => 'required|string|max:255',
            'salario_basico' => 'required|numeric',
            'departamento_id' => 'required|exists:departamentos,id', // Validación para el departamento
        ]);

        $cargo = new Cargos($validated);
        $cargo->save();

        return redirect()->route('cargos.index')->with('success', 'Cargo creado con éxito.');
    }

    public function show($id)
    {
        $cargo = Cargos::findOrFail($id);
        return view('cargos.show', compact('cargo'));
    }

    public function edit($id)
    {
        $cargo = Cargos::findOrFail($id);
        $departamentos = Departamento::all(); // Asegúrate de pasar los departamentos
        return view('cargos.edit', compact('cargo', 'departamentos'));
    }

    public function update(Request $request, $id)
    {
        $cargo = Cargos::findOrFail($id);

        $validated = $request->validate([
            'nombre_cargo' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'codigo_afiliacion' => 'required|string|max:255',
            'salario_basico' => 'required|numeric',
            'departamento_id' => 'required|exists:departamentos,id', // Añadido departamento_id
        ]);

        $cargo->fill($validated);
        $cargo->save();

        return redirect()->route('cargos.index')->with('success', 'Cargo actualizado con éxito.');
    }

    public function destroy($id)
    {
        $cargo = Cargos::findOrFail($id);
        $cargo->delete();

        return redirect()->route('cargos.index')->with('success', 'Cargo eliminado con éxito.');
    }
}

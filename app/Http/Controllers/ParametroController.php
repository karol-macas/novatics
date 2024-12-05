<?php

namespace App\Http\Controllers;

use App\Models\Parametro;
use App\Models\Departamento;
use Illuminate\Http\Request;

class ParametroController extends Controller
{
    public function index()
    {
        $parametros = Parametro::all();
        $departamentos = Departamento::all();
        return view('parametros.index', compact('parametros'));
    }

    public function create()
    {
        $departamentos = Departamento::all();
        return view('parametros.create ', compact('departamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:parametros,nombre',
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        $parametro = new Parametro($request->all());
        $parametro->save();

        return redirect()->route('parametros.index')->with('success', 'Parámetro creado correctamente.');
    }

    public function edit(Parametro $parametro)
    {
        $departamentos = Departamento::all();
        return view('parametros.edit', compact('parametro', 'departamentos'));
    }

    public function update(Request $request, Parametro $parametro)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:parametros,nombre,' . $parametro->id,
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        $parametro->update($request->all());

        return redirect()->route('parametros.index')->with('success', 'Parámetro actualizado correctamente.');
    }

    public function destroy(Parametro $parametro)
    {
        $parametro->delete();

        return redirect()->route('parametros.index')->with('success', 'Parámetro eliminado.');
    }
}

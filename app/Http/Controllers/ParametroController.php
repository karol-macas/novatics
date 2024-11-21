<?php

namespace App\Http\Controllers;

use App\Models\Parametro;
use Illuminate\Http\Request;

class ParametroController extends Controller
{
    public function index()
    {
        $parametros = Parametro::all();
        return view('parametros.index', compact('parametros'));
    }

    public function create()
    {
        return view('parametros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:parametros,nombre',
        ]);

        $parametro = new Parametro($request->all());
        $parametro->save();

        return redirect()->route('parametros.index')->with('success', 'Parámetro creado correctamente.');
    }

    public function edit(Parametro $parametro)
    {
        return view('parametros.edit', compact('parametro'));
    }

    public function update(Request $request, Parametro $parametro)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:parametros,nombre,' . $parametro->id,
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

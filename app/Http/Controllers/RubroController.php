<?php

namespace App\Http\Controllers;

use App\Models\Rubro;
use Illuminate\Http\Request;

class RubroController extends Controller
{
    public function index()
    {
        $rubros = Rubro::paginate(10); // Muestra 10 registros por página
        return view('rubros.index', compact('rubros'));
    }
    

    public function create()
    {
        return view('rubros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tipo_rubro' => 'required|in:ingreso,egreso',
        ]);

        Rubro::create($request->all());

        return redirect()->route('rubros.index')->with('success', 'Rubro creado exitosamente');
    }

    public function show(Rubro $rubro)
    {
        return view('rubros.show', compact('rubro'));
    }

    public function edit(Rubro $rubro)
    {
        return view('rubros.edit', compact('rubro'));
    }

    public function update(Request $request, Rubro $rubro)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tipo_rubro' => 'required|in:ingreso,egreso',
        ]);

        $rubro->update($request->all());

        return redirect()->route('rubros.index')->with('success', 'Rubro actualizado exitosamente');
    }

    public function destroy(Rubro $rubro)
    {
        $rubro->delete();
        return redirect()->route('rubros.index')->with('success', 'Rubro eliminado exitosamente');
    }
}

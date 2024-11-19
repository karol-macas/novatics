<?php

namespace App\Http\Controllers;

use App\Models\MatrizCumplimiento;
use Illuminate\Http\Request;

class MatrizCumplimientoController extends Controller
{
    public function index()
    {
        $cumplimientos = MatrizCumplimiento::with('empleado', 'cargo', 'supervisor')->get();
        return view('matriz_cumplimientos.index', compact('cumplimientos'));
    }

    public function create()
    {
        // Aquí puedes pasar listas de empleados, cargos y supervisores para el formulario
        return view('matriz_cumplimientos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'parametro' => 'required|string|max:255',
            'puntos' => 'required|integer|min:0',
            'empleado_id' => 'required|exists:empleados,id',
            'cargo_id' => 'required|exists:cargos,id',
            'supervisor_id' => 'required|exists:supervisores,id',
        ]);

        MatrizCumplimiento::create($request->all());

        return redirect()->route('matriz_cumplimientos.index')->with('success', 'Cumplimiento registrado correctamente.');
    }

    public function update(Request $request, MatrizCumplimiento $cumplimiento)
    {
        $request->validate([
            'puntos' => 'required|integer|min:' . $cumplimiento->puntos, // No puede disminuir
        ]);

        $cumplimiento->update($request->only('puntos'));

        return redirect()->route('matriz_cumplimientos.index')->with('success', 'Puntos actualizados correctamente.');
    }

    public function destroy(MatrizCumplimiento $cumplimiento)
    {
        $cumplimiento->delete();

        return redirect()->route('matriz_cumplimientos.index')->with('success', 'Registro eliminado.');
    }
}

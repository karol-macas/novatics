<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\MatrizCumplimiento;
use App\Models\Parametro;
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
        $parametros = Parametro::all();
        $empleado = Empleados::with('supervisor')->findOrFail($empleadoId);
        return view('matriz_cumplimientos.create', compact('parametros', 'empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'parametro_id' => 'required|exists:parametros,id',
            'puntos' => 'required|integer|min:0',
            'empleado_id' => 'required|exists:empleados,id',
            'cargo_id' => 'required|exists:cargos,id',
            'supervisor_id' => 'required|exists:supervisores,id',
        ]);

        // Verificar que el supervisor asignado sea el correcto
        $empleado = Empleados::findOrFail($request->empleado_id);
        if ($empleado->id_supervisor != $request->supervisor_id) {
            return back()->withErrors(['supervisor_id' => 'El supervisor asignado no coincide con el empleado.']);
        }

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

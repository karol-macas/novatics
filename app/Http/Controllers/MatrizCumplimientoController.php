<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\MatrizCumplimiento;
use App\Models\Parametro;
use App\Models\Departamento;
use App\Models\Cargos;
use App\Models\Supervisor;
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
        $empleados = Empleados::all();
        $cargos = Cargos::all();
        $supervisores = Supervisor::all();
        return view('matriz_cumplimientos.create', compact('parametros', 'empleados', 'cargos', 'supervisores'));
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

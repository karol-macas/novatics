<?php

namespace App\Http\Controllers;


use App\Models\Empleados;
use App\Models\RolPago;
use App\Models\Rubro;
use Illuminate\Http\Request;

class RolPagoController extends Controller
{
    public function index(Request $request)
    {
        $rolesPago = RolPago::with('empleado', 'rubros')
            ->when($request->search, function ($query) use ($request) {
                return $query->whereHas('empleado', function ($query) use ($request) {
                    $query->where('nombre', 'like', '%' . $request->search . '%');
                });
            })
            ->paginate(10);  // Usar paginate si necesitas paginación

        return view('roles_pago.index', compact('rolesPago'));
    }


    public function create()
    {
        $rubros = Rubro::all();
        $empleados = Empleados::all();
        return view('roles_pago.create', compact('rubros', 'empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'rubros' => 'required|array',
            'rubros.*' => 'exists:rubros,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'total_ingreso' => 'required|numeric',
            'total_egreso' => 'required|numeric',
            'salario_neto' => 'required|numeric',
        ]);

        $rolPago = new RolPago();
        $rolPago->empleado_id = $request->empleado_id;
        $rolPago->fecha_inicio = $request->fecha_inicio;
        $rolPago->fecha_fin = $request->fecha_fin;
        $rolPago->total_ingreso = $request->total_ingreso;
        $rolPago->total_egreso = $request->total_egreso;
        $rolPago->salario_neto = $request->salario_neto;
        $rolPago->save();

        // Sincronizar rubros
        $rolPago->rubros()->sync($request->rubros);

        return redirect()->route('roles_pago.index')->with('success', 'Rol de pago creado con éxito.');
    }


    public function show(RolPago $rolPago)
    {
        return view('roles_pago.show', compact('rolPago'));
    }

    public function edit(RolPago $rolPago)
    {
        $empleados = Empleados::all();
        return view('roles_pago.edit', compact('rolPago', 'empleados'));
    }

    public function update(Request $request, RolPago $rolPago)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        $rolPago->update($request->only('empleado_id', 'fecha_inicio', 'fecha_fin'));

        // Recalcular los totales de ingreso y egreso
        $rolPago->calcularTotales();

        return redirect()->route('roles_pago.index')->with('success', 'Rol de pago actualizado exitosamente');
    }

    public function destroy(RolPago $rolPago)
    {
        $rolPago->delete();
        return redirect()->route('roles_pago.index')->with('success', 'Rol de pago eliminado exitosamente');
    }
}

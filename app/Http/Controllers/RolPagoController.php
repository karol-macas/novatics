<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Empleados;
use App\Models\RolPago;
use Illuminate\Http\Request;

class RolPagoController extends Controller
{
    public function index()
    {
        $rolesPago = RolPago::with('empleado')->get();
        return view('roles_pago.index', compact('rolesPago'));
    }

    public function create()
    {
        $empleados = Empleados::all();
        return view('roles_pago.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        $rolPago = RolPago::create([
            'empleado_id' => $request->empleado_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        // Calcular los totales de ingreso y egreso y actualizar salario neto
        $rolPago->calcularTotales();

        return redirect()->route('roles_pago.index')->with('success', 'Rol de pago creado exitosamente');
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
<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('producto')
        ->latest()
        ->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('clientes.createCliente', compact('productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_producto' => 'required|exists:productos,id',
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'contacto' => 'nullable|string|max:255',
            'orden_trabajo' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'contrato_mantenimiento_licencia' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'documento_otros' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'precio' => 'required|numeric',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $cliente = new Cliente($validated);

        /*crear el usuario asociado al cliente
        $user = User::create([
            'name' => $validated['nombre'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['telefono']),
            'role' => 'cliente',
        ]);*/

        //$cliente->user_id = $user->id;

        if ($request->hasFile('orden_trabajo')) {
            $cliente->orden_trabajo = $request->file('orden_trabajo')->store('contratos_orden_trabajo', 'public');
        }

        if ($request->hasFile('contrato_mantenimiento_licencia')) {
            $cliente->contrato_mantenimiento_licencia = $request->file('contrato_mantenimiento_licencia')->store('contratos_mantenimiento_licencia', 'public');
        }

        if ($request->hasFile('documento_otros')) {
            $cliente->documento_otros = $request->file('documento_otros')->store('documentos_otros', 'public');
        }

        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente creado con éxito.');
    }

    public function show($id)
    {
        $cliente = Cliente::with('producto')->findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        $productos = Producto::all();
        return view('clientes.edit', compact('cliente', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_producto' => 'required|exists:productos,id',
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'contacto' => 'nullable|string|max:255',
            'precio' => 'required|numeric',
            'orden_trabajo' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'contrato_mantenimiento_licencia' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'documento_otros' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->fill($validated);

        // Subir archivos al disco 'public' y eliminar los anteriores

        if ($request->hasFile('orden_trabajo')) {
            if ($cliente->orden_trabajo) {
                Storage::disk('public')->delete($cliente->orden_trabajo);
            }
            $cliente->orden_trabajo = $request->file('orden_trabajo')->store('contratos_orden_trabajo', 'public');
        }

        if ($request->hasFile('contrato_mantenimiento_licencia')) {
            if ($cliente->contrato_mantenimiento_licencia) {
                Storage::disk('public')->delete($cliente->contrato_mantenimiento_licencia);
            }
            $cliente->contrato_mantenimiento_licencia = $request->file('contrato_mantenimiento_licencia')->store('contratos_mantenimiento_licencia', 'public');
        }

        if ($request->hasFile('documento_otros')) {
            if ($cliente->documento_otros) {
                Storage::disk('public')->delete($cliente->documento_otros);
            }
            $cliente->documento_otros = $request->file('documento_otros')->store('documentos_otros', 'public');
        }

        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado con éxito.');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        //Eliminar los archivos asociados antes de eliminar el cliente

        if ($cliente->orden_trabajo) {
            Storage::disk('public')->delete($cliente->orden_trabajo);
        }

        if ($cliente->contrato_mantenimiento) {
            Storage::disk('public')->delete($cliente->contrato_mantenimiento);
        }

        if ($cliente->documento_otros) {
            Storage::disk('public')->delete($cliente->documento_otros);
        }
        
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado con éxito.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Producto;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('producto')->get();
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
            'contacto' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'contrato' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $cliente = new Cliente($validated);

        //crear el usuario asociado al cliente
        $user = User::create([
            'name' => $validated['nombre'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['telefono']),
            'role' => 'cliente',
        ]);

        $cliente->user_id = $user->id;

        if ($request->hasFile('contrato')) {
            $cliente->contrato = $request->file('contrato')->store('contratos_clientes');
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
            'contrato' => 'nullable|file|mimes:pdf,doc,docx',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($validated);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado con éxito.');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado con éxito.');
    }
}

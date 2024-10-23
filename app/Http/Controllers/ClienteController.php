<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('productos')->latest()->paginate(10);
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
            'productos' => 'required|array',
            'productos.*' => 'exists:productos,id',
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'contacto' => 'nullable|string|max:255',
            'contrato_implementacion' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'convenio_datos' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'documento_otros.*' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'precio' => 'required|numeric',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $cliente = new Cliente($validated);

        if ($request->hasFile('contrato_implementacion')) {
            $cliente->contrato_implementacion = $request->file('contrato_implementacion')->store('contratos_implementacion', 'public');
        }

        if ($request->hasFile('convenio_datos')) {
            $cliente->convenio_datos = $request->file('convenio_datos')->store('convenios_datos', 'public');
        }

        if ($request->hasFile('documento_otros')) {
            $rutas = [];
            foreach ($request->file('documento_otros') as $file) {
                $rutas[] = $file->store('documentos_otros', 'public');
            }
            $cliente->documento_otros = json_encode($rutas);
        }

        $cliente->save();
        $cliente->productos()->attach($validated['productos']);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado con éxito.');
    }
    public function show($id)
    {
        $cliente = Cliente::with('productos')->findOrFail($id);  

        // Decodificar los documentos
        $documentos = json_decode($cliente->documento_otros, true) ?? [];

        // Generar URLs para los documentos
        $urls = array_map(fn($doc) => asset('storage/' . $doc), $documentos);

        return view('clientes.show', compact('cliente', 'urls'));
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
            'productos' => 'required|array',
            'productos.*' => 'exists:productos,id',
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'contacto' => 'nullable|string|max:255',
            'precio' => 'required|numeric',
            'contrato_implementacion.*' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'convenio_datos.*' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'documento_otros.*' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->fill($validated);

        // Subir archivos y eliminar los anteriores
        if ($request->hasFile('contrato_implementacion')) {
            if ($cliente->contrato_implementacion) {
                Storage::disk('public')->delete($cliente->contrato_implementacion);
            }
            $cliente->contrato_implementacion = $request->file('contrato_implementacion')->store('contratos_implementacion', 'public');
        }

        if ($request->hasFile('convenio_datos')) {
            if ($cliente->convenio_datos) {
                Storage::disk('public')->delete($cliente->convenio_datos);
            }
            $cliente->convenio_datos = $request->file('convenio_datos')->store('convenios_datos', 'public');
        }

        if ($request->hasFile('documento_otros')) {
            // Eliminar archivos anteriores si existen
            if ($cliente->documento_otros) {
                $documentosAnteriores = json_decode($cliente->documento_otros, true);
                foreach ($documentosAnteriores as $doc) {
                    Storage::disk('public')->delete($doc);
                }
            }
            $rutas = [];
            foreach ($request->file('documento_otros') as $file) {
                $rutas[] = $file->store('documentos_otros', 'public');
            }
            $cliente->documento_otros = json_encode($rutas);
        }

        $cliente->save();
        $cliente->productos()->sync($validated['productos']); // Actualiza los productos

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado con éxito.');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        // Eliminar archivos asociados antes de eliminar el cliente
        if ($cliente->contrato_implementacion) {
            Storage::disk('public')->delete($cliente->contrato_implementacion);
        }

        if ($cliente->convenio_datos) {
            Storage::disk('public')->delete($cliente->convenio_datos);
        }

        if ($cliente->documento_otros) {
            $documentosAnteriores = json_decode($cliente->documento_otros, true);
            foreach ($documentosAnteriores as $doc) {
                Storage::disk('public')->delete($doc);
            }
        }

        $cliente->delete(); // Eliminar cliente

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado con éxito.');
    }
}

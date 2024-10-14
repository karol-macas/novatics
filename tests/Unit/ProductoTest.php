<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_producto()
    {
        $producto = Producto::create([
            'nombre' => 'Producto X',
            'descripcion' => 'Descripción del producto X',
        ]);

        $this->assertDatabaseHas('productos', ['nombre' => 'Producto X']);
    }

    public function test_producto_tiene_clientes()
    {
        $producto = Producto::create([
            'nombre' => 'Producto Y',
            'descripcion' => 'Descripción del producto Y',
        ]);

        $cliente = Cliente::create([
            'nombre' => 'Cliente ABC',
            'email' => 'cliente@abc.com',
        ]);

        // Añadiendo un cliente al producto
        $producto->clientes()->attach($cliente->id);

        // Verificar la relación
        $this->assertTrue($producto->clientes->contains($cliente));
    }
}

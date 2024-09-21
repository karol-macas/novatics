<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpleadosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DepartamentoController;

Route::resource('empleados', EmpleadosController::class)->names([
    'index' => 'empleados.indexEmpleados',
]);

Route::resource('actividades', ActividadesController::class)->names([
    'index' => 'actividades.indexActividades',
    'store' => 'actividades.store',
    'show' => 'actividades.show',
    'edit' => 'actividades.edit',
    'update' => 'actividades.update',
    'destroy' => 'actividades.destroy',
]);

Route::resource('productos', ProductoController::class)->names([
    'index' => 'productos.index',
    'store' => 'productos.store',
    'show' => 'productos.show',
    'edit' => 'productos.edit',
    'update' => 'productos.update',
    'destroy' => 'productos.destroy',
]);

Route::resource('clientes', ClienteController::class)->names([
    'index' => 'clientes.index',
    'store' => 'clientes.store',
    'show' => 'clientes.show',
    'edit' => 'clientes.edit',
    'update' => 'clientes.update',
    'destroy' => 'clientes.destroy',
]);

Route::resource('departamentos', DepartamentoController::class)->names([
    'index' => 'departamentos.index',
    'store' => 'departamentos.store',
    'show' => 'departamentos.show',
    'edit' => 'departamentos.edit',
    'update' => 'departamentos.update',
    'destroy' => 'departamentos.destroy',
]);

// Ruta para el home
Route::get('/', [AuthController::class, 'index'])->name('home');
Route::post('/custom-login', [AuthController::class, 'login'])->name('custom-login');
Route::get('/logados', [AuthController::class, 'logados'])->name('logados');
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Auth::routes();

// Ruta para el home después de autenticación
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

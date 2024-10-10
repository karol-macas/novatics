<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpleadosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DepartamentoController;
use Illuminate\Support\Facades\Auth;

// Ruta de Bienvenida para todos 
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas de autenticación
Auth::routes(['register' => false]);  // Desactiva el registro si no lo necesitas

// Redirigir a la vista de bienvenida si alguien intenta acceder al login
Route::get('/login', function () {
    return redirect()->route('welcome'); 
})->name('login');

// Redirigir a la vista de bienvenida si alguien intenta acceder al registro
Route::get('/register', function () {
    return redirect()->route('welcome'); 
})->name('register');

// Ruta de cierre de sesión
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    
    // Rutas comunes para administradores
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('empleados', EmpleadosController::class)->names([
            'index' => 'empleados.indexEmpleados',
            'store' => 'empleados.store',
            'show' => 'empleados.show',
            'edit' => 'empleados.edit',
            'update' => 'empleados.update',
            'destroy' => 'empleados.destroy',
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
    });

    // Rutas que solo puede acceder un empleado
    Route::middleware(['role:empleado'])->group(function () {

        //Ruta para ver el home
        Route::get('/home', [AuthController::class, 'home'])->name('home');

        Route::resource('actividades', ActividadesController::class)->names([
            'index' => 'actividades.indexActividades',
            'store' => 'actividades.store',
            'show' => 'actividades.show',
            'update' => 'actividades.update',


        ]);

        Route::put('actividades/{id}/avance', [ActividadesController::class, 'updateAvance'])->name('actividades.updateAvance');
       //Ruta de update de estado 
        Route::put('actividades/{id}/estado', [ActividadesController::class, 'updateEstado'])->name('actividades.updateEstado');

        
    });
});





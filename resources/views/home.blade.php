{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <div class="row">
                            @if (Auth::user()->isAdmin())
                                <!-- Dashboard para Admin-->
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('empleados.indexEmpleados') }}">
                                                <img src="{{ asset('images/rrhh.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">RRHH</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('empleados.indexEmpleados') }}">
                                                <img src="{{ asset('images/activos.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Activos</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('actividades.indexActividades') }}">
                                                <img src="{{ asset('images/actividades.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Actividades</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('clientes.index') }}">
                                                <img src="{{ asset('images/clientes.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Clientes</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('empleados.indexEmpleados') }}">
                                                <img src="{{ asset('images/clientes.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Empleados</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('departamentos.index') }}">
                                                <img src="{{ asset('images/rrhh.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Departamentos</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('empleados.indexEmpleados') }}">
                                                <img src="{{ asset('images/cobros.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Cobros</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('empleados.indexEmpleados') }}">
                                                <img src="{{ asset('images/mensajeria.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Mensajería</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('productos.index') }}">
                                                <img src="{{ asset('images/productos.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Productos</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('empleados.indexEmpleados') }}">
                                                <img src="{{ asset('images/seguridad.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Seguridades</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('empleados.indexEmpleados') }}">
                                                <img src="{{ asset('images/ventas.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Ventas</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('empleados.indexEmpleados') }}">
                                                <img src="{{ asset('images/rrhh.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Usuarios</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('empleados.indexEmpleados') }}">
                                                <img src="{{ asset('images/inteligencia-de-negocios.png') }}"
                                                    alt="Empleados" style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Inteligencia de Negocios</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @elseif (Auth::user()->isEmpleado())
                                <!-- Dashboard para Empleado-->
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <a href="{{ route('actividades.indexActividades') }}">
                                                <img src="{{ asset('images/actividades.png') }}" alt="Empleados"
                                                    style="width: 50px; height: 50px;">
                                                <h5 class="card-title">Actividades</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

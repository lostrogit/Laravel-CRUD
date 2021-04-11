@extends('layouts.app')

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
                    <h5 class="card-title"><strong>Nombre: </strong>{{ Auth::user()->name }}</h5>
                    <h5 class="card-title"><strong>Cédula: </strong>{{ Auth::user()->cedula }}</h5>
                    <h5 class="card-title"><strong>Email: </strong>{{ Auth::user()->email }}</h5>
                    <h5 class="card-title"><strong>Fecha de Nacimiento: </strong>{{ date('d/m/Y', strtotime(Auth::user()->fecha_nacimiento)) }}</h5>
                    <h5 class="card-title"><strong>Ciudad: </strong>{{ Auth::user()->obtenerCiudad->name }}</h5>
                    <h5 class="card-title"><strong>Celular: </strong>{{ Auth::user()->celular }}</h5>
{{--                    {{ __('You are logged in!') }}--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

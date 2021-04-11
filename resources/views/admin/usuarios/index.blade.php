@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="/usuarios">{{ __('Users') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Index') }}</li>
                </ol>
            </nav>

            @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                 {{ $message }}
            </div>
            @endif

            <nav class="navbar navbar-expand-sm " style="background-color: #dee2e6">
                <form class="form-inline" action="{{ route('usuarios.search') }}" method="POST">
                @csrf
                    <input name="query" class="form-control mr-sm-2" type="text" placeholder="Buscar usuario">
                    <button class="btn btn-success" type="submit">Buscar</button>
                </form>
            </nav>

            <!-- comienza tabla de usuarios -->
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                        <th>@sortablelink('name', 'NOMBRE')</th>
                        <th>@sortablelink('cedula', 'CÉDULA')</th>
                        <th>@sortablelink('email', 'EMAIL')</th>
                        <th>@sortablelink('fecha_nacimiento', 'EDAD')</th>
                        <th>@sortablelink('celular', 'NÚMERO CELULAR')</th>
                        <th>@sortablelink('ciudad', 'CIUDAD')</th>
                        <th>ACCIONES</th>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{$row->name }}</td>
                            <td>{{$row->cedula }}</td>
                            <td>{{$row->email }}</td>
                            <td>{{$row->obtenerEdad() }}</td>
                            <td>{{$row->celular }}</td>
                            <td>{{$row->obtenerCiudad->name }}</td>
                            <td width="20%">
                                <form action="{{ route('usuarios.destroy', $row->id)}}" method="post">
                                    @csrf @method('DELETE')
                                    <a href="{{ route('usuarios.edit', $row->id)}}" class="btn btn-secondary">Editar</a>
                                    <button onclick="return confirm('Seguro desea eliminar este usuario?')" class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

            <!-- finaliza tabla de usuarios -->
        </div>
    </div>

</div>

@endsection

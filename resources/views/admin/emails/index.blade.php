@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="/emails">{{ __('Emails') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Index') }}</li>
                </ol>
            </nav>

            @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                 {{ $message }}
            </div>
            @endif

            <nav class="navbar navbar-expand-sm " style="background-color: #dee2e6">
                <form class="form-inline" action="{{ route('emails.search') }}" method="POST">
                @csrf
                    <input name="query" class="form-control mr-sm-2" type="text" placeholder="Buscar emails">
                    <button class="btn btn-success" type="submit">Buscar</button>
                </form>
                <a href="{{ route('emails.create')}}" class="btn btn-primary ml-2">Nuevo</a>
            </nav>

            <!-- start -->
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                        <th>@sortablelink('asunto', 'ASUNTO')</th>
                        <th>@sortablelink('destinatario', 'DESTINATARIO')</th>
                        <th>@sortablelink('mensaje', 'MENSAJE')</th>
                        <th>@sortablelink('estado', 'ESTADO')</th>
                        <th>ACCIONES</th>
                    </thead>

                    <tbody>
                        @foreach($data as $row)
                        <tr >

                            <td>{{$row->asunto }}</td>
                            <td>{{$row->destinatario }}</td>
                            <td>{{$row->mensaje }}</td>
                            <td>{{$row->obtenerEstado() }}</td>
                            <td width="20%">
                                <form action="{{ route('emails.destroy', $row->id)}}" method="post">
                                    @csrf @method('DELETE')
                                    <a href="{{ route('emails.show', $row->id)}}" class="btn btn-primary">Ver</a>
                                    {{--                                    <a href="{{ route('emails.edit', $row->id)}}" class="btn btn-secondary">Edit</a>--}}
                                    <button onclick="return confirm('Seguro desea eliminar este mail?')" class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

            {{ $data->links() }}

            <!-- end -->
        </div>
    </div>

</div>

@endsection

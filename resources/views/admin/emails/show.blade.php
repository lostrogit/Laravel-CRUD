@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="/emails">{{ __('Emails') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Show') }}</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header" style="background-color: #dee2e6"><h2>{{ $data->asunto }}</h2></div>
                <div class="card-header" style="background-color: #eaeaea">

                <dl class="row col-md-6">
                    <dt class="col-sm-3">Destinatario: </dt>
                    <dd class="col-sm-9"> {{ $data->destinatario }}</dd>
                    <dt class="col-sm-3">Mensaje: </dt>
                    <dd class="col-sm-9">  {{ $data->mensaje }} seconds</dd>

                    <dt class="col-sm-3">Estado: </dt>
                    <dd class="col-sm-9">  {{ $data->obtenerEstado() }}</dd>

                </dl>
                </div>

                <div class="card-body">


                    <div class="form-group row mb-0 mt-2">

                            <a href="{{ route('emails.index')}}" class="btn btn-dark ml-2">	&laquo; Atras</a>

                    </div>

                </div>



            </div>
        </div>
    </div>
</div>
@endsection

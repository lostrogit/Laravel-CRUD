@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="/usuarios">{{ __('Users') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header" style="background-color: #dee2e6">{{ __('Edit') }}</div>

                <div class="card-body">

                    <form action="{{ route('usuarios.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }} *</label>

                            <div class="col-md-6">
                                <input id="name" value="{{ $data['name'] }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} *</label>

                            <div class="col-md-6">
                                <input id="email" value="{{ $data['email'] }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" readonly autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cédula') }} *</label>

                            <div class="col-md-6">
                                <input id="cedula" value="{{ $data['cedula'] }}" name="cedula" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula') }}" readonly autocomplete="cedula" autofocus>

                                @error('cedula')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fecha_nacimiento" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de nacimiento') }} *</label>

                            <div class="col-md-6">
                                <input id="fecha_nacimiento" value="{{ $data->obtenerFechaFormateada() }}" type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required autocomplete="Fecha de nacimiento" autofocus>

                                @error('fecha_nacimiento')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pais" class="col-md-4 col-form-label text-md-right">{{ __('País') }} {{$data->obtenerCiudad->obtenerEstado->obtenerPais->id}}</label>
                            <div class="col-md-6">
                                <select  id="pais" name="pais" class="form-control">
                                    <option value="">Selecciona un País</option>
                                    @foreach ($paises as $pais)
                                        <option
                                            @if( old('pais') == $pais->id || $data->obtenerCiudad->obtenerEstado->obtenerPais->id == $pais->id ) {{ 'selected' }}  @endif
                                            value="{{$pais->id}}">{{$pais->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }} </label>
                            <div class="col-md-6">
                                <select id="estado" name="estado" class="form-control"></select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ciudad" class="col-md-4 col-form-label text-md-right">{{ __('Ciudad') }} </label>
                            <div class="col-md-6">
                                <select id="ciudad" name="ciudad" class="form-control"></select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                <p id="passwordHelpBlock" class="form-text text-muted">
                                    Su contraseña debe tener mínimo 8 caracteres, un número, una letra mayúscula, y un caracter especial.
                                </p>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="celular" class="col-md-4 col-form-label text-md-right">{{ __('Número Celular') }}</label>

                            <div class="col-md-6">
                                <input id="celular" value="{{ $data['celular'] }}" type="text" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{ old('celular') }}" autocomplete="celular" autofocus>

                                @error('celular')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('usuarios.index')}}" class="btn btn-dark ml-2">	&laquo; Atras</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Actualizar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Ajax de consulta de estados y ciudades en base a la seleccion inicial
    $(document).ready(function () {
        if ($('#pais').val() !== ""){

            var idCountry = $('#pais').val();
            obtenerEstados(idCountry, true);

            var idState = JSON.parse("{{ json_encode($data->obtenerCiudad->obtenerEstado->id) }}");
            obtenerCiudades(idState, true);
            $("#ciudad").val(JSON.parse("{{ json_encode($data->obtenerCiudad->id) }}"));
        }

        // Si cambia el país, se consulta los estados relacionados al nuevo pais
        $('#pais').on('change', function () {
            var idCountry = this.value;
            obtenerEstados(idCountry, false);
        });
        // Si cambia el estado, se consulta las ciudades relacionados al nuevo estado
        $('#estado').on('change', function () {
            var idState = this.value;
            obtenerCiudades(idState, false);
        });

        function obtenerEstados(idCountry, selected) {
            $("#estado").html('');
            $.ajax({
                url: "{{url('api/obtener-estados')}}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#estado').html('<option value="">Selecciona un estado</option>');
                    $.each(result.estados, function (key, value) {
                        $("#estado").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#ciudad').html('<option value="">Selecciona una Ciudad</option>');
                    if(selected){
                        $('#estado').val(JSON.parse("{{ json_encode($data->obtenerCiudad->obtenerEstado->id) }}"));
                    }
                }
            });
        }

        function obtenerCiudades(idState, selected) {
            $("#ciudad").html('');
            $.ajax({
                url: "{{url('api/obtener-ciudades')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#ciudad').html('<option value="">Selecciona una Ciudad</option>');
                    $.each(res.ciudades, function (key, value) {
                        $("#ciudad").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    if(selected){
                        $('#ciudad').val(JSON.parse("{{ json_encode($data->obtenerCiudad->id) }}"));
                    }
                }
            });
        }
    });

</script>
@endsection

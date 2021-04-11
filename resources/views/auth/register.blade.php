@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }} *</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                    <input id="cedula" name="cedula" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula') }}" required autocomplete="cedula" autofocus>

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
                                    <input id="fecha_nacimiento" type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required autocomplete="Fecha de nacimiento" autofocus>

                                    @error('fecha_nacimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pais" class="col-md-4 col-form-label text-md-right">{{ __('País') }} </label>
                                <div class="col-md-6">
                                    <select  id="pais" name="pais" class="form-control">
                                        <option value="">Selecciona un País</option>
                                        @foreach ($paises as $data)
                                            <option value="{{$data->id}}">
                                                {{$data->name}}
                                            </option>
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
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} *</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} *</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="celular" class="col-md-4 col-form-label text-md-right">{{ __('Número Celular') }}</label>

                                <div class="col-md-6">
                                    <input id="celular" type="text" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{ old('celular') }}" autocomplete="celular" autofocus>

                                    @error('celular')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
            // Si cambia el país, se consulta los estados relacionados al nuevo pais
            $('#pais').on('change', function () {
                var idCountry = this.value;
                obtenerEstados(idCountry);
            });
            // Si cambia el estado, se consulta las ciudades relacionados al nuevo estado
            $('#estado').on('change', function () {
                var idState = this.value;
                obtenerCiudades(idState);
            });

            function obtenerEstados(idCountry) {
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
                    }
                });
            }

            function obtenerCiudades(idState) {
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
                    }
                });
            }
        });

    </script>
@endsection

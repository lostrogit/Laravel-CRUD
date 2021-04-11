@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="/emails">{{ __('Emails') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Create') }}</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header" style="background-color: #dee2e6">{{ __('Nuevo Email') }}</div>

                <div class="card-body">


                @if ($errors->any())

                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

<!-- Create Post Form -->


                    <form method="POST" action="{{ route('emails.store') }}" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group row">
                            <label for="asunto" class="col-md-4 col-form-label text-md-right">{{ __('Asunto') }}</label>

                            <div class="col-md-6">
                                <input id="asunto" name="asunto" type="text" class="form-control @error('asunto') is-invalid @enderror" name="asunto" value="{{ old('asunto') }}" required autocomplete="asunto" >

                                @error('asunto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="destinatario" class="col-md-4 col-form-label text-md-right">{{ __('Destinatario') }}</label>

                            <div class="col-md-6">
                                <input id="destinatario" name="destinatario" type="email" class="form-control @error('destinatario') is-invalid @enderror" name="destinatario" value="{{ old('destinatario') }}" required autocomplete="destinatario" >

                                @error('destinatario')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mensaje" class="col-md-4 col-form-label text-md-right">{{ __('Mensaje') }}</label>

                            <div class="col-md-6">
                                <textarea name="mensaje" class="form-control @error('mensaje') is-invalid @enderror" rows="8" id="mensaje" name="mensaje" style="resize:none" required autocomplete="mensaje">{{ old('mensaje') }}</textarea>
                                @error('mensaje')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('emails.index')}}" class="btn btn-dark ml-2">	&laquo; Back</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

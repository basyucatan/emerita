@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="cardPrin">
                <div class="cardPrin-header">{{ __('Login') }}</div>
                <div class="cardPrin-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="telefono" class="etiBase">Teléfono</label>
                                <input id="telefono" type="telefono" class="inpBase @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>
                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 position-relative">
                                <label for="password" class="etiBase">{{ __('Password') }}</label>
                                <input id="password" type="password" 
                                       class="inpBase @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="current-password">
                                <button type="button"
                                        class="bot botAzul btn-sm position-absolute top-0 end-0"
                                        style="margin-top: 26px; margin-right: 12px"
                                        onclick="togglePassword()">👁
                                </button>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <button type="submit" class="bot botAzul">
                                {{ __('Login') }}
                            </button>
                            <a class="nav-link p-0" href="{{ url('/registro') }}">
                                📝 Registro
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="reset">
        <div class="row">
            <div class="medium-offset-4 medium-4 columns">
                <br>
                <div class="login-title">Reasignar mi contraseña</div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="{{ $errors->has('email') ? ' is-invalid-input' : '' }}" required autofocus/>
                    @if ($errors->has('email'))
                        <span class="form-error is-visible">{{ $errors->first('email') }}</span>
                    @endif
                    <label>
                        Contraseña
                        <input type="password" name="password" class="{{ $errors->has('password') ? ' is-invalid-input' : '' }}" required>
                        @if ($errors->has('password'))
                            <span class="form-error is-visible">{{ $errors->first('password') }}</span>
                        @endif
                    </label>
                    <label>
                        Confirmar contraseña
                        <input id="password-confirm" type="password" class="{{ $errors->has('password_confirmation') ? ' is-invalid-input' : '' }}" name="password_confirmation" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="form-error is-visible">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </label>
                    <button type="submit" class="button expanded">Reasignar contraseña</button>
                </form>
            </div>
        </div>
    </div>
@endsection

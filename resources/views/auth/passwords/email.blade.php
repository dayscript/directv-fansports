@extends('layouts.app')

@section('content')
    <div class="reset">
        <div class="row">
            <div class="medium-offset-4 medium-4 columns">
                <br>
                <div class="login-title">Olvidé mi contraseña</div>
                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                           class="{{ $errors->has('email') ? ' is-invalid-input' : '' }}" required autofocus/>
                    @if ($errors->has('email'))
                        <span class="form-error is-visible">{{ $errors->first('email') }}</span>
                    @endif
                    <button type="submit" class="button expanded">Enviar Link para reasignar mi contraseña</button>
                </form>
            </div>
            <div class="medium-4"></div>
        </div>
    </div>
@endsection

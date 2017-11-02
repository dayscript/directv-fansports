@extends('layouts.app')

@section('content')
    <div class="section-title">
        <div class="row columns">
            <h1>Registro</h1>
        </div>
    </div>
    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="row">
            <div class="medium-9 columns">
                <p>Puede registrarse o iniciar sesión usando su cuenta de Facebook</p>
                <a href="/login/facebook" class="button facebook"><i class="fi-social-facebook"></i> Iniciar sesión en Facebook</a>
                <hr class="green">
                <div class="row">
                    <div class="medium-6 columns">
                        <label>Tipo de identificación
                            @php($types = collect(['CC'=>'Cédula de ciudadanía','CE'=>'Cédula de extranjería','PASSPORT'=>'Pasaporte']))
                            <select name="identification_type" class="{{ $errors->has('identification_type') ? ' is-invalid-input' : '' }}">
                                @foreach($types as $key=>$type)
                                    <option {{ ($key==old('identification_type','CC'))?'selected':'' }} value="{{ $key }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('identification_type'))
                                <span class="form-error is-visible">{{ $errors->first('identification_type') }}</span>
                            @endif
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <label>
                            Identificación
                            <input type="text" name="identification" class="{{ $errors->has('identification') ? ' is-invalid-input' : '' }}" value="{{ old('identification') }}" required autofocus>
                            @if ($errors->has('identification'))
                                <span class="form-error is-visible">{{ $errors->first('identification') }}</span>
                            @endif
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-6 columns">
                        <label>
                            Nombres
                            <input type="text" name="name" class="{{ $errors->has('name') ? ' is-invalid-input' : '' }}" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="form-error is-visible">{{ $errors->first('name') }}</span>
                            @endif
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <label>
                            Apellidos
                            <input type="text" name="last" class="{{ $errors->has('last') ? ' is-invalid-input' : '' }}" value="{{ old('last') }}">
                            @if ($errors->has('last'))
                                <span class="form-error is-visible">{{ $errors->first('last') }}</span>
                            @endif
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-6 columns">
                        <label>
                            Email
                            <input type="email" name="email" class="{{ $errors->has('email') ? ' is-invalid-input' : '' }}" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="form-error is-visible">{{ $errors->first('email') }}</span>
                            @endif
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <label>
                            Celular
                            <input type="text" name="phone" class="{{ $errors->has('phone') ? ' is-invalid-input' : '' }}" value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                                <span class="form-error is-visible">{{ $errors->first('phone') }}</span>
                            @endif
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-6 columns">
                        <label>Pais
                            @php($countries = App\Http\Utilities\Country::all())
                            <select name="country" class="{{ $errors->has('country') ? ' is-invalid-input' : '' }}">
                                @foreach($countries as $key=>$country)
                                    <option {{ ($key==old('country','CO'))?'selected':'' }} value="{{ $key }}">{{ $country }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('country'))
                                <span class="form-error is-visible">{{ $errors->first('country') }}</span>
                            @endif
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <label>Ciudad
                            <select name="city">
                                @php($cities = \App\User::cities())
                                <option value="" {{ old('city','Bogotá')==''?'selected':'' }}>Seleccione</option>
                                @foreach($cities as $key=>$dept)
                                    <optgroup label="{{ $key }}">
                                    @foreach($dept as $city)
                                        <option value="{{ $city }}" {{ old('city','Bogotá')==$city?'selected':'' }}>{{ $city }}</option>
                                    @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @if ($errors->has('city'))
                                <span class="form-error is-visible">{{ $errors->first('city') }}</span>
                            @endif
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-6 columns">
                        <label>
                            Contraseña
                            <input type="password" name="password" class="{{ $errors->has('password') ? ' is-invalid-input' : '' }}" required>
                            @if ($errors->has('password'))
                                <span class="form-error is-visible">{{ $errors->first('password') }}</span>
                            @endif
                        </label>
                    </div>
                    <div class="medium-6 columns">
                        <label>
                            Confirmar contraseña
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </label>
                    </div>
                </div>
                <fieldset class="row columns hide">
                    <legend>Género</legend>
                    <input type="radio" name="gender" value="M" id="gender_m" {{ old('gender','M')=='M'?'checked':'' }}><label for="gender_m">Masculino</label>
                    <input type="radio" name="gender" value="F" id="gender_f" {{ old('gender','M')=='F'?'checked':'' }}><label for="gender_f">Femenino</label>
                    @if ($errors->has('gender'))
                        <span class="form-error is-visible">{{ $errors->first('gender') }}</span>
                    @endif
                </fieldset>
                <hr>
                <hr class="light">
                <div class="row columns">
                    <p>¿Le gustaría estar al día en las emocionantes promociones ofrecidas por Directv y Servientrega?
                        Puede cambiar esta configuración en las preferencias de su perfil en cualquier momento.
                    </p>
                    <input id="promotions" name="promotions" type="checkbox" {{ old('promotions')?'checked':'' }} value="1"><label for="promotions">Si, deseo recibir promociones</label>
                </div>
                <hr>
                <hr class="light">
                <div class="row columns">
                    <p>Al continuar estás aceptando los <a target="_blank" href="/terminos-y-condiciones">términos y condiciones</a> de la plataforma.</p>
                </div>
                <button type="submit" class="button expanded">Aceptar y continuar</button>
            </div>
            <div class="medium-3 columns hide-for-small-only">
                @include('layouts.partials.ads')
            </div>
        </div>
    </form>

@endsection

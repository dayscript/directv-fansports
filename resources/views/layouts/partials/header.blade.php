<div class="header sticky" data-sticky data-margin-top="0">
    <div class="row">
        <div class="small-9 medium-5 columns">
            <a href="/"><img class="logo" src="{{ asset('img/fansports-servientrega.png') }}" alt="{{ config('app.name', 'DirecTV Fansports') }}"></a>
        </div>
        <div class="small-3 medium-7 columns text-right">
            <div class="barra" data-responsive-toggle="menu-fan" data-hide-for="medium">
                <button class="menu-icon" type="button" data-toggle="menu-fan"></button>
                <!--<div class="title-bar-title">Menu</div>-->
            </div>
            <div class="" id="menu-fan">
                <div class="top-bar-left">
                    <ul class="vertical medium-horizontal menu align-right" data-dropdown-menu>
                        <li class="{{ request()->is('/')?'is-active':'' }}"><a href="/">Inicio</a></li>
                        @auth
                            <li class="{{ request()->is('pronosticos')?'is-active':'' }}"><a href="/pronosticos">Mis pronósticos</a></li>
                        @endauth
                        <li class="{{ request()->is('ligas')?'is-active':'' }}"><a href="/ligas">Ligas</a></li>
                        <li class="{{ request()->is('ranking')?'is-active':'' }}"><a href="/ranking">Ranking</a></li>
                        <li class="{{ request()->is('como-jugar')?'is-active':'' }}"><a href="/como-jugar">Cómo jugar</a></li>
                        <li class="{{ request()->is('premios')?'is-active':'' }}"><a href="/premios">Ganadores</a></li>
                        @auth
                            <a href="#" class="button" onclick="$('.login.in').slideToggle();"><i class="fi-torso"> </i> {{ Auth::user()->name }}</a>
                        @endauth
                        @guest
                            <a href="#" class="button" onclick="$('.login.out').slideToggle();">Jugar</a>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@auth
<div class="login in">
    <div class="row">
        <div class="medium-3 columns">
            <div class="usuario">Hola: <strong>{{ Auth::user()->fullName }}</strong></div>
        </div>
        <div class="medium-2 columns">
            <a href="/mi-cuenta" class="button expanded"><i class="fi-torso"> </i> Mi cuenta</a>
        </div>
        <div class="medium-2 columns end">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="button warning expanded"><i class="fi-x-circle"> </i> Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    <hr class="light">
</div>
@endauth

@guest
    <div class="login out {{ request()->is('login')?'show':'' }}">
        <div class="row">
            <div class="medium-offset-1 medium-4 columns">
                <div class="login-title">Iniciar sesión</div>
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <strong>¿Ya tiene cuenta en Fútbol Fans?</strong>
                    <div class="small-12 columns">
                        <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" class="{{ $errors->has('email') ? ' is-invalid-input' : '' }}" required autofocus />
                        @if ($errors->has('email'))
                            <span class="form-error is-visible">{{ $errors->first('email') }}</span>
                        @endif
                        {{--<p class="help-text" id="exampleHelpText2">Correo electrónico</p>--}}
                    </div>
                    <div class="small-12 columns">
                        <input type="password" placeholder="Contraseña" name="password" required class="{{ $errors->has('password') ? ' is-invalid-input' : '' }}" />
                        @if ($errors->has('password'))
                            <span class="form-error is-visible">{{ $errors->first('password') }}</span>
                        @endif
                        {{--<p class="help-text" id="exampleHelpText2">Ingresa tu contraseña</p>--}}
                    </div>
                    <div class="small-12 columns">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}> <label for="remember">Recordarme</label>
                    </div>
                    <button type="submit" class="button expanded">Iniciar sesión</button>
                    <div class="text-center"><a href="{{ route('password.request') }}">Olvidé mi contraseña</a></div>
                    <hr class="light">
                    <p class="text-center">O ingrese usando su cuenta en Faceebok</p>
                    <a href="/login/facebook" class="button facebook expanded"><i class="fi-social-facebook"></i> Iniciar sesión en Facebook</a>
                    <hr class="light">
                </form>
            </div>
            <div class="medium-offset-2 medium-4 columns end">
                <div class="login-title">Registro</div>
                <strong>¿Aún no es miembro?</strong>
                <p>
                    Crea tu cuenta en Futbol Fans y podrás ganar grandes premios. Tu conocimiento del fútbol europeo te podrá llevar a ver un Partido del Real Madrid.
                </p>
                <a href="{{ route('register') }}" class="button expanded">Crear cuenta</a>
            </div>
        </div>
    </div>
@endguest

{{--<nav class="navbar navbar-default navbar-static-top">--}}
    {{--<div class="container">--}}
        {{--<div class="navbar-header">--}}

            {{--<!-- Collapsed Hamburger -->--}}
            {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">--}}
                {{--<span class="sr-only">Toggle Navigation</span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
            {{--</button>--}}

            {{--<!-- Branding Image -->--}}
            {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                {{--{{ config('app.name', 'Laravel') }}--}}
            {{--</a>--}}
        {{--</div>--}}

        {{--<div class="collapse navbar-collapse" id="app-navbar-collapse">--}}
            {{--<!-- Left Side Of Navbar -->--}}
            {{--<ul class="nav navbar-nav">--}}
                {{--&nbsp;--}}
            {{--</ul>--}}

            {{--<!-- Right Side Of Navbar -->--}}
            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--<!-- Authentication Links -->--}}
                {{--@if (Auth::guest())--}}
                    {{--<li><a href="{{ route('login') }}">Login</a></li>--}}
                    {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                {{--@else--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                            {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                        {{--</a>--}}

                        {{--<ul class="dropdown-menu" role="menu">--}}
                            {{--<li>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--@endif--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</nav>--}}
@extends('layouts.app')

@section('content')
    <div class="section-title">
        <div class="row columns">
            <h1>Mi cuenta</h1>
        </div>
    </div>
    <div class="row">
        <div class="medium-9 columns">
            <h4 class="title">Mis datos personales</h4>
            <div class="row">
                <div class="medium-6 columns">
                    <div class="section">Resumen</div>
                    <div class="usuario">
                        <strong>{{ $user->full_name }}</strong> <br>Email: <strong>{{ $user->email }}</strong> <br>Pais: <strong>{{ $user->country }}</strong> <br>Ciudad: <strong>{{ $user->city }}</strong> <br>Fecha de registro: <strong>{{ $user->created_at }}</strong>
                        <br>último ingreso: <strong> {{ $user->updated_at->diffForHumans() }}</strong>
                    </div>
                    <hr class="light">
                </div>
                <div class="medium-6 columns">
                    <change-password></change-password>
                </div>
            </div>
            <hr class="light">
            <h4 class="title">Resumen del juego</h4>
            <game-summary :rounds="{{ $rounds }}" :leagues="{{ $leagues }}" userid="{{ $user->id }}" :userpoints="{{ $user->points }}"></game-summary>
        </div>
        <div class="medium-3 columns text-center">
            @include('layouts.partials.ads')
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    @include('layouts.partials.banner')
    <div class="row">
        <div class="medium-9 columns">
            <div class="row">
                <div class="medium-6 columns">
                    <h3 class="title">
                        Próxima fecha: <strong>{{ $selected_round->name }}</strong>
                    </h3>
                    @forelse($selected_round->matches as $match)
                        <div class="row item column gutter-small">
                            <div class="small-9 medium-2 end columns fecha"> {{ $match->when }}</div>
                            <div class="small-9 medium-8 columns equipos">
                                <div class="row gutter-small">
                                    <div class="small-3 column home">
                                        {{ $match->localId->name }}
                                    </div>
                                    <div class="small-2 column home">
                                        <img src="{{ asset('storage/'.$match->localId->small_image) }}" alt="{{ $match->localId->name }}" height="20">
                                    </div>
                                    <div class="small-2 column versus text-center">VS</div>
                                    <div class="small-2 column home">
                                        <img src="{{ asset('storage/'.$match->visitId->small_image) }}" alt="{{ $match->visitId->name }}">
                                    </div>
                                    <div class="small-3 column away">
                                        {{ $match->visitId->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="small-3 medium-2 columns canal">
                                <img class="logo" src="{{ asset('img/channels/'.$match->channel . '.png') }}" alt="{{ $match->channel }}">{{ $match->channel }}
                            </div>
                        </div>
                        <hr>
                    @empty
                        <div class="row item column gutter-small">
                            <div class="small-12 end columns fecha">
                                No hay partidos disponibles
                            </div>
                        </div>
                    @endforelse
                        <a href="/pronosticos" class="button expanded">Pronosticar</a>
                        <hr class="light">
                </div>
                <div class="medium-6 columns">
                    <h3 class="title">
                        Ranking general
                    </h3>
                    @forelse($ranking as $row)
                        <div class="row item column">
                            <div class="small-10 columns user"><strong>{{ $loop->iteration }}.</strong>{{ $row->name }} {{ $row->last }}</div>
                            <div class="small-2 columns text-right puntos">{{ $row->points }}</div>
                        </div>
                        <hr>
                    @empty
                        <div class="row item column">
                            <div class="small-12 columns user">No hay usuarios</div>
                        </div>
                        <hr>
                    @endforelse
                    <a href="/ranking" class="button expanded">Ver todos</a>
                    <hr class="light">
                </div>
            </div>
        </div>
        <div class="medium-3 columns text-center">
            @include('layouts.partials.ads')
        </div>
    </div>
@endsection

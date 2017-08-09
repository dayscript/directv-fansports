@extends('layouts.app')

@section('content')
    <div class="section-title">
        <div class="row columns">
            <h1>Mis Ligas</h1>
        </div>
    </div>
    <div class="row">
        <div class="medium-9 columns">
            <ul class="tabs" data-responsive-accordion-tabs="tabs small-accordion medium-tabs" id="ligas-tabs">
                <li class="tabs-title {{ (!$edit_league && !$join_code)?'is-active':'' }}"><a href="#panel1" aria-selected="{{ (!$edit_league && !$join_code)?'true':'false' }}">Mis ligas</a></li>
                <li class="tabs-title {{ $edit_league?'is-active':'' }}"><a href="#panel2" aria-selected="{{ $edit_league?'true':'false' }}">Crear/Editar liga</a></li>
                <li class="tabs-title {{ $join_code?'is-active':'' }}"><a href="#panel3" aria-selected="{{ $join_code?'true':'false' }}">Unirme a una liga</a></li>
            </ul>
            <div class="tabs-content" data-tabs-content="ligas-tabs">
                <div class="tabs-panel {{ (!$edit_league && !$join_code)?'is-active':'' }}" id="panel1">
                    <div class="row">
                        <div class="row columns encabezado hide-for-small-only">
                            <div class="medium-6 columns text-left">Liga</div>
                            <div class="medium-2 columns text-center">No. usuarios</div>
                            <div class="medium-2 columns text-center">Puntos</div>
                            <div class="medium-2 columns text-center">Opciones</div>
                        </div>
                    </div>
                    @forelse($leagues as $league)
                        @can('update', $league)
                            <league-summary :league="{{ $league }}" :editable="true"></league-summary>
                        @elsecannot('update',$league)
                            <league-summary :league="{{ $league }}" :editable="false"></league-summary>
                        @endcan
                        <hr>
                    @empty
                        <div class="row item liga column" style="min-height: 100px;">
                            <div class="medium-12 columns text-center item-liga">No te has unido a ninguna liga todavía.</div>
                        </div>
                    @endforelse
                </div>
                <div class="tabs-panel {{ $edit_league?'is-active':'' }}" id="panel2">
                    @if($edit_league)
                        <league-create :league="{{ $edit_league }}"></league-create>
                    @else
                        <league-create></league-create>
                    @endif
                </div>
                <div class="tabs-panel {{ $join_code?'is-active':'' }}" id="panel3">
                    <league-join :initialcode="'{{ $join_code??'null' }}'"></league-join>
                </div>
            </div>
        </div>
        <div class="medium-3 columns text-center">
            @include('layouts.partials.ads')
        </div>
    </div>
@endsection

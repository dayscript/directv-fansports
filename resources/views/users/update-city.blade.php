@extends('layouts.app')

@section('content')
    <div class="section-title">
        <div class="row columns">
            <h1>{{ $page->title }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="medium-9 columns">
            <h2 class="section">{!! $page->excerpt !!}</h2>
            {!! $page->body  !!}
            <form class="form-horizontal" method="POST" action="users/{{ $user->id }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="redirect" value="{{ $redirect }}">
                <div class="row">
                    <div class="medium-6 columns">
                        <label>Ciudad
                            <select name="city">
                                @php($cities = \App\User::cities())
                                <option value="" {{ old('city','Bogotá')==''?'selected':'' }}>Seleccione</option>
                                @foreach($cities as $key=>$dept)
                                    <optgroup label="{{ $key }}">
                                        @foreach($dept as $city)
                                            <option value="{{ $city }}" {{ old('city', $user->city )==$city?'selected':'' }}>{{ $city }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @if ($errors->has('city'))
                                <span class="form-error is-visible">{{ $errors->first('city') }}</span>
                            @endif
                        </label>
                        <button type="submit" class="button expanded">Actualizar</button>
                    </div>

                </div>
            </form>
        </div>

        <div class="medium-3 columns text-center">
            @include('layouts.partials.ads')
        </div>
    </div>
@endsection

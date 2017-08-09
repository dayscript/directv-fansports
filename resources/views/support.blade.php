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
            <contact></contact>
        </div>
        <div class="medium-3 columns text-center">
            @include('layouts.partials.ads')
        </div>
    </div>
@endsection

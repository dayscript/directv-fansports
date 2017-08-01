@extends('layouts.app')

@section('content')
    <game :rounds="{{ $rounds }}" selected_round="{{ $selected_round->id??'' }}"></game>
@endsection

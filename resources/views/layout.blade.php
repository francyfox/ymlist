@extends('layouts/app')

@section('layout')
    <div class="columns is-vcentered">
        @guest()
            @include('welcome')
        @else
            @include('ymaps')
        @endguest
    </div>
@endsection

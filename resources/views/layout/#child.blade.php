@extends('layout.#index')

@section('title', 'Page Title')

@section('sidebar')
    <p>This is appended to the master sidebar.</p>
    @parent
@stop

@section('content')
    <p>This is my body content.</p>
@stop
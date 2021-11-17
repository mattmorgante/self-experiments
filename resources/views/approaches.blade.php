@extends('layouts.app')
@section('content')
<h2 class="title">Here are some recommended approaches to <b>{{ $goal->name }}</b>. Pick one:</h2>

<div class="picker">
@foreach ($approaches as $approach)
    <a class="item" href="/plan/{{ $goal->id }}/{{ $approach->id }}">
            {{ $approach->name }}
    </a>
@endforeach
</div>

@stop
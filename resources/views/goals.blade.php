@extends('layouts.app')
@section('content')
<h2 class="title">What do you want to improve in your life?</h2>

<div class="picker">
@foreach ($goals as $goal)
    <div class="item"><a href="/approaches/{{ $goal->id }}">{{ $goal->name }}</a></div>
@endforeach
</div>

@stop



{{--  --}}
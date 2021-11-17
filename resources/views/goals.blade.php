@extends('layouts.app')
@section('content')
<h2 class="title">What do you want to improve in your life?</h2>

<div class="picker">
@foreach ($goals as $goal)
    <a class="item" href="/approaches/{{ $goal->id }}">{{ $goal->name }}</a>
@endforeach
</div>

@stop



{{--  --}}
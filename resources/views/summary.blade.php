@extends('layouts.app')
@section('content')
<div class="form-header">
	<h2 class="title">You decided to try to {{ $goal_name }}</h2>
	<h2 class="title">Your approach was to {{ $approach_name }}</h2>
	<h2 class="title">Your experiment ran for {{ $plan->days }} days</h2>
	<h2 class="title">You were successful in completing your daily task for {{ $success_days }} days, {{ $percent }} of the time.</h2>
	<h2 class="title">We measured this using your {{ $measurement }}</h2>
	<h2 class="title">Initially, you were at: {{ $initial }}</h2>
	<h2 class="title">By the end of the experiment, you were at: {{ $end }}</h2>
	<h2 class="title">Thanks for completing your experiment. Would you like to <a href="/goals" style="text-decoration: underline">make another?</a></h2>
</div>
@stop
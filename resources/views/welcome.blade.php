@extends('layouts.app')

@section('content')


<div class="wrapper">
    <div id="left">
        <div class="container">
            <h2>Want to make an improvement in your life?</h2>
            <ul class="hero-bullets">
                <li class="list-disc">Commit to changing one thing which you hypothesize will have a positive impact</li>
                <li class="list-disc">Self Experiments will text you everyday for 1 or 2 weeks to track your progress</li>
                <li class="list-disc">We will measure the outcomes and send you a summary at the end of the experiment</li>
                <li class="list-disc">Find the correlation between changes and results</li>
                <li class="list-disc">Iterate and improve</li>
            </ul>
            <a href="/goals">
                <button class="button">Get Started</button>
            </a>
            
        </div>
    </div>
    <div id="right"><img id="screenshot" src="{{ asset('images/text.png') }}" alt="Sample text message exchange with Self Experiments"></div>
  </div>


@stop
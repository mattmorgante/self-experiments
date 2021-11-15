<p>What do you want to improve in your life?</p>

@foreach ($goals as $goal)
    <div class="wrapper">
        <div><a class="btn" href="/approaches/{{ $goal->id }}">{{ $goal->name }}</a></div>
    </div>
@endforeach

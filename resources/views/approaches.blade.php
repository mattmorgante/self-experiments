<p>Here are some recommended approaches to {{ $goal->name }}. Pick one</p>

@foreach ($approaches as $approach)
    <div>
        <a class="btn" href="/plan/{{ $goal->id }}/{{ $approach->id }}">{{ $approach->name }}</a>
    </div>
@endforeach
<div>
    {{-- Success is as dangerous as failure. --}}
    @foreach ($todolists as $todolist)
        {{ $todolist->title }}
    @endforeach
</div>

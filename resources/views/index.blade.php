<h1>The list of Tasks.</h1>

<!-- Using if and foreach -->
<!-- <div>
    @if(count($tasks))
        @foreach($tasks as $task)
            <div>{{$task->title}}</div>
        @endforeach
    @else
        <div>There are no tasks!</div>
    @endif
</div> -->

<!-- Using forelse block -->
<div>
    @forelse ($tasks as $task)
    <!-- <div>{{$task->title}}</div> -->
        <div>
            <a href="{{ route('tasks.show', ['id' => $task->id]) }}">{{$task->title}}</a>
        </div>
    @empty
        <div>There are no tasks.</div>
    @endforelse
</div>

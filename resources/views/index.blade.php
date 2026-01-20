@extends('layouts.app')

@section('title', 'The list of Tasks.')

@section('content')
{{-- Add task button --}}
<nav class="mb-4">
    <a href="{{ route('tasks.create') }}" 
    class="btn">Add New Task!</a>
</nav>
<!-- Using if and foreach -->
<!-- <div>
    @if(count($tasks))
        @foreach($tasks as $task)
            <div>{{$task->title}}</div
        @endforeach
    @else
        <div>There are no tasks!</div>
    @endif
</div> -->

<!-- Using forelse block -->
<div class="py-5">
    @forelse ($tasks as $task)
    <!-- <div>{{$task->title}}</div> -->
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                @class(['line-through' => $task->completed])>{{$task->title}}</a>
        </div>
    @empty
        <div>There are no tasks.</div>
    @endforelse
</div>
@if ($tasks->count())
    <nav class="mt-5">
        {{ $tasks->links() }}
    </nav>
@endif
@endsection

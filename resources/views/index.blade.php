@extends('layouts.app')

@section('title', 'The list of Tasks.')

@section('content')
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
<div>
    @forelse ($tasks as $task)
    <!-- <div>{{$task->title}}</div> -->
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{$task->title}}</a>
        </div>
    @empty
        <div>There are no tasks.</div>
    @endforelse
</div>
@endsection

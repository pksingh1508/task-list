@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="mt-4">
        <a href="{{ route('tasks.index') }}" 
        class="link">⬅️ Go Back to the Task List!</a>
    </div>
    <p class="mb-4 text-slate-700">{{ $task->description }}</p>
    @if ($task->long_description)
        <div class="mb-4 text-slate-700">{{ $task->long_description }}</div>
    @endif
    <p class="mb-4 text-sm text-slate-500">Created {{ $task->created_at->diffForHumans() }} ▫️Updated {{ $task->updated_at->diffForHumans() }}</p>
    <p>
        @if ($task->completed)
            <span class="font-medium text-green-500">Completed</span>
        @else
            <span class="font-medium text-red-500">Not Completed</span>
        @endif
    </p>
    <div class="flex mt-5 gap-5">
        <div>
            <button class="btn">
                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"
                    >Edit Task.</a>
            </button>
        </div>
        <div>
            <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
                @csrf
                @method('PUT')
                <button type="submit" class="btn">
                    Mark as {{ $task->completed ? 'not completed' : 'completed' }}
                </button>
            </form>
        </div>
        <div>
            <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn">Delete</button>
            </form>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <nav class="mb-6">
        <a href="{{ route('tasks.index') }}" 
        class="btn btn-secondary inline-flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to Tasks
        </a>
    </nav>

    <div class="card p-8">
        <div class="flex items-start gap-4 mb-6">
            <div class="flex-shrink-0">
                @if($task->completed)
                    <span class="w-12 h-12 rounded-full bg-gradient-to-r from-emerald-500 to-green-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/30 text-xl">
                        ✓
                    </span>
                @else
                    <span class="w-12 h-12 rounded-full bg-gradient-to-r from-amber-500 to-orange-600 flex items-center justify-center text-white shadow-lg shadow-amber-500/30 text-xl">
                        ⏳
                    </span>
                @endif
            </div>
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-slate-800 @if($task->completed) line-through decoration-indigo-500/50 opacity-60 @endif">{{ $task->title }}</h2>
                <p class="mt-3 text-slate-700 leading-relaxed">{{ $task->description }}</p>
                @if ($task->long_description)
                    <div class="mt-4 p-4 rounded-xl bg-slate-50 border border-slate-200">
                        <p class="text-slate-600 leading-relaxed">{{ $task->long_description }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-wrap gap-4 mb-8">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium
                @if($task->completed) bg-emerald-100 text-emerald-700 @else bg-amber-100 text-amber-700 @endif">
                @if($task->completed)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Completed
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Not Completed
                @endif
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-slate-100 text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Created {{ $task->created_at->diffForHumans() }}
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-slate-100 text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                Updated {{ $task->updated_at->diffForHumans() }}
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"
                class="btn btn-secondary flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>
                Edit Task
            </a>
            <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
                @csrf
                @method('PUT')
                <button type="submit" class="btn @if($task->completed) btn-secondary @else btn-success @endif flex items-center justify-center gap-2">
                    @if($task->completed)
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Mark as Not Complete
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Mark as Complete
                    @endif
                </button>
            </form>
            <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    Delete Task
                </button>
            </form>
        </div>
    </div>
@endsection
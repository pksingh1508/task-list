@extends('layouts.app')

@section('title', 'Task List')

@section('content')
<nav class="mb-8 flex justify-end">
    <a href="{{ route('tasks.create') }}" 
    class="btn btn-primary flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Add New Task
    </a>
</nav>

<div class="space-y-4">
    @forelse ($tasks as $task)
        <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
            class="card card-hover p-5 group relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/0 to-purple-500/0 group-hover:from-indigo-500/5 group-hover:to-purple-500/5 transition-all duration-300"></div>
            <div class="relative flex items-center gap-4">
                <div class="flex-shrink-0">
                    @if($task->completed)
                        <span class="w-10 h-10 rounded-full bg-gradient-to-r from-emerald-500 to-green-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </span>
                    @else
                        <span class="w-10 h-10 rounded-full bg-gradient-to-r from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center text-slate-500 dark:text-slate-400 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                        class="text-lg font-semibold text-slate-800 dark:text-slate-100 @if($task->completed) line-through decoration-indigo-500/50 opacity-60 @endif transition-all duration-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                        {{ $task->title }}
                    </a>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 line-clamp-1">{{ $task->description }}</p>
                </div>
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                        class="w-5 h-5 text-slate-400 group-hover:text-indigo-500 dark:group-hover:text-indigo-400 transition-colors duration-200 transform group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </div>
        </div>
    @empty
        <div class="card p-12 text-center">
            <div class="text-6xl mb-4">📝</div>
            <h3 class="text-xl font-semibold text-slate-700 dark:text-slate-300 mb-2">No tasks yet</h3>
            <p class="text-slate-500 dark:text-slate-400">Create your first task to get started!</p>
        </div>
    @endforelse
</div>
@endsection

@section('pagination')
@if ($tasks->hasPages())
    <div class="container mx-auto px-4 py-4 max-w-4xl">
        <nav class="flex justify-center items-center gap-2">
            @if($tasks->onFirstPage())
                <span class="page-item page-inactive opacity-50 cursor-not-allowed">← Previous</span>
            @else
                <a href="{{ $tasks->previousPageUrl() }}" class="page-item page-inactive hover:border-indigo-500 dark:hover:border-indigo-400">← Previous</a>
            @endif
            
            @foreach($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                @if($page == $tasks->currentPage())
                    <span class="page-item page-active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-item page-inactive">{{ $page }}</a>
                @endif
            @endforeach
            
            @if($tasks->hasMorePages())
                <a href="{{ $tasks->nextPageUrl() }}" class="page-item page-inactive hover:border-indigo-500 dark:hover:border-indigo-400">Next →</a>
            @else
                <span class="page-item page-inactive opacity-50 cursor-not-allowed">Next →</span>
            @endif
        </nav>
    </div>
@endif
@endsection

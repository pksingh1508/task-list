@extends('layouts.app')

@section('title', 'Task List')

@section('content')
<nav class="mb-6 flex justify-end">
    <a href="{{ route('tasks.create') }}" 
    class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Add New Task
    </a>
</nav>

<div class="space-y-3">
    @forelse ($tasks as $task)
        <div class="card card-hover p-4 group">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 pt-1">
                    @if($task->completed)
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-emerald-100 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @else
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-slate-100 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                        class="text-base font-semibold text-slate-900 @if($task->completed) line-through text-slate-500 @endif hover:text-slate-700 transition-colors">
                        {{ $task->title }}
                    </a>
                    <p class="text-sm text-slate-500 mt-0.5 line-clamp-1">{{ $task->description }}</p>
                </div>
                <div class="flex-shrink-0 self-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                        class="w-5 h-5 text-slate-400 group-hover:text-slate-600 transition-colors duration-200">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </div>
        </div>
    @empty
        <div class="card p-8 text-center border-dashed border-2 bg-slate-50">
            <div class="text-4xl mb-3 opacity-50">📝</div>
            <h3 class="text-lg font-medium text-slate-900 mb-1">No tasks yet</h3>
            <p class="text-slate-500 text-sm">Create your first task to get started!</p>
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
                <a href="{{ $tasks->previousPageUrl() }}" class="page-item page-inactive hover:border-indigo-500">← Previous</a>
            @endif
            
            @foreach($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                @if($page == $tasks->currentPage())
                    <span class="page-item page-active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-item page-inactive">{{ $page }}</a>
                @endif
            @endforeach
            
            @if($tasks->hasMorePages())
                <a href="{{ $tasks->nextPageUrl() }}" class="page-item page-inactive hover:border-indigo-500">Next →</a>
            @else
                <span class="page-item page-inactive opacity-50 cursor-not-allowed">Next →</span>
            @endif
        </nav>
    </div>
@endif
@endsection

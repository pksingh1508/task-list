@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('content')
    <div x-data="{ submitting: false }" class="card p-8">
        <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}" @submit="submitting = true">
            @csrf
            @isset($task)
                @method('PUT')
            @endisset
            <div class="mb-6" x-data="{ focused: false }">
                <label for="title">Title</label>
                <input type="text" name="title" id="title"
                    :class="['shadow-sm appearance-none border w-full py-3 px-4 leading-tight rounded-lg transition-all duration-200', $errors->has('title') ? 'border-red-500 dark:border-red-500 focus:border-red-500 dark:focus:border-red-500 focus:ring-red-500/20 dark:focus:ring-red-500/20 bg-red-50 dark:bg-red-900/20' : (focused ? 'border-indigo-500 dark:border-indigo-400 focus:ring-indigo-500/30 bg-white dark:bg-slate-800/50' : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50')]"
                    @focus="focused = true" @blur="focused = false"
                    value="{{ $task->title ?? old('title') }}" placeholder="Enter task title..."/>
                @error('title')
                    <p class="error mt-2 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-6" x-data="{ focused: false }">
                <label for="description">Description</label>
                <textarea name="description" id="description" 
                    :class="['shadow-sm appearance-none border w-full py-3 px-4 leading-tight rounded-lg transition-all duration-200', $errors->has('description') ? 'border-red-500 dark:border-red-500 focus:border-red-500 dark:focus:border-red-500 focus:ring-red-500/20 dark:focus:ring-red-500/20 bg-red-50 dark:bg-red-900/20' : (focused ? 'border-indigo-500 dark:border-indigo-400 focus:ring-indigo-500/30 bg-white dark:bg-slate-800/50' : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50')]"
                    @focus="focused = true" @blur="focused = false"
                    rows="4" placeholder="Enter a short description...">{{ $task->description ?? old('description') }}</textarea>
                @error('description')
                    <p class="error mt-2 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-8" x-data="{ focused: false }">
                <label for="long_description">Long Description</label>
                <textarea name="long_description" id="long_description" 
                    :class="['shadow-sm appearance-none border w-full py-3 px-4 leading-tight rounded-lg transition-all duration-200', $errors->has('long_description') ? 'border-red-500 dark:border-red-500 focus:border-red-500 dark:focus:border-red-500 focus:ring-red-500/20 dark:focus:ring-red-500/20 bg-red-50 dark:bg-red-900/20' : (focused ? 'border-indigo-500 dark:border-indigo-400 focus:ring-indigo-500/30 bg-white dark:bg-slate-800/50' : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50')]"
                    @focus="focused = true" @blur="focused = false"
                    rows="8" placeholder="Enter detailed description (optional)...">{{ $task->long_description ?? old('long_description') }}</textarea>
                @error('long_description')
                    <p class="error mt-2 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn btn-primary flex-1 flex items-center justify-center gap-2" :disabled="submitting">
                    <svg x-show="!submitting" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                    <svg x-show="submitting" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-5 h-5 animate-spin">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span x-text="submitting ? 'Saving...' : '{{ isset($task) ? 'Update Task' : 'Add Task' }}'"></span>
                </button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task List App</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script>
        tailwind.config = {
            darkMode: 'class'
        };
        (function() {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
                window.__darkMode = true
            } else {
                document.documentElement.classList.remove('dark')
                window.__darkMode = false
            }
        })();
    </script>
    <style type="text/tailwindcss">
        @theme {
            --color-primary: #6366f1;
            --color-primary-hover: #4f46e5;
            --color-success: #10b981;
            --color-danger: #ef4444;
            --color-warning: #f59e0b;
            --default-font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        }
        .btn {
            @apply rounded-lg px-4 py-2.5 text-center font-semibold shadow-lg transition-all duration-300 cursor-pointer transform hover:scale-105 active:scale-95
        }
        .btn-primary {
            @apply bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white shadow-indigo-500/30
        }
        .btn-secondary {
            @apply bg-gradient-to-r from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 text-slate-700 dark:text-slate-200 hover:from-slate-200 hover:to-slate-300 dark:hover:from-slate-600 dark:hover:to-slate-700 shadow-slate-500/20 dark:shadow-slate-800/30
        }
        .btn-danger {
            @apply bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white shadow-red-500/30
        }
        .btn-success {
            @apply bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white shadow-emerald-500/30
        }
        .link {
            @apply font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors duration-200
        }
        label {
            @apply block uppercase text-slate-700 dark:text-slate-300 mb-2 text-sm font-semibold tracking-wide
        }
        input, textarea {
            @apply w-full py-3 px-4 text-slate-700 dark:text-slate-200 leading-tight rounded-lg border-2 border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/20 transition-all duration-200
        }
        .error {
            @apply text-red-500 dark:text-red-400 text-sm font-medium
        }
        .card {
            @apply bg-white dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-slate-900/50 border border-slate-200 dark:border-slate-700/50 transition-all duration-300
        }
        .card-hover {
            @apply hover:shadow-2xl hover:shadow-indigo-500/10 dark:hover:shadow-indigo-500/20 hover:-translate-y-1
        }
        .page-item {
            @apply px-3 py-2 mx-1 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105
        }
        .page-active {
            @apply bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg shadow-indigo-500/30
        }
        .page-inactive {
            @apply bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700
        }
    </style>
    @yield('styles')
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50 dark:from-slate-950 dark:via-slate-900 dark:to-indigo-950 transition-colors duration-500">
    <div x-data="{ 
        darkMode: window.__darkMode,
        flash: true
    }" x-init="
        $watch('darkMode', val => {
            if (val) {
                localStorage.theme = 'dark'
                document.documentElement.classList.add('dark')
            } else {
                localStorage.theme = 'light'
                document.documentElement.classList.remove('dark')
            }
        });
        document.documentElement.classList.toggle('dark', darkMode);
    " x-cloak class="min-h-screen flex flex-col">
        <header class="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-lg border-b border-slate-200 dark:border-slate-700/50 transition-all duration-300">
            <div class="container mx-auto px-4 py-4 max-w-4xl flex justify-between items-center">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">@yield('title')</h1>
                <button @click="darkMode = !darkMode" 
                    class="relative w-14 h-7 rounded-full bg-slate-300 dark:bg-slate-600 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-inner">
                    <span class="absolute left-1 top-1 w-5 h-5 rounded-full bg-white shadow-md transform transition-transform duration-300 flex items-center justify-center text-sm"
                        :class="darkMode ? 'translate-x-7' : 'translate-x-0'">
                        <span x-text="darkMode ? '🌙' : '☀️'" class="select-none"></span>
                    </span>
                </button>
            </div>
        </header>
        <main class="flex-1 container mx-auto px-4 py-8 max-w-4xl">
            <div x-show="flash" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-4"
                @if(session()->has('success'))
                class="relative mb-8 rounded-2xl border border-green-400/50 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/30 px-6 py-4 shadow-lg shadow-green-500/20" role="alert">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">✅</span>
                    <div>
                        <strong class="font-bold text-green-700 dark:text-green-400">Success!</strong>
                        <div class="text-green-600 dark:text-green-300">{{ session('success') }}</div>
                    </div>
                    <button @click="flash = false" class="ml-auto text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-800/50 rounded-lg p-2 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                @endif
            </div>
            @yield('content')
        </main>
        <footer id="pagination-footer" class="sticky bottom-0 z-40 bg-white/90 dark:bg-slate-900/90 backdrop-blur-lg border-t border-slate-200 dark:border-slate-700/50 transition-all duration-300 shadow-lg shadow-slate-200/50 dark:shadow-slate-900/50">
            @yield('pagination')
        </footer>
    </div>
</body>
</html>
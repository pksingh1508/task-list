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
    <style type="text/tailwindcss">
        @theme {
            --color-primary: #334155;
            --color-primary-hover: #1e293b;
            --color-success: #059669;
            --color-danger: #dc2626;
            --color-warning: #d97706;
            --default-font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        }
        .btn {
            @apply rounded-md px-4 py-2 text-sm font-medium border transition-colors duration-200 cursor-pointer flex items-center justify-center gap-2 focus:ring-2 focus:ring-offset-2 focus:outline-none
        }
        .btn-primary {
            @apply bg-slate-900 border-transparent text-white hover:bg-slate-800 focus:ring-slate-900
        }
        .btn-secondary {
            @apply bg-white border-slate-300 text-slate-700 hover:bg-slate-50 focus:ring-slate-500
        }
        .btn-danger {
            @apply bg-red-600 border-transparent text-white hover:bg-red-700 focus:ring-red-600
        }
        .btn-success {
            @apply bg-emerald-600 border-transparent text-white hover:bg-emerald-700 focus:ring-emerald-600
        }
        .link {
            @apply font-medium text-slate-900 underline decoration-slate-300 underline-offset-4 hover:decoration-slate-900 transition-all duration-200
        }
        label {
            @apply block text-slate-700 mb-1.5 text-sm font-medium
        }
        input, textarea {
            @apply w-full py-2.5 px-3 text-sm text-slate-900 rounded-md border border-slate-300 bg-white focus:border-slate-900 focus:ring-1 focus:ring-slate-900 transition-colors duration-200 placeholder:text-slate-400
        }
        .error {
            @apply text-red-600 text-xs mt-1
        }
        .card {
            @apply bg-white rounded-lg shadow-sm border border-slate-200 transition-colors duration-200
        }
        .card-hover {
            @apply hover:border-slate-300
        }
        .page-item {
            @apply px-3 py-1.5 mx-0.5 rounded-md text-sm font-medium transition-colors duration-200
        }
        .page-active {
            @apply bg-slate-900 text-white
        }
        .page-inactive {
            @apply bg-white text-slate-700 hover:bg-slate-50 border border-slate-300
        }
    </style>
    @yield('styles')
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 transition-colors duration-300">
    <div x-data="{ flash: true }" x-cloak class="min-h-screen flex flex-col">
        <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
            <div class="container mx-auto px-4 py-4 max-w-3xl flex justify-between items-center">
                <h1 class="text-xl font-bold tracking-tight text-slate-900">@yield('title')</h1>
            </div>
        </header>
        <main class="flex-1 container mx-auto px-4 py-8 max-w-3xl">
            <div x-show="flash" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                @if(session()->has('success'))
                class="relative mb-6 rounded-md border border-emerald-500/20 bg-emerald-50 px-4 py-3" role="alert">
                <div class="flex items-center gap-3">
                    <span class="text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <div class="text-sm font-medium text-emerald-800">{{ session('success') }}</div>
                    <button @click="flash = false" class="ml-auto text-emerald-600 hover:text-emerald-800 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                @endif
            </div>
            @yield('content')
        </main>
        <footer id="pagination-footer" class="sticky bottom-0 z-40 bg-white/80 backdrop-blur-md border-t border-slate-200 transition-colors duration-300">
            @yield('pagination')
        </footer>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- jQuery (wajib untuk Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('scripts')
</head>
<body class="bg-gray-100 text-gray-900">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md border-r border-gray-200 p-6 sticky top-0 h-screen transition-all duration-500">
        {{-- Logo --}}
        <div class="mb-6 flex justify-center">
            <img src="{{ asset('images/logojr.jpg') }}" alt="Logo" class="h-12 object-contain">
        </div>

        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-blue-600">Admin Panel</h2>
        </div>

        <nav class="space-y-2 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 ease-in-out
                {{ request()->routeIs('admin.dashboard') 
                    ? 'bg-blue-100 text-blue-700 scale-[1.02] shadow-md border-l-4 border-blue-600' 
                    : 'text-gray-700 hover:bg-blue-50 hover:scale-[1.01]' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.products.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 ease-in-out
                {{ request()->routeIs('admin.products.*') 
                    ? 'bg-blue-100 text-blue-700 scale-[1.02] shadow-md border-l-4 border-blue-600' 
                    : 'text-gray-700 hover:bg-blue-50 hover:scale-[1.01]' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7M8 21h8m-4-4v4"
                            stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Produk
                </a>

                <a href="{{ route('admin.blocking.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 ease-in-out
                {{ request()->routeIs('admin.blocking.*') 
                    ? 'bg-blue-100 text-blue-700 scale-[1.02] shadow-md border-l-4 border-blue-600' 
                    : 'text-gray-700 hover:bg-blue-50 hover:scale-[1.01]' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Booking Manual
                </a>

                <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 ease-in-out
                {{ request()->routeIs('admin.users.*') 
                    ? 'bg-blue-100 text-blue-700 scale-[1.02] shadow-md border-l-4 border-blue-600' 
                    : 'text-gray-700 hover:bg-blue-50 hover:scale-[1.01]' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.121 17.804A7.975 7.975 0 0112 15c2.042 0 3.898.764 5.293 2.004M15 11a3 3 0 10-6 0 3 3 0 006 0z"
                            stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    User
                </a>
            </nav>

    </aside>

    {{-- Content --}}
    <main class="flex-1 p-6">
        {{-- Header --}}
        <header class="flex justify-end items-center gap-4 mb-6">
            <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                     alt="Avatar" class="w-8 h-8 rounded-full object-cover">

                <div class="flex flex-col">
                    <span class="text-sm font-semibold text-gray-800">Hai, {{ Auth::user()->name }}</span>
                    <div class="text-xs text-gray-500">Admin Jasa Raharja</div>
                </div>

                <a href="{{ route('profile.edit') }}"
                   class="text-sm text-blue-600 hover:underline ml-4">
                    Profil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:underline ml-2">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        {{-- Main content --}}
        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>

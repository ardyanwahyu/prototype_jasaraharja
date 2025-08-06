@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-md animate-fadeInUp transition-all duration-300">
        
        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/logojr.jpg') }}" alt="Logo" class="h-12 object-contain">
        </div>

        <!-- Judul -->
        <h2 class="text-center text-gray-800 text-lg font-semibold mb-5">Daftar Akun Baru</h2>

        <!-- Form Registrasi -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4 text-sm">
            @csrf

            <!-- Nama -->
            <div class="relative">
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    required
                    placeholder=" "
                    autocomplete="name"
                    class="peer w-full px-3 pt-5 pb-1.5 border border-gray-300 rounded-md text-gray-900 placeholder-transparent focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                >
                <label
                    for="name"
                    class="absolute left-2.5 top-1.5 text-xs text-gray-500 transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-1.5 peer-focus:text-xs peer-focus:text-indigo-500 bg-white px-1">
                    Nama Lengkap
                </label>
                @error('name')
                    <div class="mt-1 text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="relative">
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    placeholder=" "
                    autocomplete="email"
                    class="peer w-full px-3 pt-5 pb-1.5 border border-gray-300 rounded-md text-gray-900 placeholder-transparent focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                >
                <label
                    for="email"
                    class="absolute left-2.5 top-1.5 text-xs text-gray-500 transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-1.5 peer-focus:text-xs peer-focus:text-indigo-500 bg-white px-1">
                    Email
                </label>
                @error('email')
                    <div class="mt-1 text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- No. Telepon -->
            <div class="relative">
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    value="{{ old('phone') }}"
                    required
                    placeholder=" "
                    class="peer w-full px-3 pt-5 pb-1.5 border border-gray-300 rounded-md text-gray-900 placeholder-transparent focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                >
                <label
                    for="phone"
                    class="absolute left-2.5 top-1.5 text-xs text-gray-500 transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-1.5 peer-focus:text-xs peer-focus:text-indigo-500 bg-white px-1">
                    No. Telepon
                </label>
                @error('phone')
                    <div class="mt-1 text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative">
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    placeholder=" "
                    autocomplete="new-password"
                    class="peer w-full px-3 pt-5 pb-1.5 border border-gray-300 rounded-md text-gray-900 placeholder-transparent focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                >
                <label
                    for="password"
                    class="absolute left-2.5 top-1.5 text-xs text-gray-500 transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-1.5 peer-focus:text-xs peer-focus:text-indigo-500 bg-white px-1">
                    Kata Sandi
                </label>
                @error('password')
                    <div class="mt-1 text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="relative">
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    required
                    placeholder=" "
                    autocomplete="new-password"
                    class="peer w-full px-3 pt-5 pb-1.5 border border-gray-300 rounded-md text-gray-900 placeholder-transparent focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                >
                <label
                    for="password_confirmation"
                    class="absolute left-2.5 top-1.5 text-xs text-gray-500 transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-1.5 peer-focus:text-xs peer-focus:text-indigo-500 bg-white px-1">
                    Konfirmasi Kata Sandi
                </label>
                @error('password_confirmation')
                    <div class="mt-1 text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol -->
            <button type="submit"
                class="w-full bg-indigo-600 text-white text-sm font-semibold py-2 rounded-lg shadow-sm transition duration-300 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                Daftar
            </button>

            <div class="text-xs text-center text-gray-600 mt-3">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">Masuk di sini</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fadeInUp {
    animation: fadeInUp 0.4s ease-out;
}
</style>
@endpush

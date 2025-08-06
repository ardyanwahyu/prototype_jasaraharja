@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md animate-fadeInUp transition-all duration-300">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logojr.jpg') }}" alt="Logo" class="h-14 object-contain">
        </div>

        <!-- Judul -->
        <h2 class="text-center text-gray-800 text-xl font-semibold mb-6">Masuk ke Akun Anda</h2>

        <!-- Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div class="relative">
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    placeholder=" "
                    class="peer w-full px-4 pt-6 pb-2 border border-gray-300 rounded-md text-gray-900 placeholder-transparent focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                >
                <label
                    for="email"
                    class="absolute left-3 top-2.5 text-sm text-gray-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2.5 peer-focus:text-sm peer-focus:text-indigo-500 bg-white px-1">
                    Email
                </label>
            </div>

            <!-- Password -->
            <div class="relative">
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    placeholder=" "
                    class="peer w-full px-4 pt-6 pb-2 border border-gray-300 rounded-md text-gray-900 placeholder-transparent focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                >
                <label
                    for="password"
                    class="absolute left-3 top-2.5 text-sm text-gray-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:top-2.5 peer-focus:text-sm peer-focus:text-indigo-500 bg-white px-1">
                    Kata Sandi
                </label>

                <!-- Tombol ikon mata -->
                <div class="absolute right-3 top-3.5 cursor-pointer" onclick="togglePassword()">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 hover:text-indigo-700 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
            </div>



            <!-- Tombol Masuk -->
            <button type="submit"
                class="w-full bg-indigo-600 text-white text-sm font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 transform hover:scale-105 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 active:scale-95 animate-glow">
                Masuk
            </button>
        </form>

        <!-- Daftar jika belum punya akun -->
        <div class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">Daftar di sini</a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(40px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fadeInUp {
    animation: fadeInUp 0.5s ease-out;
}
</style>
@endpush

@push('scripts')
<script>
function togglePassword() {
    const password = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.add('text-indigo-700');
    } else {
        password.type = 'password';
        icon.classList.remove('text-indigo-700');
    }
}
</script>
@endpush

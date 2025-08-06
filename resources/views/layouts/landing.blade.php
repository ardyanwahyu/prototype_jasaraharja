<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Di bagian <head> -->
<script src="https://unpkg.com/feather-icons"></script>


    {{-- SwiperJS Library --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>

<body class="bg-gray-100 text-gray-900 antialiased overflow-x-hidden">


    <!-- Navbar -->
    <div class="w-full bg-white shadow fixed top-0 left-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-2 group animate-logo-fade-in">
                <img src="{{ asset('images/logojr.jpg') }}"
                     alt="Logo Jasa Raharja"
                     class="h-10 w-auto rounded-lg shadow-lg transition-transform duration-500 group-hover:scale-110 group-hover:shadow-blue-200 group-hover:shadow-md" />
                <span class="sr-only">Jasa Raharja</span>
            </a>

            <!-- Responsive Menu -->
            <div x-data="{ menuOpen: false }" class="relative">
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                    class="flex items-center gap-2 bg-white/60 backdrop-blur-lg shadow-md px-4 py-2 rounded-full hover:scale-105 transition-all duration-300 border border-gray-200">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                                     alt="Avatar" class="h-8 w-8 rounded-full border border-white shadow-sm">
                                <span class="font-medium text-gray-800">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white/80 backdrop-blur-lg rounded-xl shadow-lg border border-gray-200 z-50">
                                <a href="{{ route('dashboard') }}"
                                   class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">Profil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/60 text-blue-600 border border-blue-500 rounded-full font-medium shadow hover:bg-blue-100 hover:scale-105 transition-all duration-300 backdrop-blur-lg">
                            <i data-feather="log-in" class="w-4 h-4"></i>
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-full font-medium shadow hover:bg-blue-700 hover:scale-105 transition-all duration-300">
                            <i data-feather="user-plus" class="w-4 h-4"></i>
                            Register
                        </a>
                    @endauth
                </div>

                <!-- Mobile Hamburger -->
                <div class="md:hidden flex items-center">
                    <button @click="menuOpen = !menuOpen" class="focus:outline-none">
                        <svg class="w-7 h-7 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Menu Dropdown -->
                <div x-show="menuOpen" @click.away="menuOpen = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="md:hidden absolute right-4 top-full mt-2 w-60 bg-white rounded-xl shadow-lg z-50 p-4 space-y-3">
                    @auth
                        <div class="flex items-center gap-3 border-b pb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                                 class="h-10 w-10 rounded-full shadow border border-white">
                            <div>
                                <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-500">Pengguna</p>
                            </div>
                        </div>
                        <a href="{{ route('dashboard') }}"
                           class="block text-sm px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="block w-full text-left text-sm px-3 py-2 rounded-md text-red-600 hover:bg-red-100">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="block text-sm px-3 py-2 rounded-md text-blue-600 border border-blue-500 hover:bg-blue-100 text-center">Login</a>
                        <a href="{{ route('register') }}"
                           class="block text-sm px-3 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 text-center">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Konten -->
    <main class="max-w-7xl mx-auto py-6 px-4">
        @yield('content')
    </main>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#1547AE" fill-opacity="1" d="M0,96L40,112C80,128,160,160,240,181.3C320,203,400,213,480,186.7C560,160,640,96,720,101.3C800,107,880,181,960,192C1040,203,1120,149,1200,122.7C1280,96,1360,96,1400,96L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>

    <!-- Footer -->
    
  <footer class="text-white py-12 px-6 md:px-16 bg-[#1547AE]">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <div>
            <img src="{{ asset('images/logojr.jpg') }}" alt="Logo Jasa Raharja" class="h-16 mb-4">
            <h2 class="text-2xl font-semibold mb-2">Prototype Penyewaan Jasa Raharja Semarang</h2>
            <p class="text-sm">Jl. Imam Bonjol No.152, Pendrikan Kidul</p>
            <p class="text-sm">Telp: (024) 3558089</p>
            <p class="text-sm">WA: 0811 2779 989</p>
            <div class="flex mt-4 space-x-4 text-white text-2xl">
                <a href="#" class="hover:text-gray-300 transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-gray-300 transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-gray-300 transition"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div>
            <h3 class="text-lg font-semibold mb-4">Lokasi Kami</h3>
            <div class="rounded-xl overflow-hidden shadow-lg border border-blue-100">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2698767823786!2d110.41215969999999!3d-6.9774506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70f4ad7715595b%3A0xbcfa620d91a5702e!2sJasa%20Raharja%20Semarang!5e0!3m2!1sid!2sid!4v1753338907287!5m2!1sid!2sid"
                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <div class="mt-10 border-t border-white/20 pt-6 text-center text-sm text-white/80">
        &copy; {{ date('Y') }} Jasa Raharja Semarang. All rights reserved.
    </div>
</footer>



    <!-- Tombol Chat Admin WhatsApp -->
    <a href="https://wa.me/6281218878792" target="_blank"
       class="fixed bottom-6 right-6 z-50 bg-green-500 text-white px-5 py-3 rounded-full flex items-center shadow-xl hover:bg-green-600 hover:scale-105 transition-all duration-300 animate-chat-pulse ring-2 ring-green-300 ring-opacity-50">
        <img src="https://img.icons8.com/ios-filled/24/ffffff/whatsapp.png" alt="WA" class="mr-2 animate-bounce-slow" />
        <span class="font-semibold text-sm tracking-wide">Tanya CS</span>
    </a>


    <style>
        @keyframes chatFadeIn {
            0% {
                opacity: 0;
                transform: translateY(40px) scale(0.9);
        
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
            }
            50% {
                box-shadow: 0 0 20px 10px rgba(34, 197, 94, 0.4);
            }
        }

        @keyframes bounceSlow {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-4px);
            }
        }

        .animate-chat-pulse {
            animation: chatFadeIn 0.7s ease-out, pulseGlow 2s infinite ease-in-out;
        }

        .animate-bounce-slow {
            animation: bounceSlow 2.5s infinite;
        }
    </style>

    <!-- SwiperJS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
  AOS.init();
</script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sliders = document.querySelectorAll('[class^="mySwiper"]');
            sliders.forEach((el) => {
                new Swiper('.' + el.classList[1], {
                    loop: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            });
        });
    </script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
    

    @stack('scripts')

</body>
</html>

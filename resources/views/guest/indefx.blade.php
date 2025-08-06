@extends('layouts.landing')

@section('content')
<!-- Hero Section -->

<section id="hero" class="relative w-full overflow-hidden group">
    <div id="sliderContainer" class="relative flex w-full h-screen md:h-[80vh] lg:h-[90vh] transition-transform duration-700 ease-in-out">
        @php
            $heroData = [
                [
                    'image' => 'images/awal.jpg',
                    'caption' => 'Selamat Datang di Jasa Raharja Semarang',
                    'sub' => 'Pusat Penyewaan Gedung & Ruangan Resmi'
                ],
                [
                    'image' => 'images/foto1.jpg',
                    'caption' => 'Area Parkir Depan yang Luas',
                    'sub' => 'Kenyamanan Tamu Dimulai Sejak Kedatangan'
                ],
                [
                    'image' => 'images/lobby.jpg',
                    'caption' => 'Lobby Utama yang Nyaman & Modern',
                    'sub' => 'Ruang Tunggu Blok A - Representatif & Bersih'
                ],
                [
                    'image' => 'images/mushola.jpg',
                    'caption' => 'Fasilitas Mushola Lengkap',
                    'sub' => 'Kenyamanan Ibadah di Lingkungan Gedung'
                ],
                [
                    'image' => 'images/parkir.jpg',
                    'caption' => 'Parkir Belakang yang Aman & Luas',
                    'sub' => 'Akses Kendaraan Blok A dengan Keamanan Terjaga'
                ],
            ];
        @endphp

        @foreach ($heroData as $data)
            <div class="w-full flex-shrink-0 h-full relative">
                <img src="{{ asset($data['image']) }}" alt="Slide" class="w-full h-full object-cover" />

                <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>

                <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white px-4 z-20">
                    <div class="bg-black bg-opacity-50 backdrop-blur-md px-6 py-4 rounded-lg max-w-xl w-full mb-4">
                        <h1 class="text-2xl sm:text-3xl md:text-5xl font-bold mb-2 drop-shadow-lg">
                            {{ $data['caption'] }}
                        </h1>
                        <p class="text-sm sm:text-base">
                            {{ $data['sub'] ?? 'e-Catalog Aset Perum BULOG' }}
                        </p>
                    </div>
                    <button class="bg-orange-500 hover:bg-orange-600 px-6 py-2 text-white rounded-full font-semibold shadow-lg transition duration-300 mb-4">
                        LIHAT
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Navigation Arrows -->
    <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/40 text-white rounded-full p-2 hover:bg-black/70 transition z-30 hidden group-hover:block">
        &#10094;
    </button>
    <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/40 text-white rounded-full p-2 hover:bg-black/70 transition z-30 hidden group-hover:block">
        &#10095;
    </button>

    <!-- Indicators -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-30 flex space-x-2" id="sliderIndicators">
        @foreach ($heroData as $index => $item)
            <div class="indicator w-3 h-3 rounded-full bg-white opacity-50 transform transition-all duration-300" data-index="{{ $index }}"></div>
        @endforeach
    </div>
</section>


<hr class="my-20 border-t-2 border-gray-200 w-3/4 mx-auto">

<!-- Tentang Website -->
<section class="max-w-7xl mx-auto px-4 py-20 mt-12 grid md:grid-cols-2 gap-14 items-center animate-fade-in-up">

    <!-- Slider Gambar -->
    <div class="relative group overflow-hidden rounded-2xl shadow-lg">
        <div id="aboutSlider" class="relative flex transition-transform duration-700 ease-in-out">
            @php
                $aboutImages = [
                    'images/awal.jpg',
                    'images/foto1.jpg',
                    'images/lobby.jpg',
                ];
            @endphp
            @foreach ($aboutImages as $img)
                <img src="{{ asset($img) }}" alt="Tentang Website" class="w-full h-96 object-cover flex-shrink-0" />
            @endforeach
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
    </div>

    <!-- Konten Deskripsi -->
    <div class="text-gray-800">
        <h2 class="text-3xl md:text-4xl font-bold mb-5 leading-snug text-blue-800">
            Tentang Sistem Penyewaan Ini
        </h2>
        <p class="text-base md:text-lg leading-relaxed mb-6 text-gray-600">
            Sistem ini merupakan <strong>prototipe website resmi</strong> untuk layanan penyewaan gedung dan ruangan milik <strong>Jasa Raharja Semarang</strong>. Dirancang sebagai solusi digital yang informatif dan efisien, website ini mempermudah proses pencarian dan pemesanan ruang sesuai kebutuhan pengguna.
        </p>
       
    </div>
</section>

<hr class="my-20 border-t-2 border-gray-200 w-3/4 mx-auto">

<section class="text-center mt-12 mb-6">
    <!-- Judul -->
    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
        Ruang dan Gedung Strategis di Jantung Kota Semarang
    </h1>
    <p class="text-gray-600 text-base md:text-lg max-w-3xl mx-auto">
        Sewa ruang dan gedung milik Jasa Raharja dengan lokasi premium, fasilitas lengkap, dan kenyamanan terbaik untuk mendukung aktivitas bisnis, acara, atau operasional Anda di Kota Semarang.
    </p>

    <!-- Filter Kategori -->
    <div class="mt-10 mb-4 flex justify-center gap-4 flex-wrap">
        <a href="{{ route('home') }}" class="px-5 py-2 border rounded-lg font-medium transition {{ is_null($kategori) ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">Semua</a>
        <a href="{{ route('home', ['kategori' => 'gedung']) }}" class="px-5 py-2 border rounded-lg font-medium transition {{ $kategori == 'gedung' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">Gedung</a>
        <a href="{{ route('home', ['kategori' => 'rumah_dinas']) }}" class="px-5 py-2 border rounded-lg font-medium transition {{ $kategori == 'rumah_dinas' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">Rumah Dinas</a>
        <a href="{{ route('home', ['kategori' => 'lain']) }}" class="px-5 py-2 border rounded-lg font-medium transition {{ $kategori == 'lain' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">Lain-lain</a>
    </div>

   <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
    @forelse ($products as $product)
    <div class="bg-white p-5 rounded-2xl shadow-md border transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group relative overflow-hidden">
        <div class="mb-3 relative overflow-hidden rounded-xl">
            @if ($product->images->count() > 0)
                <a href="{{ route('produk.detail', $product->slug) }}" class="block relative group">
                    <!-- Gambar -->
                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                         class="w-full h-48 object-cover rounded-xl transition-transform duration-300 group-hover:scale-105" />

                    <!-- Strip Tengah Sudah Disewa -->
                    @if ($product->status == 'sudah_disewa')
                        <div class="absolute top-1/2 left-0 w-full transform -translate-y-1/2 bg-black bg-opacity-60 py-2 text-center rounded-b-xl">
                            <span class="text-white font-bold text-lg tracking-wide">SUDAH DISEWA</span>
                        </div>
                    @endif
                </a>
            @else
                <div class="bg-gray-200 w-full h-48 flex items-center justify-center rounded-xl">No Image</div>
            @endif
        </div>

        <div class="text-left">
            <h3 class="text-lg font-semibold text-gray-800">
                <a href="{{ route('produk.detail', $product->slug) }}" class="hover:underline">{{ $product->name }}</a>
            </h3>
            <p class="text-sm text-gray-600 mt-1">Rp{{ number_format($product->harga) }}</p>
            <p class="text-xs text-gray-500 mb-2">Kategori: {{ ucfirst(str_replace('_', ' ', $product->kategori)) }}</p>

            @if ($product->status == 'tersedia')
                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full animate-pulse">
                    <svg class="w-3 h-3 fill-green-500" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                    Tersedia
                </span>
            @else
                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">
                    <svg class="w-3 h-3 fill-red-500" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
                    Sudah Disewa
                </span>
            @endif
                            <!-- Tanggal -->
                @if ($product->tanggal_disewa_terakhir)
                    <p class="text-xs text-gray-500 mt-1">
                        Terakhir disewa: {{ \Carbon\Carbon::parse($product->tanggal_disewa_terakhir)->format('d M Y H:i') }}
                    </p>
                @endif
                @if ($product->tanggal_tersedia)
                    <p class="text-xs text-gray-500">
                        Tersedia mulai: {{ \Carbon\Carbon::parse($product->tanggal_tersedia)->format('d M Y H:i') }}
                    </p>
                @endif

            <!-- Tombol Lihat Detail -->
            <div class="mt-4">
                <a href="{{ route('produk.detail', $product->slug) }}"
                   class="inline-block w-full text-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-all duration-300 hover:scale-[1.02]">
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>
    @empty
    <p class="col-span-3 text-gray-500">Tidak ada produk ditemukan.</p>
    @endforelse
</div>

</section>




<!-- Cara Pemesanan -->
<div class="mt-12 bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-2xl shadow-lg">
  <h2 class="text-2xl font-bold text-blue-800 mb-4 flex items-center gap-2">
    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
      viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m-3 4a9 9 0 100-18 9 9 0 000 18z">
      </path>
    </svg>
    Cara Pemesanan
  </h2>
  <ul class="space-y-3 text-gray-700 text-[15px]">
    <li class="flex items-start gap-3">
      <span class="text-blue-500">
        <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M5 13l4 4L19 7"></path>
        </svg>
      </span>
      Login terlebih dahulu ke akun tamu
    </li>
    <li class="flex items-start gap-3">
      <span class="text-blue-500">
        <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M5 13l4 4L19 7"></path>
        </svg>
      </span>
      Pilih produk yang ingin disewa
    </li>
    <li class="flex items-start gap-3">
      <span class="text-blue-500">
        <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M5 13l4 4L19 7"></path>
        </svg>
      </span>
      Klik tombol <strong>“Hubungi Admin via WhatsApp”</strong>
    </li>
    <li class="flex items-start gap-3">
      <span class="text-blue-500">
        <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M5 13l4 4L19 7"></path>
        </svg>
      </span>
      Admin akan konfirmasi ketersediaan dan status sewa
    </li>
    <li class="flex items-start gap-3">
      <span class="text-blue-500">
        <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M5 13l4 4L19 7"></path>
        </svg>
      </span>
      Pembayaran langsung dilakukan ke admin
    </li>
  </ul>
</div>

@endsection

@push('scripts')
@if(session('login_success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: 'Berhasil Masuk',
            text: 'Selamat datang kembali!',
            icon: 'success',
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>
@endif

document.addEventListener('DOMContentLoaded', () => {
    const aboutSlider = document.getElementById('aboutSlider');
    const slides = aboutSlider.children;
    const totalSlides = slides.length;
    let index = 0;

    setInterval(() => {
        index = (index + 1) % totalSlides;
        aboutSlider.style.transform = `translateX(-${index * 100}%)`;
    }, 4000);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sliderContainer = document.getElementById('sliderContainer');
    const slides = sliderContainer.children;
    const totalSlides = slides.length;
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const indicators = document.querySelectorAll('.indicator');

    let currentIndex = 0;
    let autoSlideInterval = null;

    function goToSlide(index) {
        currentIndex = (index + totalSlides) % totalSlides;
        sliderContainer.style.transform = `translateX(-${currentIndex * 100}%)`;

        updateIndicators();
    }

    function nextSlide() {
        goToSlide(currentIndex + 1);
    }

    function prevSlide() {
        goToSlide(currentIndex - 1);
    }

    function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 5000);
    }

    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    function updateIndicators() {
        indicators.forEach((dot, i) => {
            dot.classList.toggle('opacity-100', i === currentIndex);
            dot.classList.toggle('opacity-50', i !== currentIndex);
            dot.classList.toggle('scale-125', i === currentIndex);
            dot.classList.toggle('scale-100', i !== currentIndex);
        });
    }

    indicators.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            stopAutoSlide();
            goToSlide(i);
            startAutoSlide();
        });
    });

    nextBtn.addEventListener('click', () => {
        stopAutoSlide();
        nextSlide();
        startAutoSlide();
    });

    prevBtn.addEventListener('click', () => {
        stopAutoSlide();
        prevSlide();
        startAutoSlide();
    });

    startAutoSlide();
    updateIndicators();
});
</script>
@endpush
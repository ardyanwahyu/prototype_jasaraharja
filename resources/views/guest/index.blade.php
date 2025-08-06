@extends('layouts.landing')

@section('content')

<section id="hero" class="relative w-full overflow-hidden group">
    <div id="sliderContainer" class="relative flex w-full h-screen md:h-[80vh] lg:h-[90vh] transition-transform duration-700 ease-in-out">
        @php
            $heroData = [
                [
                    'image' => 'images/awal.jpg',
                    'caption' => 'Selamat Datang di Jasa Raharja Semarang',
                    'sub' => 'Prototype Penyewaan Gedung & Ruangan Resmi'
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




<!-- Tentang Website -->
<section class="py-24" style="background-color: #dbeafe;" id="tentang">
    <div class="max-w-4xl mx-auto px-6 md:px-12 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-blue-900 mb-8">
            Tentang <span class="text-blue-600">Website</span>
        </h2>
        <div class="text-gray-800 text-justify text-lg leading-relaxed space-y-6">
            <p>
                Website ini merupakan sistem informasi penyewaan gedung milik <strong>Jasa Raharja Semarang</strong> 
                yang mempermudah masyarakat dalam melakukan reservasi secara online. Melalui platform ini, pengguna 
                dapat mengecek ketersediaan ruangan, melihat detail fasilitas gedung, serta melakukan pemesanan 
                dengan lebih cepat dan efisien.
            </p>
            <p>
                Dengan tampilan antarmuka yang ramah pengguna dan sistem yang saling terintegrasi, website ini 
                hadir sebagai solusi modern untuk memenuhi kebutuhan reservasi ruangan secara praktis dan real-time. 
                Dukungan dari tim admin juga memungkinkan penanganan permintaan lebih responsif, profesional, dan 
                transparan.
            </p>

        </div>
    </div>
</section>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#dbeafe" fill-opacity="1" d="M0,128L60,122.7C120,117,240,107,360,133.3C480,160,600,224,720,224C840,224,960,160,1080,138.7C1200,117,1320,139,1380,149.3L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>


<section class="text-center mt-24 mb-12">
  <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-snug">
    Ruang & Gedung Strategis di Jantung Kota Semarang
  </h1>
  <p class="text-gray-600 text-base md:text-lg max-w-2xl mx-auto">
    Temukan pilihan ruang dan gedung eksklusif milik Jasa Raharja untuk bisnis, acara, atau kebutuhan operasional Anda.
  </p>

 <!-- FILTER & SEARCH UI CANTIK -->
<div class="mt-10 mb-10 px-6 max-w-6xl mx-auto space-y-6">

    <!-- Search Bar -->
<!-- Search Bar Elegan -->
<div class="w-full">
  <input
    type="text"
    id="searchInput"
    placeholder="Cari ruang atau gedung berdasarkan nama..."
    class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm placeholder-gray-400 transition-all duration-200"
  />
</div>


    <!-- Filter Kategori -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @foreach ([
            ['label' => 'Semua', 'value' => null],
            ['label' => 'Gedung', 'value' => 'gedung'],
            ['label' => 'Rumah Dinas', 'value' => 'rumah_dinas'],
            ['label' => 'Lain-lain', 'value' => 'lain'],
        ] as $filter)
        <a href="{{ route('home', ['kategori' => $filter['value']]) }}"
           class="block text-center border rounded-xl py-3 px-4 font-semibold text-sm transition-all duration-200
           {{ $kategori == $filter['value'] || (is_null($filter['value']) && is_null($kategori)) 
               ? 'bg-blue-600 text-white shadow-md border-blue-600'
               : 'bg-white text-gray-800 hover:border-blue-400 hover:shadow-sm' }}">
            {{ $filter['label'] }}
        </a>
        @endforeach
    </div>
</div>


  <!-- Grid Produk -->
  <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-6 transition-all duration-300">
    @forelse ($products as $product)
    <div class="product-card bg-white border border-gray-100 rounded-3xl shadow-md hover:shadow-xl hover:-translate-y-1 group relative overflow-hidden transition-all duration-300"

         data-name="{{ strtolower($product->name) }}">
<a href="{{ route('produk.detail', $product->slug) }}" class="block overflow-hidden rounded-t-2xl relative group">
    @if ($product->images->count() > 0)
        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
             alt="{{ $product->name }}"
             class="w-full h-52 object-cover group-hover:scale-105 transition duration-300" />
    @else
        <div class="w-full h-52 bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
            No Image
        </div>
    @endif

    {{-- Label "Segera Tersedia" --}}
    @php
        $availableSoon = \Carbon\Carbon::parse($product->tanggal_tersedia)->diffInDays(now()) <= 7;
    @endphp
    @if ($availableSoon)
<div class="absolute top-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded shadow uppercase font-semibold tracking-wide">
    Recommended
</div>

    @endif

    {{-- Overlay "SUDAH DISEWA" --}}
    @if ($product->status != 'tersedia')
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <span class="text-white font-bold text-lg">SUDAH DISEWA</span>
        </div>
    @endif
</a>


      <div class="p-5 text-left space-y-3">

 <!-- Nama Gedung -->
<h3 class="text-lg font-bold text-gray-800 leading-snug hover:text-blue-600 transition-colors duration-200">

  <a href="{{ route('produk.detail', $product->slug) }}"
     class="hover:text-blue-600 transition-colors duration-200">
    {{ $product->name }}
  </a>
</h3>

<!-- Harga -->
<div class="mt-1 flex items-baseline gap-1 text-sm text-gray-600">
  <span class="text-xs font-medium text-gray-400">Start from</span>
  <span class="text-blue-700 font-extrabold text-lg">
    Rp{{ number_format($product->harga, 0, ',', '.') }}
  </span>
</div>


<!-- Kategori + Status -->
<div class="flex items-center gap-2 mt-2">
  <span class="inline-block bg-blue-100 text-blue-700 text-[11px] font-semibold px-3 py-0.5 rounded-full">
    {{ ucfirst(str_replace('_', ' ', $product->kategori)) }}
  </span>
  @if ($product->status == 'tersedia')
    <span class="inline-flex items-center text-[11px] text-green-700 bg-green-100 rounded-full px-2 py-0.5 animate-pulse">
      <svg class="w-2 h-2 fill-green-500 mr-1" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
      Tersedia
    </span>
  @else
    <span class="inline-flex items-center text-[11px] text-red-700 bg-red-100 rounded-full px-2 py-0.5">
      <svg class="w-2 h-2 fill-red-500 mr-1" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>
      Sudah Disewa
    </span>
  @endif
</div>

<!-- Luas dan Fasilitas -->
<div class="mt-2 space-y-1 text-[11.5px] text-gray-600 leading-snug">

<!-- Luas -->
<div class="flex items-center gap-2">
  <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16M8 4v16" />
  </svg>
  <span>Luas: <span class="font-medium ">{{ $product->luas }} m²</span></span> 
</div>




</div>


  <!-- Informasi Waktu -->
  <div class="text-xs text-gray-500 space-y-1 mt-2">
    @if ($product->tanggal_disewa_terakhir)
      <p>Terakhir disewa: {{ \Carbon\Carbon::parse($product->tanggal_disewa_terakhir)->format('d M Y H:i') }}</p>
    @endif
    @if ($product->tanggal_tersedia)
      <p>Tersedia mulai: {{ \Carbon\Carbon::parse($product->tanggal_tersedia)->format('d M Y H:i') }}</p>
    @endif
  </div>




<a href="{{ route('produk.detail', $product->slug) }}"
   class="mt-4 inline-block w-full text-center bg-blue-600 text-white text-sm font-semibold rounded-lg py-2
          transform transition-all duration-300 ease-in-out
          hover:bg-blue-700 hover:scale-105 hover:shadow-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
    Lihat Detail
</a>

      </div>
    </div>
    @empty
    <p class="col-span-3 text-gray-500 text-center">Tidak ada produk ditemukan.</p>
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


<script>
  document.getElementById('searchInput').addEventListener('input', function () {
    const keyword = this.value.toLowerCase();
    const cards = document.querySelectorAll('.product-card');
    cards.forEach(card => {
      const name = card.dataset.name;
      card.style.display = name.includes(keyword) ? 'block' : 'none';
    });
  });
</script>









@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const slider = document.getElementById('heroSlider');
    const slides = slider.children;
    const totalSlides = slides.length;
    const prevBtn = document.getElementById('prevHero');
    const nextBtn = document.getElementById('nextHero');

    let index = 0;
    let interval = null;

    function goToSlide(i) {
        index = (i + totalSlides) % totalSlides;
        slider.style.transform = `translateX(-${index * 100}vw)`;
    }

    function startAutoSlide() {
        interval = setInterval(() => {
            goToSlide(index + 1);
        }, 5000);
    }

    function stopAutoSlide() {
        clearInterval(interval);
    }

    prevBtn.addEventListener('click', () => {
        stopAutoSlide();
        goToSlide(index - 1);
        startAutoSlide();
    });

    nextBtn.addEventListener('click', () => {
        stopAutoSlide();
        goToSlide(index + 1);
        startAutoSlide();
    });

    startAutoSlide();
});
</script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('aboutSlider');
    let index = 0;
    setInterval(() => {
        index = (index + 1) % 3;
        slider.style.transform = `translateX(-${index * 100}%)`;
    }, 3000); // ganti gambar tiap 3 detik
});

</script>
@endpush




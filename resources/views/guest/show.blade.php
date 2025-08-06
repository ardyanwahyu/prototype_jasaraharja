@extends('layouts.landing')

@section('content')
<!-- FullCalendar CDN -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>



<style>
    .fc .fc-daygrid-day.fc-day-today,
    #calendar td.fc-day-today {
        background-color: #dbeafe !important;
    }
    #mainProductImage {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    #mainProductImage.clicked-fade-in {
        opacity: 0;
        transform: scale(0.95);
        animation: fadeInPop 0.4s ease-out forwards;
    }
    @keyframes fadeInPop {
        0% {
            opacity: 0;
            transform: scale(0.95);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>

<section class="max-w-6xl mx-auto px-4 mt-16">
  <div class="bg-white border border-blue-100 rounded-2xl shadow-xl p-6 md:p-10 transition-all duration-500" data-aos="fade-up">


    <!-- Tab Deskripsi -->
    <div id="tab-deskripsi" class="tab-content">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">

        <!-- Gambar Produk -->
        <div class="space-y-4 order-1 md:order-2">
          <div class="relative rounded-xl overflow-hidden shadow-lg aspect-video">
            <img id="mainProductImage" src="{{ asset('storage/' . $product->images->first()->image_path) }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" alt="Gambar Produk">
            @if ($product->status === 'disewa')
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
              <span class="text-white text-lg md:text-2xl font-bold bg-red-600 px-4 py-2 rounded-xl shadow-lg animate-fade-in">SUDAH DISEWA</span>
            </div>
            @endif
          </div>
<div class="flex gap-3 justify-center overflow-x-auto scrollbar-hide">
  @foreach ($product->images->take(6) as $index => $image)
    <img src="{{ asset('storage/' . $image->image_path) }}"
         onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')"
         class="w-20 h-20 object-cover rounded border hover:scale-105 transition cursor-pointer"
         alt="Thumbnail {{ $index + 1 }}">
  @endforeach

  @if ($product->images->count() > 6)
    <div class="w-20 h-20 flex items-center justify-center bg-gray-100 text-gray-600 font-semibold rounded border text-sm">
      +{{ $product->images->count() - 6 }} lagi
    </div>
  @endif
</div>

        </div>

        <!-- Deskripsi Produk -->
        <div class="space-y-6 text-gray-800 order-2 md:order-1">
          <div class="flex items-center gap-3 flex-wrap">
            <span class="inline-block bg-yellow-300 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full shadow-sm">RECOMMENDED</span>
            @if ($product->status === 'tersedia')
              <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full shadow shadow-green-200 animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Tersedia
              </span>
            @else
              <span class="inline-flex items-center gap-2 bg-red-50 text-red-700 text-xs font-bold px-3 py-1 rounded-full border border-red-200 shadow-sm animate-fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-600 animate-ping-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Sudah Disewa
              </span>
            @endif
          </div>

          <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
<p class="text-sm text-gray-600 leading-relaxed text-justify">{{ $product->description }}</p>


<div class="flex flex-col md:flex-row gap-4 items-stretch">
  <!-- Spesifikasi -->
<div class="flex-1 bg-slate-50 border border-blue-100 p-4 rounded-xl w-full">
  <h3 class="text-blue-700 font-semibold mb-2">Spesifikasi Umum:</h3>
  <ul class="text-sm space-y-1 text-justify">
<li><strong>Luas:</strong>
  {{ is_numeric($product->luas) ? number_format($product->luas, 0, ',', '.') . ' m²' : ($product->luas ?? '-') }}
</li>

    <li><strong>Fasilitas:</strong> {{ $product->fasilitas ?? '-' }}</li>
    <li><strong>Kategori:</strong> {{ $product->kategori ?? '-' }}</li>
  </ul>
</div>


  <!-- Harga -->
  <div class="flex-1 bg-green-50 border border-green-200 p-6 rounded-xl shadow-inner w-full flex flex-col justify-center items-center">
    <div class="text-gray-600 text-sm">Harga Sewa</div>
    <div class="text-2xl md:text-3xl font-bold text-green-700 mt-1">
      Rp{{ number_format($product->harga, 0, ',', '.') }}
    </div>
    <div class="text-xs text-gray-400 mt-1">/ per waktu sewa</div>
@if($product->keterangan)
  <div class="mt-4">
    <h4 class="font-semibold text-sm mb-1">Keterangan Tambahan:</h4>
   <p class="text-sm text-gray-700 leading-relaxed text-left">

      {!! nl2br(e($product->keterangan)) !!}
    </p>
  </div>
@endif

  </div>
</div>




@if ($product->lokasi_maps)
<div class="mt-4 flex flex-wrap gap-3 items-center">
  <!-- Tombol Lihat Lokasi -->
  <button onclick="openMapModal('{{ $product->lokasi_maps }}')" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-200 shadow-inner hover:shadow-md transition-all duration-300 group">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A2 2 0 013 15.382V5.618a2 2 0 011.553-1.948L9 2m0 0l6 3m0 0l5.447 2.724A2 2 0 0121 8.618v9.764a2 2 0 01-1.553 1.948L15 22m-6-3v-7" />
    </svg>
    <span class="font-medium">Lihat Lokasi di Peta</span>
  </button>

  <!-- Tombol Info Admin -->
  <button onclick="toggleModal()" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gray-800 hover:bg-gray-900 text-white shadow-inner hover:shadow-md transition-all duration-300">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m0-4h.01M12 18a9 9 0 110-18 9 9 0 010 18z" />
    </svg>
 <span class="font-medium">Alur Pemesanan</span>
  </button>
</div>
@endif

<!-- Modal Info Admin -->
<div id="modalAdmin" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative animate-fade-in">
    <h2 class="text-xl font-bold text-gray-800 mb-3">Cara Melakukan Pemesanan</h2>
    
    <ol class="list-decimal pl-5 space-y-1 text-gray-700 text-[15px] leading-relaxed text-justify">
      <li>Telusuri berbagai pilihan Ruang dan Gedung yang tersedia sesuai kebutuhan Anda.</li>
      <li>Baca dengan saksama deskripsi, fasilitas, dan lokasi setiap ruang yang ditawarkan.</li>
      <li>Pastikan tanggal ketersediaan ruang sesuai dengan jadwal Anda.</li>
      <li>Jika sudah sesuai, klik tombol "Hubungi via WhatsApp" untuk melakukan konfirmasi.</li>
      <li>Admin kami akan merespon dengan cepat untuk membantu proses pemesanan.</li>
      <li>Lakukan pembayaran sesuai instruksi yang diberikan oleh admin.</li>
      <li>Setelah pembayaran terverifikasi, ruang akan langsung dikonfirmasi dan siap digunakan.</li>
    </ol>

    <button onclick="toggleModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-lg font-bold">
      ✕
    </button>
  </div>
</div>



          <!-- WhatsApp Button -->
          <div class="mt-8 bg-green-50 border border-green-200 rounded-xl p-4 shadow-lg space-y-4 animate-fade-in-up">
            <div class="flex items-start gap-3">
              <div class="bg-green-200 text-green-800 rounded-full p-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6" />
                </svg>
              </div>
              <p class="text-sm text-green-700">Jika kamu ingin melakukan pemesanan atau bertanya langsung kepada admin, silakan klik tombol WhatsApp di bawah ini.</p>
            </div>

            @auth
            <div class="text-center">
              <a href="https://wa.me/6281218878792?text=Halo%20Admin,%20saya%20tertarik%20dengan%20produk:%20{{ $product->name }}" target="_blank" class="inline-flex items-center gap-3 px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-full shadow-xl transition-all transform hover:scale-105 duration-300">
                <i class="fab fa-whatsapp text-xl animate-pulse"></i> Hubungi via WhatsApp
              </a>
            </div>
            @else
            <div class="text-center space-y-2">
              <p class="text-sm text-red-500 italic">*Silakan login terlebih dahulu untuk menghubungi admin.</p>
              <a href="{{ route('login') }}" class="inline-block px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-md transition hover:scale-105">Login</a>
            </div>
            @endauth
          </div>



          <!-- Modal Map -->
          <div id="mapModal" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg shadow-lg w-[90%] max-w-3xl relative">
              <button onclick="closeMapModal()" class="absolute top-2 right-2 text-gray-700 text-xl">&times;</button>
              <div class="p-4">
                <iframe id="mapIframe" width="100%" height="450" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  <!-- Bagian Kalender Sekarang DI LUAR TAB -->


    </div>

  </div>
</section>

<section class="mt-10 py-12 border-t border-gray-200">
  <div class="max-w-4xl mx-auto px-4">
    <!-- Judul & Ikon -->
    <div class="flex items-center justify-center gap-3 mb-6">
      <div class="bg-blue-100 p-3 rounded-full shadow">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
      </div>
      <h3 class="text-xl md:text-2xl font-bold text-gray-800">Kalender Ketersediaan Jadwal Sewa</h3>
    </div>

    <!-- FullCalendar -->
    <div id="calendar" class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200"></div>

    <!-- Keterangan Warna -->
    <div class="mt-6 flex items-center justify-center gap-6 text-sm text-gray-600">
      <div class="flex items-center gap-2">
        <div class="w-4 h-4 bg-red-500 rounded"></div>
        <span>Tidak Tersedia</span>
      </div>
    </div>
  </div>
</section>
<!-- Modal Tidak Bisa Dipesan -->
<div id="unavailableModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-xl shadow-xl p-6 max-w-sm w-full relative">
    <button onclick="closeUnavailableModal()" class="absolute top-2 right-3 text-gray-500 hover:text-red-500 text-xl font-bold">&times;</button>
    <div class="text-center">
      <h2 class="text-lg font-bold text-red-600 mb-2">Tanggal Tidak Tersedia</h2>
      <p class="text-sm text-gray-700">Maaf, gedung tidak dapat dipesan pada tanggal ini karena sudah disewa.</p>
    </div>
    <div class="mt-4 text-center">
      <button onclick="closeUnavailableModal()" class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 shadow-md transition">Tutup</button>
    </div>
  </div>
</div>


<!-- Tutorial Pop-up -->
<div id="popupTutorial" class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300 ease-out animate-fade-in">
  <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6 relative transform transition-all duration-300 scale-100">
    <button onclick="closePopupTutorial()" class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-xl font-bold">&times;</button>
    <div class="text-center mb-4">
      <h2 class="text-2xl font-bold text-blue-700">📝 Cara Booking Gedung</h2>
      <p class="text-sm text-gray-500 mt-1">Ikuti langkah mudah berikut ini</p>
    </div>
 <ol class="list-decimal list-inside text-gray-700 space-y-3 text-[15px] leading-relaxed">
  <li><span class="font-medium text-gray-800">Login</span> ke akun Anda. Jika belum memiliki akun, silakan <span class="font-medium">daftar terlebih dahulu</span>.</li>
  <li><span class="font-medium text-gray-800">Pilih</span> gedung atau rumah dinas yang ingin disewa.</li>
  <li><span class="font-medium text-gray-800">Periksa</span> detail informasi dan kalender ketersediaan.</li>
  <li>Jika tersedia, klik tombol <span class="font-semibold text-green-600">"Hubungi via WhatsApp"</span> untuk melakukan pemesanan.</li>
  <li><span class="font-medium text-gray-800">Tunggu konfirmasi</span> dari admin untuk menyelesaikan proses pemesanan Anda.</li>
</ol>

    <div class="mt-6 text-center">
      <button onclick="closePopupTutorial()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full shadow-lg transition-transform hover:scale-105">Saya Mengerti</button>
    </div>
  </div>
</div>



<script>
  function toggleModal() {
    const modal = document.getElementById('modalAdmin');
    modal.classList.toggle('hidden');
  }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // FullCalendar init
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 450,
        contentHeight: 'auto',
        aspectRatio: 1.6,
        events: [
          @foreach ($bookedDates as $date)
            {
              title: 'Tidak Tersedia',
              start: '{{ $date }}',
              color: '#EF4444',
              textColor: '#fff'
            },
          @endforeach
        ],
        headerToolbar: {
          start: 'title',
          center: '',
          end: 'prev,next'
        },
        eventClick: function(info) {
          if (info.event.title === 'Tidak Tersedia') {
            document.getElementById('unavailableModal')?.classList.remove('hidden');
          }
        }
      });
      calendar.render();
    }

    // Pop-up Tutorial once per session
    const popupShown = sessionStorage.getItem('popupTutorialShown');
    if (!popupShown) {
      setTimeout(() => {
        document.getElementById('popupTutorial')?.classList.remove('hidden');
        sessionStorage.setItem('popupTutorialShown', 'true');
      }, 1000);
    }

    // Auto image slideshow
    const imageList = @json($product->images->pluck('image_path'));
    const mainImage = document.getElementById('mainProductImage');
    let currentImageIndex = 0;
    if (imageList.length > 1 && mainImage) {
      setInterval(() => {
        currentImageIndex = (currentImageIndex + 1) % imageList.length;
        mainImage.classList.add('opacity-0', 'scale-95');
        setTimeout(() => {
          mainImage.src = `/storage/${imageList[currentImageIndex]}`;
          mainImage.classList.remove('opacity-0', 'scale-95');
        }, 300);
      }, 5000);
    }

    // Click image animation
    if (mainImage) {
      mainImage.addEventListener('click', function () {
        mainImage.classList.remove('clicked-fade-in');
        void mainImage.offsetWidth;
        mainImage.classList.add('clicked-fade-in');
      });
    }
  });

  // Ganti gambar utama manual
  function changeMainImage(src) {
    const img = document.getElementById('mainProductImage');
    if (img) img.src = src;
  }

  // Buka modal peta
  function openMapModal(url) {
    document.getElementById('mapIframe').src = url;
    document.getElementById('mapModal').classList.remove('hidden');
  }

  // Tutup modal peta
  function closeMapModal() {
    document.getElementById('mapModal').classList.add('hidden');
    document.getElementById('mapIframe').src = '';
  }

  // Tutup tutorial pop-up
  function closePopupTutorial() {
    const popup = document.getElementById('popupTutorial');
    popup.classList.add('opacity-0', 'scale-95');
    setTimeout(() => {
      popup.classList.add('hidden');
      popup.classList.remove('opacity-0', 'scale-95');
    }, 300);
  }

  // Tutup modal tanggal tidak tersedia
  function closeUnavailableModal() {
    document.getElementById('unavailableModal')?.classList.add('hidden');
  }
</script>

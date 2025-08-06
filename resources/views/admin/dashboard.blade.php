@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 mb-8">📊 Dashboard Admin</h1>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <div class="bg-white p-6 rounded-2xl shadow-md border border-blue-100 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-gray-500 font-medium">Total Produk</span>
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M20 13V7a2 2 0 00-2-2h-4l-2-2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2z"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $totalProduk }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-md border border-green-100 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-gray-500 font-medium">Gedung</span>
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 21v-6a2 2 0 012-2h2V9a2 2 0 012-2h4a2 2 0 012 2v4h2a2 2 0 012 2v6"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $totalGedung }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-md border border-yellow-100 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-gray-500 font-medium">Rumah Dinas</span>
                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 12l2-2m0 0l7-7 7 7m-9 0v10m4 0v-6h4v6"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $totalRumahDinas }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-md border border-purple-100 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-gray-500 font-medium">Lain-lain</span>
                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 9l3-3 3 3m0 6l-3 3-3-3"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $totalLain }}</p>
        </div>
    </div>

    <!-- Daftar Produk -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">🗂️ Daftar Produk</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($products as $product)
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
        {{-- Gambar --}}
        @if ($product->images->count() > 0)
            <div x-data="{ active: 0 }" class="relative w-full h-48 overflow-hidden">
                <template x-for="(img, index) in {{ json_encode($product->images->pluck('image_path')) }}" :key="index">
                    <img x-show="active === index"
                         :src="'/storage/' + img"
                         class="w-full h-48 object-cover absolute inset-0 transition-opacity duration-300 ease-in-out">
                </template>

                {{-- Tombol navigasi carousel --}}
                <button @click="active = (active - 1 + {{ $product->images->count() }}) % {{ $product->images->count() }}"
                        class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-600 px-2 py-1 rounded-full shadow-sm text-xs">
                    ‹
                </button>
                <button @click="active = (active + 1) % {{ $product->images->count() }}"
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-600 px-2 py-1 rounded-full shadow-sm text-xs">
                    ›
                </button>
            </div>
        @else
            <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                Tidak ada gambar
            </div>
        @endif

        {{-- Konten --}}
        <div class="p-4 flex flex-col gap-2">
            <h3 class="text-base font-semibold text-gray-800 truncate">{{ $product->name }}</h3>
            <p class="text-sm text-gray-700">Rp{{ number_format($product->harga) }}</p>
            <p class="text-sm">
                Status:
                <span class="font-medium {{ $product->status === 'tersedia' ? 'text-green-600' : 'text-red-500' }}">
                    {{ ucfirst($product->status) }}
                </span>
            </p>
            <p class="text-sm text-gray-500">Kategori: {{ ucfirst(str_replace('_', ' ', $product->kategori)) }}</p>

            {{-- Tombol Aksi --}}
            <div class="flex gap-2 mt-2">
                <a href="{{ route('admin.products.edit', $product->id) }}"
                   class="flex-1 inline-flex justify-center items-center px-3 py-1.5 text-sm text-white bg-blue-500 hover:bg-blue-600 rounded-md transition">
                    ✏️ Edit
                </a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full inline-flex justify-center items-center px-3 py-1.5 text-sm text-white bg-red-500 hover:bg-red-600 rounded-md transition">
                        🗑️ Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@empty
    <p class="text-gray-600 col-span-3 text-center">Belum ada produk ditambahkan.</p>
@endforelse

    </div>
@endsection

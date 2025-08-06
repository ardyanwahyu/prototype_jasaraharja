@extends('layouts.admin')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-800 flex items-center gap-2">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path d="M3 3h18v18H3V3z" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 3v18M15 3v18M3 9h18M3 15h18" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Data Produk
        </h2>
        <p class="text-sm text-gray-500 mt-1">Kelola semua daftar produk dan status penyewaannya.</p>
    </div>

    <a href="{{ route('admin.products.create') }}"
       class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-medium px-5 py-2.5 rounded-lg shadow-lg hover:scale-105 hover:from-green-600 hover:to-emerald-600 transition-all duration-300">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4v16m8-8H4" />
        </svg>
        Tambah Produk
    </a>
</div>


    <div class="mt-6 overflow-x-auto rounded-lg shadow border border-gray-200">
        <table class="min-w-full text-sm text-gray-800">
            <thead class="bg-gray-100 text-left text-xs uppercase tracking-wider text-gray-600">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Terakhir Disewa</th>
                    <th class="px-6 py-4">Tersedia Mulai</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($products as $product)
                    <tr class="hover:bg-blue-50 transition duration-200 animate-fade-in">
                        <td class="px-6 py-4 font-medium">{{ $product->name }}</td>
                        <td class="px-6 py-4 capitalize">
                            {{ $product->kategori === 'lain' ? 'Lain-lain' : str_replace('_', ' ', $product->kategori) }}
                        </td>
                        <td class="px-6 py-4">Rp{{ number_format($product->harga) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $product->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-600">
                            {{ $product->tanggal_disewa_terakhir ? \Carbon\Carbon::parse($product->tanggal_disewa_terakhir)->translatedFormat('d M Y H:i') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-600">
                            {{ $product->tanggal_tersedia ? \Carbon\Carbon::parse($product->tanggal_tersedia)->translatedFormat('d M Y H:i') : '-' }}
                        </td>
<td class="px-6 py-4">
    <div class="flex items-center gap-2">
        <!-- Tombol Edit -->
        <a href="{{ route('admin.products.edit', $product->id) }}"
           class="group relative inline-flex items-center justify-center w-9 h-9 rounded-full bg-blue-500 hover:bg-blue-600 text-white transition duration-200 shadow hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/>
            </svg>
            <span class="absolute bottom-full mb-1 text-xs bg-gray-800 text-white px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                Edit
            </span>
        </a>

        <!-- Tombol Hapus -->
        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="group relative inline-flex items-center justify-center w-9 h-9 rounded-full bg-red-500 hover:bg-red-600 text-white transition duration-200 shadow hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span class="absolute bottom-full mb-1 text-xs bg-gray-800 text-white px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                    Hapus
                </span>
            </button>
        </form>
    </div>
</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-6">
                            Tidak ada produk ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@if(session('success'))



<div id="popupSuccess" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="relative bg-white w-[90%] md:w-96 p-6 rounded-2xl shadow-xl text-center animate-popup-in border-t-4 border-green-500">
        <div class="flex justify-center items-center mb-4">
<svg class="w-16 h-16 text-green-500 animate-bounce-slow" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
  <path d="M8 12l2 2l4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Sukses!</h2>
        <p class="text-gray-600 text-sm">{{ session('success') }}</p>
        <button onclick="document.getElementById('popupSuccess').remove()"
            class="mt-5 inline-block px-4 py-2 text-sm bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-md shadow hover:scale-105 transition-transform duration-200">
            Tutup
        </button>
        <span class="absolute top-0 right-0 p-2 cursor-pointer text-gray-400 hover:text-gray-600" onclick="document.getElementById('popupSuccess').remove()">
            ✕
        </span>
    </div>
</div>
@endif


   <style>
    @keyframes popup-in {
        0% {
            opacity: 0;
            transform: scale(0.95) translateY(20px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .animate-popup-in {
        animation: popup-in 0.4s ease-out forwards;
    }

    @keyframes bounce-slow {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-8px);
        }
    }

    .animate-bounce-slow {
        animation: bounce-slow 1.5s infinite ease-in-out;
    }
</style>

@endsection

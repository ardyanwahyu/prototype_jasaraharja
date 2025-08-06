@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Tambah Produk Baru</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-xl shadow space-y-8">
        @csrf

        {{-- Informasi Dasar --}}
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Dasar</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Gedung Serbaguna"
                        class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="contoh-gedung-serbaguna"
                        class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Luas</label>
                    <input type="text" name="luas" value="{{ old('luas') }}" placeholder="Contoh: 300 m²"
                        class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga') }}" placeholder="Contoh: 2500000"
                        class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200" required>
                </div>
            </div>
        </div>

        {{-- Deskripsi dan Detail --}}
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Deskripsi & Detail</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200"
                        placeholder="Tuliskan deskripsi umum produk...">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Tambahan</label>
                    <textarea name="keterangan" rows="2"
                        class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200"
                        placeholder="Contoh: Tersedia Wi-Fi gratis...">{{ old('keterangan') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas</label>
                    <textarea name="fasilitas" rows="2"
                        class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200"
                        placeholder="Contoh: AC, Proyektor, Sound System...">{{ old('fasilitas') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Kategori dan Status --}}
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Kategori & Status</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="kategori"
                        class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="gedung" {{ old('kategori') == 'gedung' ? 'selected' : '' }}>Gedung</option>
                        <option value="rumah_dinas" {{ old('kategori') == 'rumah_dinas' ? 'selected' : '' }}>Rumah Dinas</option>
                        <option value="lain" {{ old('kategori') == 'lain' ? 'selected' : '' }}>Lain-lain</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                        class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200">
                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="disewa" {{ old('status') == 'disewa' ? 'selected' : '' }}>Disewa</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Tanggal --}}
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Tanggal</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Disewa Terakhir</label>
                    <input type="datetime-local" name="tanggal_disewa_terakhir" value="{{ old('tanggal_disewa_terakhir') }}"
                        class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Produk Tersedia</label>
                    <input type="datetime-local" name="tanggal_tersedia" value="{{ old('tanggal_tersedia') }}"
                        class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200">
                </div>
            </div>
        </div>

        {{-- Lokasi --}}
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Lokasi</h3>
            <label class="block text-sm font-medium text-gray-700 mb-1">Embed Lokasi Google Maps</label>
            <input type="text" name="lokasi_maps" value="{{ old('lokasi_maps') }}"
                class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200"
                placeholder="Masukkan embed Google Maps">
        </div>

        {{-- Upload Gambar --}}
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Upload Gambar</h3>
            <label class="block text-sm font-medium text-gray-700 mb-1">Upload (maks. 10 gambar, max 7MB/gambar)</label>
            <input type="file" name="images[]" multiple accept="image/*"
                class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200">
            <p class="text-xs text-gray-500 mt-1">Ukuran maksimal tiap gambar 7MB. Maksimal total 10 gambar.</p>
        </div>

        {{-- Tombol Submit --}}
        <div class="pt-6">
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded font-semibold text-lg transition duration-200">
                Simpan Produk
            </button>
        </div>
    </form>
</div>

{{-- Popup Success --}}
@if(session('success'))
<div id="popupSuccess" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center animate-fade-in">
        <h3 class="text-lg font-bold text-green-600 mb-2">Sukses!</h3>
        <p class="text-gray-700">{{ session('success') }}</p>
        <button onclick="document.getElementById('popupSuccess').remove();"
            class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            Tutup
        </button>
    </div>
</div>
@endif
@endsection

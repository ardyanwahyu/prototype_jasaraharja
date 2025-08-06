@extends('layouts.admin')

@section('content')
<h2 class="text-3xl font-bold mb-6 text-gray-800">Edit Produk</h2>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow space-y-6">
    @csrf
    @method('PUT')

    {{-- Informasi Umum --}}
    <div>
        <h3 class="text-lg font-semibold mb-3 text-gray-700 border-b pb-2">Informasi Umum</h3>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Nama Produk</label>
                <input type="text" name="name" value="{{ $product->name }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Slug</label>
                <input type="text" name="slug" value="{{ $product->slug }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 font-medium">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full border p-2 rounded focus:ring focus:ring-blue-300">{{ $product->description }}</textarea>
            </div>

            <div>
                <label class="block mb-1 font-medium">Luas</label>
                <input type="text" name="luas" value="{{ $product->luas }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Harga (Rp)</label>
                <input type="number" name="harga" value="{{ $product->harga }}" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>
        </div>
    </div>

    {{-- Fasilitas & Keterangan --}}
    <div>
        <h3 class="text-lg font-semibold mb-3 text-gray-700 border-b pb-2">Fasilitas & Keterangan</h3>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Fasilitas</label>
                <textarea name="fasilitas" rows="2" class="w-full border p-2 rounded focus:ring focus:ring-blue-300">{{ $product->fasilitas }}</textarea>
            </div>

            <div>
                <label class="block mb-1 font-medium">Keterangan Tambahan</label>
                <textarea name="keterangan" rows="2" class="w-full border p-2 rounded focus:ring focus:ring-blue-300" placeholder="Contoh: Harga termasuk listrik, sound system, dll.">{{ old('keterangan', $product->keterangan) }}</textarea>
            </div>
        </div>
    </div>

    {{-- Status & Kategori --}}
    <div>
        <h3 class="text-lg font-semibold mb-3 text-gray-700 border-b pb-2">Status & Kategori</h3>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Status</label>
                <select name="status" class="w-full border p-2 rounded focus:ring focus:ring-blue-300">
                    <option value="tersedia" {{ $product->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="disewa" {{ $product->status == 'disewa' ? 'selected' : '' }}>Disewa</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Kategori</label>
                <select name="kategori" class="w-full border p-2 rounded focus:ring focus:ring-blue-300">
                    <option value="gedung" {{ $product->kategori == 'gedung' ? 'selected' : '' }}>Gedung</option>
                    <option value="rumah_dinas" {{ $product->kategori == 'rumah_dinas' ? 'selected' : '' }}>Rumah Dinas</option>
                    <option value="lain" {{ old('kategori', $product->kategori ?? '') == 'lain' ? 'selected' : '' }}>Lain-lain</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Tanggal --}}
    <div>
        <h3 class="text-lg font-semibold mb-3 text-gray-700 border-b pb-2">Jadwal</h3>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Tanggal Disewa Terakhir</label>
                <input type="date" name="tanggal_disewa_terakhir" class="w-full border p-2 rounded focus:ring focus:ring-blue-300"
                    value="{{ old('tanggal_disewa_terakhir', $product->tanggal_disewa_terakhir ? date('Y-m-d', strtotime($product->tanggal_disewa_terakhir)) : '') }}">
            </div>

            <div>
                <label class="block mb-1 font-medium">Tanggal Produk Tersedia</label>
                <input type="date" name="tanggal_tersedia" class="w-full border p-2 rounded focus:ring focus:ring-blue-300"
                    value="{{ old('tanggal_tersedia', $product->tanggal_tersedia ? date('Y-m-d', strtotime($product->tanggal_tersedia)) : '') }}">
            </div>
        </div>
    </div>

    {{-- Lokasi & Gambar --}}
    <div>
        <h3 class="text-lg font-semibold mb-3 text-gray-700 border-b pb-2">Lokasi & Gambar</h3>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Link Google Maps</label>
                <input type="text" name="lokasi_maps" value="{{ old('lokasi_maps', $product->lokasi_maps ?? '') }}"
                       class="w-full border p-2 rounded focus:ring focus:ring-blue-300"
                       placeholder="https://maps.google.com/...">
            </div>

            <div>
                <label class="block mb-1 font-medium">Tambah Gambar Baru (Opsional)</label>
                <input type="file" name="images[]" multiple class="w-full border p-2 rounded focus:ring focus:ring-blue-300">
            </div>
        </div>
    </div>

    <div class="pt-4">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
            Update Produk
        </button>
    </div>
</form>

{{-- Galeri Gambar --}}
@if($product->images->count())
<form action="{{ route('admin.products.images.bulkDelete') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus gambar terpilih?')">
    @csrf
    @method('DELETE')

    <h4 class="text-lg font-semibold mb-3 text-gray-700">Gambar Saat Ini:</h4>

    <div class="flex justify-between items-center mb-3">
        <button type="submit" class="bg-red-600 text-white px-4 py-1 text-sm rounded shadow hover:bg-red-700">
            Hapus Terpilih
        </button>
    </div>

    <div id="sortableGallery" class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($product->images as $image)
        <div class="relative group border rounded overflow-hidden shadow hover:shadow-lg transition cursor-move">
            <input type="checkbox" name="image_ids[]" value="{{ $image->id }}" class="absolute top-2 left-2 z-10">
            <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-32 object-cover">
            <div class="absolute bottom-1 right-2 z-10 bg-white/80 px-1 rounded text-xs">
                Urutan: {{ $image->order ?? $loop->index + 1 }}
            </div>
        </div>
        @endforeach
    </div>
</form>
@endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    const sortable = new Sortable(document.getElementById('sortableGallery'), {
        animation: 150,
        onEnd: function (evt) {
            const order = Array.from(evt.to.children).map((el, index) => {
                const checkbox = el.querySelector('input[type="checkbox"]');
                return {
                    id: checkbox?.value,
                    order: index + 1
                };
            });

            fetch("{{ route('admin.products.images.reorder') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order })
            });
        }
    });
</script>
@endpush


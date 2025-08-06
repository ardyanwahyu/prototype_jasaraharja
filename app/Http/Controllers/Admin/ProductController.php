<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\ManualBooking;
use Carbon\Carbon;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Halaman Dashboard Admin
    public function dashboard()
    {
        $totalProduk = Product::count();
        $totalGedung = Product::where('kategori', 'gedung')->count();
        $totalRumahDinas = Product::where('kategori', 'rumah_dinas')->count();
        $totalLain = Product::where('kategori', 'lain')->count();
        $products = Product::with('images')->latest()->get();

        return view('admin.dashboard', compact(
            'totalProduk', 'totalGedung', 'totalRumahDinas', 'totalLain', 'products'
        ));
    }

    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'description' => 'nullable',
            'luas' => 'required',
            'fasilitas' => 'nullable',
            'harga' => 'required|integer',
            'keterangan' => 'nullable|string|max:1000',
            'status' => 'required|in:tersedia,disewa',
            'kategori' => 'required|in:gedung,rumah_dinas,lain',
            'lokasi_maps' => 'nullable|string',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:7168',
            'tanggal_disewa_terakhir' => 'nullable|date',
            'tanggal_tersedia' => 'nullable|date'
        ]);

        // Tangani input lokasi_maps dari iframe
        if (isset($validated['lokasi_maps']) && str_contains($validated['lokasi_maps'], '<iframe')) {
            preg_match('/src="([^"]+)"/', $validated['lokasi_maps'], $matches);
            if (isset($matches[1])) {
                $validated['lokasi_maps'] = $matches[1];
            }
        }

        $product = Product::create($validated);
        

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            if (count($images) > 10) {
                return redirect()->back()->withErrors(['images' => 'Maksimal 10 gambar per produk.']);
            }

            foreach ($images as $imageFile) {
                $path = $imageFile->store('products', 'public');
                Image::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.products.create')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show($slug)
    {
        $product = Product::with('images')->where('slug', $slug)->firstOrFail();
        return view('guest.detail', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $product->id,
            'description' => 'nullable',
            'luas' => 'required',
            'fasilitas' => 'nullable',
            'harga' => 'required|integer',
            'keterangan' => 'nullable|string|max:1000',
            'status' => 'required|in:tersedia,disewa',
            'kategori' => 'required|in:gedung,rumah_dinas,lain',
            'lokasi_maps' => 'nullable|string',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:7168',
            'tanggal_disewa_terakhir' => 'nullable|date',
            'tanggal_tersedia' => 'nullable|date'
        ]);

        // Tangani input lokasi_maps dari iframe
        if (isset($validated['lokasi_maps']) && str_contains($validated['lokasi_maps'], '<iframe')) {
            preg_match('/src="([^"]+)"/', $validated['lokasi_maps'], $matches);
            if (isset($matches[1])) {
                $validated['lokasi_maps'] = $matches[1];
            }
        }

        $product->update($validated);

        $product->thumbnail_id = $request->input('thumbnail_id');
        $product->save();


        // Blokir tanggal jika status disewa
        if (
            $validated['status'] === 'disewa' &&
            $validated['tanggal_disewa_terakhir'] &&
            $validated['tanggal_tersedia']
        ) {
            ManualBooking::firstOrCreate([
                'product_id' => $product->id,
                'tanggal_mulai' => $validated['tanggal_disewa_terakhir'],
                'tanggal_selesai' => $validated['tanggal_tersedia'],
            ]);
        }

        // Cek dan simpan gambar baru (maksimal total 10)
        if ($request->hasFile('images')) {
            $currentImageCount = $product->images()->count();
            $newImages = count($request->file('images'));

            if (($currentImageCount + $newImages) > 10) {
                return redirect()->back()->withErrors(['images' => 'Maksimal total 10 gambar per produk.']);
            }

            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('products', 'public');
                Image::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $product = Product::with('images')->findOrFail($id);

        foreach ($product->images as $image) {
            if (\Storage::disk('public')->exists($image->image_path)) {
                \Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }
    public function destroyImage($id)
{
    $image = Image::findOrFail($id); // ✅ Gunakan model yang sesuai

    // Hapus file dari storage
    if (Storage::disk('public')->exists($image->image_path)) {
        Storage::disk('public')->delete($image->image_path);
    }

    // Hapus dari database
    $image->delete();

    return back()->with('success', 'Gambar berhasil dihapus.');
}

}

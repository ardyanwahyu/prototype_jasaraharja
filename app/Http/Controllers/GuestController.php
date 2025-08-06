<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ManualBooking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GuestController extends Controller
{
   public function index(Request $request)
    {
        $kategori = $request->query('kategori'); // Ambil dari ?kategori=...

        $query = Product::with('images')->latest();

        if ($kategori) {
            if ($kategori === 'lain') {
                // Ambil semua kategori KECUALI gedung dan rumah_dinas
                $query->whereNotIn('kategori', ['gedung', 'rumah_dinas']);
            } elseif (in_array($kategori, ['gedung', 'rumah_dinas'])) {
                // Filter berdasarkan kategori gedung / rumah_dinas
                $query->where('kategori', $kategori);
            }
        }

        $products = $query->get();

        return view('guest.index', compact('products', 'kategori'));
    }


     // ✅ Detail Produk
    public function show($slug)
    {
        $product = Product::with(['images', 'manualBookings'])
            ->where('slug', $slug)
            ->firstOrFail();

        $manualBookings = $product->manualBookings;
        $bookedDates = [];

        foreach ($manualBookings as $booking) {
            if ($booking->tanggal_mulai && $booking->tanggal_selesai) {
                $start = Carbon::parse($booking->tanggal_mulai);
                $end = Carbon::parse($booking->tanggal_selesai);

                while ($start->lte($end)) {
                    $bookedDates[] = $start->toDateString();
                    $start->addDay();
                }
            }
        }

        return view('guest.show', compact('product', 'bookedDates'));
    }
    public function authenticated(Request $request, $user)
{
    session()->flash('welcome_message', 'Selamat datang, ' . $user->name . '!');
}

}

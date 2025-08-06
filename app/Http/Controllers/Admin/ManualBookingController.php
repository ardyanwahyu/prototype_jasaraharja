<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ManualBooking;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Models\User;
use PDF;

class ManualBookingController extends Controller
{
    public function create()
        {
            $products = Product::all();
            $users = User::where('role', 'tamu')->get(); // hanya ambil user dengan role tamu
            $bookings = ManualBooking::where('tanggal_selesai', '>=', now())->get();
            $bookedDates = [];

            foreach ($bookings as $booking) {
                $start = Carbon::parse($booking->tanggal_mulai);
                $end = Carbon::parse($booking->tanggal_selesai);

                while ($start->lte($end)) {
                    $bookedDates[] = $start->toDateString();
                    $start->addDay();
                }
            }

            return view('admin.bookings.create', compact('products', 'users', 'bookedDates'));
        }

        public function store(Request $request)
        {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'user_id' => ['nullable', 'exists:users,id', 'required_without_all:nama_manual,telepon_manual'],
                'nama_manual' => ['nullable', 'string', 'required_without:user_id'],
                'telepon_manual' => ['nullable', 'string', 'required_without:user_id'],
            ], [
                'user_id.required_without_all' => 'Pilih tamu dari daftar atau isi nama dan telepon manual.',
                'nama_manual.required_without' => 'Isi nama tamu jika tidak memilih user otomatis.',
                'telepon_manual.required_without' => 'Isi telepon tamu jika tidak memilih user otomatis.',
            ]);

            $productId = $request->product_id;
            $start = Carbon::parse($request->tanggal_mulai);
            $end = Carbon::parse($request->tanggal_selesai);

            // Cek bentrok tanggal untuk produk yang sama
            $existingBookings = ManualBooking::where('product_id', $productId)->get();

            foreach ($existingBookings as $booking) {
                $bookedStart = Carbon::parse($booking->tanggal_mulai);
                $bookedEnd = Carbon::parse($booking->tanggal_selesai);

                if ($start->lte($bookedEnd) && $end->gte($bookedStart)) {
                    return back()->withErrors([
                        'tanggal_mulai' => 'Tanggal yang dipilih bertabrakan dengan booking yang sudah ada.'
                    ])->withInput();
                }
            }

            // Tentukan sumber tamu: prioritas user_id kalau ada
            $data = [
                'product_id' => $productId,
                'tanggal_mulai' => $start->toDateString(),
                'tanggal_selesai' => $end->toDateString(),
            ];

            if ($request->filled('user_id')) {
                $data['user_id'] = $request->user_id;
                // kosongkan manual karena tidak dipakai
                $data['nama_manual'] = null;
                $data['telepon_manual'] = null;
            } else {
                $data['user_id'] = null;
                $data['nama_manual'] = $request->nama_manual;
                $data['telepon_manual'] = $request->telepon_manual;
            }

            ManualBooking::create($data);

            return redirect()->route('admin.blocking.index')->with('success', 'Tanggal booking berhasil diblokir.');
        }

        public function index(Request $request)
{
            $tab = $request->get('tab');

            if ($tab === 'riwayat') {
                $bookings = ManualBooking::where('tanggal_selesai', '<', now())
                    ->with('product', 'user')
                    ->orderBy('product_id')
                    ->orderBy('tanggal_mulai')
                    ->get();
            } else {
                $bookings = ManualBooking::where('tanggal_selesai', '>=', now())
                    ->with('product', 'user')
                    ->orderBy('product_id')
                    ->orderBy('tanggal_mulai')
                    ->get();
            }

            return view('admin.bookings.index', compact('bookings'));
        }


        public function destroy($id)
        {
            $booking = ManualBooking::findOrFail($id);
            $booking->delete();

            return redirect()->route('admin.blocking.index')->with('success', 'Tanggal booking berhasil dihapus.');
        }

        public function batchDestroy(Request $request)
        {
            $ids = $request->input('ids', []);

            if (!empty($ids)) {
                ManualBooking::whereIn('id', $ids)->delete();
            }

            return redirect()->route('admin.blocking.index')->with('success', 'Rentang booking berhasil dihapus.');
        }

        public function getUnavailableDates(Product $product)
        {
            $bookings = ManualBooking::where('product_id', $product->id)->get();$bookings = ManualBooking::where('product_id', $product->id)
            ->whereDate('tanggal_selesai', '>=', now())
            ->get();
            
            $dates = [];

            foreach ($bookings as $booking) {
                $start = Carbon::parse($booking->tanggal_mulai);
                $end = Carbon::parse($booking->tanggal_selesai);

                while ($start->lte($end)) {
                    $dates[] = $start->toDateString();
                    $start->addDay();
                }
            }

            return response()->json($dates);
        }

       public function exportAktif()
        {
            $bookings = ManualBooking::with('product', 'user') // <- ini penting
                ->where('tanggal_selesai', '>=', now())
                ->orderBy('tanggal_mulai', 'asc')
                ->get();

            $pdf = PDF::loadView('admin.bookings.pdf', [
                'title' => 'Data Booking Aktif',
                'bookings' => $bookings
            ]);

            return $pdf->download('booking-aktif.pdf');
        }

        public function exportRiwayat()
        {
            $bookings = ManualBooking::with('product', 'user') // <- ini juga penting
                ->where('tanggal_selesai', '<', now())
                ->orderBy('tanggal_mulai', 'desc')
                ->get();

            $pdf = PDF::loadView('admin.bookings.pdf', [
                'title' => 'Data Riwayat Booking',
                'bookings' => $bookings
            ]);

            return $pdf->download('riwayat-booking.pdf');
        }


}

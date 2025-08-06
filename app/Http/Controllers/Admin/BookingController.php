public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'user_id' => 'nullable|exists:users,id',
        'nama_manual' => 'nullable|string',
        'telepon_manual' => 'nullable|string',
    ]);

    $booking = new ManualBooking();
    $booking->product_id = $request->product_id;
    $booking->tanggal_mulai = $request->tanggal_mulai;
    $booking->tanggal_selesai = $request->tanggal_selesai;

    if ($request->filled('manual_input')) {
        $booking->user_id = null;
        $booking->nama_manual = $request->nama_manual;
        $booking->telepon_manual = $request->telepon_manual;
    } else {
        $booking->user_id = $request->user_id;
    }

    $booking->save();

    return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil ditambahkan!');
}

@extends('layouts.admin')

@section('content')
    <div class="space-y-6 px-4 md:px-0">

        {{-- Judul --}}
        <h2 class="text-3xl font-bold text-gray-800 border-b pb-2">Daftar Tanggal Booking Manual</h2>

        {{-- Tombol Tambah & Download --}}
        <div class="flex flex-wrap items-center gap-2 relative">
            <a href="{{ route('admin.blocking.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition inline-flex items-center gap-2">
                ➕ Tambah Manual Booking
            </a>

            {{-- Dropdown Tombol PDF --}}
            <div class="relative">
                <button onclick="toggleDropdown()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition inline-flex items-center gap-2">
                    📄 Download PDF
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="dropdown" class="absolute hidden z-10 mt-2 w-52 bg-white rounded-md shadow-lg border border-gray-200">
                    <a href="{{ route('admin.blocking.export.aktif') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        📄 Download Aktif (PDF)
                    </a>
                    <a href="{{ route('admin.blocking.export.riwayat') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        📄 Download Riwayat (PDF)
                    </a>
                </div>
            </div>
        </div>

        {{-- Tab Navigasi --}}
        <div class="border-b mt-4">
            <nav class="flex space-x-6 text-sm font-medium text-gray-600">
                <a href="{{ route('admin.blocking.index', ['tab' => 'aktif']) }}"
                   class="{{ request()->get('tab') === 'riwayat' ? 'hover:text-blue-600' : 'text-blue-600 border-b-2 border-blue-600' }} py-2">
                    Aktif
                </a>
                <a href="{{ route('admin.blocking.index', ['tab' => 'riwayat']) }}"
                   class="{{ request()->get('tab') === 'riwayat' ? 'text-blue-600 border-b-2 border-blue-600' : 'hover:text-blue-600' }} py-2">
                    Riwayat
                </a>
            </nav>
        </div>

        {{-- Tabel Booking --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border-collapse border border-gray-200">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="px-4 py-3 border">Nama Produk</th>
                        <th class="px-4 py-3 border">Rentang Tanggal Booking</th>
                        <th class="px-4 py-3 border">Nama Tamu</th>
                        <th class="px-4 py-3 border">Email</th>
                        <th class="px-4 py-3 border">Nomor Telepon Tamu</th>
                        <th class="px-4 py-3 border">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 divide-y divide-gray-200">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $booking->product->name }}</td>
                            <td class="px-4 py-2 border">
                                {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }}
                                s.d.
                                {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d M Y') }}
                            </td>


                            {{-- Nama Tamu --}}
                            <td class="px-4 py-2 border">
                                {{ $booking->user->name ?? $booking->nama_manual ?? '-' }}
                            </td>

                            {{-- Email Tamu --}}
                            <td class="px-4 py-2 border">
                                {{ $booking->user->email ?? '-' }}
                            </td>

                            {{-- Nomor Telepon Tamu --}}
                            <td class="px-4 py-2 border">
                                {{ $booking->user->phone ?? $booking->telepon_manual ?? '-' }}
                            </td>


                            <td class="px-4 py-2 border">
                                @if (request()->get('tab') !== 'riwayat')
                                    <form action="{{ route('admin.blocking.destroy', $booking->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus rentang tanggal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 italic">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500 italic">
                                Tidak ada data {{ request()->get('tab') === 'riwayat' ? 'riwayat' : 'booking aktif' }}.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Script Dropdown --}}
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById("dropdown");
            dropdown.classList.toggle("hidden");
        }

        window.addEventListener('click', function (e) {
            const button = document.querySelector('button[onclick="toggleDropdown()"]');
            const dropdown = document.getElementById("dropdown");
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add("hidden");
            }
        });
    </script>
@endsection

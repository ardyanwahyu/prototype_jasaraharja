@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Blokir Tanggal Penyewaan (Input Manual)</h2>

    @if(session('success'))
        <div id="popupSuccess" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
            <div class="relative bg-white w-[90%] md:w-96 p-6 rounded-2xl shadow-xl text-center animate-popup-in border-t-4 border-green-500">
                <div class="flex justify-center items-center mb-4">
                    <svg class="w-16 h-16 text-green-500 animate-bounce-slow" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <path d="M8 12l2 2l4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Sukses!</h2>
                <p class="text-gray-600 text-sm">{{ session('success') }}</p>
                <button onclick="document.getElementById('popupSuccess').remove()"
                        class="mt-5 inline-block px-4 py-2 text-sm bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-md shadow hover:scale-105 transition-transform duration-200">
                    Tutup
                </button>
                <span class="absolute top-0 right-0 p-2 cursor-pointer text-gray-400 hover:text-gray-600"
                      onclick="document.getElementById('popupSuccess').remove()">
                    ✕
                </span>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="text-sm list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blocking.store') }}" method="POST" class="space-y-5 bg-white p-6 rounded shadow-md" id="booking-form">
        @csrf

        <!-- Pilih Produk -->
        <div>
            <label class="block font-semibold mb-1">Pilih Produk</label>
            <select name="product_id" id="product_id" required class="w-full border p-2 rounded">
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                        {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} - {{ $product->kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal Mulai -->
        <div>
            <label class="block font-semibold mb-1">Tanggal Mulai</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                   class="w-full border p-2 rounded" required
                   value="{{ old('tanggal_mulai') }}">
        </div>

        <!-- Tanggal Selesai -->
        <div>
            <label class="block font-semibold mb-1">Tanggal Selesai</label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                   class="w-full border p-2 rounded" required
                   value="{{ old('tanggal_selesai') }}">
        </div>

        <!-- Toggle input manual -->
        <label class="flex items-center mb-3">
            <input type="checkbox" id="toggle-manual" class="mr-2"
                   {{ (old('nama_manual') || old('telepon_manual')) ? 'checked' : '' }}>
            <span>Input tamu secara manual</span>
        </label>

        <!-- Pilih dari pengguna -->
        <div id="select-user-wrapper">
            <label class="block font-semibold mb-1">Pilih Nama Tamu</label>
            <select name="user_id" id="user_id" class="form-control w-full" style="width:100%;">
                <option value="">-- Pilih Nama Tamu --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        data-phone="{{ $user->phone }}"
                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Input Manual -->
        <div id="manual-fields" class="{{ (old('nama_manual') || old('telepon_manual')) ? '' : 'hidden' }}">
            <label class="block font-semibold mb-1 mt-3">Nama Tamu (Manual)</label>
            <input type="text" name="nama_manual" class="w-full border p-2 rounded mb-2"
                   placeholder="Nama tamu..." value="{{ old('nama_manual') }}">

            <label class="block font-semibold mb-1">No. Telepon (Manual)</label>
            <input type="text" name="telepon_manual" class="w-full border p-2 rounded"
                   placeholder="Nomor telepon..." value="{{ old('telepon_manual') }}">
        </div>

        <!-- Output Nomor Telepon dari dropdown -->
        <div id="telepon-wrapper" class="mt-3">
            <label class="block font-semibold mb-1">Nomor Telepon</label>
            <input type="text" name="nomor_tamu" id="nomor_tamu"
                   class="w-full border p-2 rounded" readonly
                   value="{{ old('user_id') ? optional($users->firstWhere('id', old('user_id')))->phone : '' }}">
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
            Simpan
        </button>
    </form>
@endsection


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

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function isiNomorTamu() {
        const selectedOption = $('#user_id').find(':selected');
        const phone = selectedOption.data('phone') || '';
        $('#nomor_tamu').val(phone);
    }

    $(document).ready(function () {
        // Inisialisasi Select2 dengan pencarian
        $('#user_id').select2({
            placeholder: "-- Pilih Tamu --",
            allowClear: true,
            width: '100%'
        });

        // Sync nomor ketika berubah
        $('#user_id').on('change', function () {
            isiNomorTamu();
        });

        // Initial fill
        isiNomorTamu();

        // Toggle manual/user logic
        function updateRequiredStates() {
            const isManual = $('#toggle-manual').is(':checked');

            if (isManual) {
                $('#manual-fields').removeClass('hidden');
                $('#user_id').prop('disabled', true).val(null).trigger('change');
                // kosongkan nomor otomatis
                $('#nomor_tamu').val('');
            } else {
                $('#manual-fields').addClass('hidden');
                $('#user_id').prop('disabled', false);
                // jika ada user dipilih, isi nomor
                isiNomorTamu();
            }
        }

        $('#toggle-manual').on('change', updateRequiredStates);

        // enforce on submit: minimal salah satu sumber tamu
        $('#booking-form').on('submit', function (e) {
            const isManual = $('#toggle-manual').is(':checked');
            const userId = $('#user_id').val();
            const namaManual = $('input[name="nama_manual"]').val().trim();
            const teleponManual = $('input[name="telepon_manual"]').val().trim();

            if (isManual) {
                if (!(namaManual && teleponManual)) {
                    e.preventDefault();
                    alert('Karena memilih input manual, nama dan telepon harus diisi.');
                    return;
                }
            } else {
                if (!userId && !(namaManual && teleponManual)) {
                    e.preventDefault();
                    alert('Isi salah satu: pilih tamu dari daftar, atau isi nama dan telepon manual.');
                    return;
                }
            }
        });

        // set initial state (in case old values exist)
        updateRequiredStates();

        // (Opsional) Kalender dan blok tanggal booking
        const produkSelect = document.getElementById('product_id');
        const tanggalMulaiInput = document.getElementById('tanggal_mulai');
        const tanggalSelesaiInput = document.getElementById('tanggal_selesai');

        let disabledDates = [];

        function fetchDisabledDates(productId) {
            fetch(`/admin/bookings/unavailable-dates/${productId}`)
                .then(res => res.json())
                .then(data => {
                    disabledDates = data;
                    renderCalendar(disabledDates);
                });
        }

        function renderCalendar(dates) {
            const calendarEl = document.getElementById('calendar');
            if (!calendarEl) return;

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 500,
                events: dates.map(date => ({
                    title: '❌ Tidak Tersedia',
                    start: date,
                    color: '#EF4444',
                    textColor: '#fff'
                }))
            });

            calendar.render();
        }

        function validateDateInput(input) {
            input.addEventListener('change', function () {
                if (disabledDates.includes(this.value)) {
                    alert("Tanggal yang dipilih sudah tidak tersedia. Silakan pilih tanggal lain.");
                    this.value = '';
                }
            });
        }

        validateDateInput(tanggalMulaiInput);
        validateDateInput(tanggalSelesaiInput);

        produkSelect?.addEventListener('change', function () {
            fetchDisabledDates(this.value);
        });

        if (produkSelect && produkSelect.value) {
            fetchDisabledDates(produkSelect.value);
        }
    });
</script>
@endpush

<x-landing>
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Gambar Produk -->
            <div>
                @if ($product->images->count())
                    <div class="swiper mySwiper rounded-lg overflow-hidden">
                        <div class="swiper-wrapper">
                            @foreach ($product->images as $img)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $img->image_path) }}"
                                         class="w-full h-96 object-cover shadow rounded-lg">
                                </div>
                            @endforeach
                        </div>
                        <!-- Navigasi -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                @else
                    <p class="text-sm text-gray-500">Tidak ada gambar tersedia.</p>
                @endif
            </div>

            <!-- Detail Produk -->
            <div class="text-gray-800 space-y-3">
                <h2 class="text-3xl font-bold">{{ $product->name }}</h2>
                <p class="text-gray-600">Kategori: <span class="capitalize">{{ str_replace('_', ' ', $product->kategori) }}</span></p>
                <p class="leading-relaxed">{{ $product->description }}</p>

                <div class="pt-2 space-y-1">
                    <p class="text-xl font-semibold text-green-700">Rp{{ number_format($product->harga) }}</p>
                    <p>Status:
                        @if ($product->status == 'tersedia')
                            <span class="text-green-600 font-semibold">Tersedia</span>
                        @else
                            <span class="text-red-600 font-semibold">Sedang Disewa</span>
                        @endif
                    </p>
                    <p>Luas: {{ $product->luas }} m<sup>2</sup></p>
                    <p>Fasilitas: {{ $product->fasilitas }}</p>
                </div>

                <!-- Tombol WA -->
                <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20menyewa%20{{ urlencode($product->name) }}"
                   class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow mt-4 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                         viewBox="0 0 24 24">
                        <path
                            d="M12 0C5.372 0 0 5.373 0 12c0 2.11.549 4.104 1.574 5.873L0 24l6.31-1.651A11.944 11.944 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm6.258 17.047c-.25.698-1.46 1.352-2.01 1.437-.522.081-1.186.114-3.4-.72-2.856-1.15-4.7-3.976-4.842-4.16-.142-.187-1.156-1.541-1.156-2.939 0-1.397.73-2.085.99-2.372.26-.286.568-.358.76-.358.19 0 .38.002.547.01.175.007.41-.066.642.488.25.59.846 2.04.92 2.185.076.145.126.31.025.5-.1.19-.15.308-.294.472-.147.168-.309.375-.44.506-.14.138-.287.289-.123.565.167.29.743 1.22 1.596 1.975 1.098.974 2.025 1.276 2.3 1.415.274.138.433.115.593-.07.158-.183.683-.79.866-1.06.181-.27.362-.22.612-.13.25.09 1.58.747 1.85.882.27.133.448.197.513.31.064.11.064.64-.187 1.34z" />
                    </svg>
                    Hubungi Admin via WhatsApp
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper(".mySwiper", {
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        </script>
    @endpush
</x-landing>

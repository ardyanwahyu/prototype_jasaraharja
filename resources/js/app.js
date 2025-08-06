import './bootstrap';
import Alpine from 'alpinejs';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

window.Alpine = Alpine;
Alpine.start();

// ✅ Tombol "Lihat Lokasi" (modal)
window.openMapModal = function (mapsUrl) {
    const modal = document.getElementById('mapModal');
    const iframe = document.getElementById('mapIframe');
    if (modal && iframe) {
        iframe.src = mapsUrl;
        modal.classList.remove('hidden');
    }
};

window.closeMapModal = function () {
    const modal = document.getElementById('mapModal');
    const iframe = document.getElementById('mapIframe');
    if (modal && iframe) {
        iframe.src = '';
        modal.classList.add('hidden');
    }
};

// ✅ Tab Navigasi
window.showTab = function (e, tab) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.getElementById('tab-' + tab)?.classList.remove('hidden');

    document.querySelectorAll('.tab-btn').forEach(el => {
        el.classList.remove('text-blue-600', 'font-semibold', 'border-blue-600');
        el.classList.add('text-gray-500');
    });
    e.target.classList.add('text-blue-600', 'font-semibold', 'border-b-2', 'border-blue-600');
};

// ✅ Ganti Gambar Utama Produk
window.changeMainImage = function (src) {
    const mainImg = document.getElementById('mainProductImage');
    if (mainImg) {
        mainImg.src = src;
    }
};

// ✅ Kalender FullCalendar
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin],
            initialView: 'dayGridMonth',
            height: 450,
            contentHeight: 'auto',
            aspectRatio: 1.6,
            events: window.bookedDates || [],
            headerToolbar: {
                start: 'title',
                center: '',
                end: 'prev,next'
            }
        });
        calendar.render();
    }

    // ✅ Pop-up Tutorial (muncul setiap kali halaman dibuka)
    const popup = document.getElementById('popupTutorial');
    if (popup) {
        popup.classList.remove('hidden');
        setTimeout(() => popup.classList.remove('opacity-0'), 10); // smooth animation
    }
});

// ✅ Tutup Pop-up Tutorial
window.closePopupTutorial = function () {
    const popup = document.getElementById('popupTutorial');
    if (popup) {
        popup.classList.add('opacity-0');
        setTimeout(() => popup.classList.add('hidden'), 300);
    }
};


document.addEventListener('DOMContentLoaded', () => {
    // ======================
    // SLIDER: Tentang Sistem (aboutSlider)
    // ======================
    const aboutSlider = document.getElementById('aboutSlider');
    if (aboutSlider) {
        const slides = aboutSlider.children;
        const totalSlides = slides.length;
        let index = 0;

        setInterval(() => {
            index = (index + 1) % totalSlides;
            aboutSlider.style.transform = `translateX(-${index * 100}%)`;
        }, 4000);
    }

    // ======================
    // SLIDER: Hero Section (sliderContainer)
    // ======================
    const sliderContainer = document.getElementById('sliderContainer');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const indicators = document.querySelectorAll('.indicator');

    if (sliderContainer && indicators.length > 0) {
        const slides = sliderContainer.children;
        const totalSlides = slides.length;
        let currentIndex = 0;
        let autoSlideInterval = null;

        function goToSlide(index) {
            currentIndex = (index + totalSlides) % totalSlides;
            sliderContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
            updateIndicators();
        }

        function nextSlide() {
            goToSlide(currentIndex + 1);
        }

        function prevSlide() {
            goToSlide(currentIndex - 1);
        }

        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 5000);
        }

        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }

        function updateIndicators() {
            indicators.forEach((dot, i) => {
                dot.classList.toggle('opacity-100', i === currentIndex);
                dot.classList.toggle('opacity-50', i !== currentIndex);
                dot.classList.toggle('scale-125', i === currentIndex);
                dot.classList.toggle('scale-100', i !== currentIndex);
            });
        }

        // Event Listeners
        indicators.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                stopAutoSlide();
                goToSlide(i);
                startAutoSlide();
            });
        });

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                stopAutoSlide();
                prevSlide();
                startAutoSlide();
            });
        }

        startAutoSlide();
        updateIndicators();
    }
});



// USER MANUAL
window.isiNomorTamu = function () {
    const selectedOption = $('#user_id').find(':selected');
    const value = selectedOption.val();

    if (value === 'manual') {
        $('#input_manual_nama').removeClass('hidden');
        $('#input_manual_telepon').removeClass('hidden');
        $('#nomor_tamu').val('');
        $('#nomor_tamu').closest('div').addClass('hidden');
    } else {
        const phone = selectedOption.data('phone') || '';
        $('#nomor_tamu').val(phone);
        $('#input_manual_nama').addClass('hidden');
        $('#input_manual_telepon').addClass('hidden');
        $('#nomor_tamu').closest('div').removeClass('hidden');
    }
};



// PASSWORD
document.addEventListener("DOMContentLoaded", () => {
    const togglePassword = document.getElementById("eyeIcon");
    const passwordInput = document.getElementById("password");

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener("click", () => {
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";

            togglePassword.innerHTML = isPassword
                ? `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.22-3.592m1.61-1.462A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.961 9.961 0 01-4.233 5.045M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3l18 18" />
                `
                : `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
        });
    }
});


// PILIHAN INPUT MANUAL
document.addEventListener('DOMContentLoaded', function () {
    const toggleManual = document.getElementById('toggle-manual');
    const selectUser = document.getElementById('user_id');
    const manualFields = document.getElementById('manual-fields');
    const selectUserWrapper = document.getElementById('select-user-wrapper');
    const teleponInput = document.getElementById('nomor_tamu');
    const teleponWrapper = document.getElementById('telepon-wrapper');

    // Fungsi isi otomatis nomor HP saat user dipilih
    function isiNomorTamu() {
        const selectedOption = selectUser.options[selectUser.selectedIndex];
        const phone = selectedOption.getAttribute('data-phone') || '';
        teleponInput.value = phone;
    }

    // Event: Saat ganti user
    selectUser.addEventListener('change', isiNomorTamu);

    // Event: Toggle input manual
    toggleManual.addEventListener('change', function () {
        if (this.checked) {
            manualFields.classList.remove('hidden');
            selectUserWrapper.classList.add('hidden');
            teleponWrapper.classList.add('hidden');
            teleponInput.value = '';
        } else {
            manualFields.classList.add('hidden');
            selectUserWrapper.classList.remove('hidden');
            teleponWrapper.classList.remove('hidden');
            isiNomorTamu(); // refresh isi nomor telepon
        }
    });
});

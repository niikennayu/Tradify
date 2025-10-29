<x-app-layout>
    
    {{-- ====================================================== --}}
    {{-- BAGIAN 1: CAROUSEL (SLIDESHOW) --}}
    {{-- ====================================================== --}}
    <div class="w-full shadow-lg overflow-hidden">
        <div class="main-carousel">
            <div>
                <img src="{{ asset('images/banner-anda-1.jpg') }}" 
                     alt="Banner 1" 
                     class="w-full"
                     onerror="this.onerror=null; this.src='https://nitrajaya.co.id/wp-content/uploads/2025/01/landscape-noella.jpg'">
            </div>
            <div>
                <img src="{{ asset('images/banner-anda-2.jpg') }}" 
                     alt="Banner 2" 
                     class="w-full"
                     onerror="this.onerror=null; this.src='https://nitrajaya.co.id/wp-content/uploads/2025/01/landscape-Monet-Silk.jpg'">
            </div>
            <div>
                <img src="{{ asset('images/banner-anda-3.jpg') }}" 
                     alt="Banner 3" 
                     class="w-full"
                     onerror="this.onerror=null; this.src='https://nitrajaya.co.id/wp-content/uploads/2025/01/landscape-diora-silk.jpg'">
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- ====================================================== --}}
        {{-- BAGIAN 2: ABOUT US (SESUAI GAMBAR 2) --}}
        {{-- ====================================================== --}}
        <section id="about" class="py-16 sm:py-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Kolom Gambar -->
                <div class="px-4">
                    {{-- Ganti gambar ini di public/images/about-us-illustration.jpg --}}
                    <img src="{{ asset('images/about-us-illustration.jpg') }}" 
                         onerror="this.onerror=null; this.src='https://assets.promediateknologi.id/crop/0x242:720x813/750x500/webp/photo/p1/397/2023/08/30/Screenshot_2023-08-30-15-31-10-37-4044918928.jpg'" 
                         alt="Ilustrasi Baju Adat Tradisional" 
                         class="rounded-lg shadow-xl w-full h-auto object-cover">
                </div>
                <!-- Kolom Teks -->
                <div class="px-4">
                    <h2 class="text-base font-semibold leading-7 text-red-600 uppercase">Tentang Kami</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Warisan Budaya dalam Genggaman Anda</p>
                    <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                        Selamat datang di Tradify. Kami percaya bahwa setiap helai kain tradisional menyimpan cerita dan identitas bangsa. Misi kami adalah melestarikan keagungan busana adat Indonesia dengan membuatnya mudah diakses oleh Anda.
                    </p>
                    <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-600 dark:text-gray-300 lg:max-w-none">
                        <div class="relative ps-9">
                            <dt class="inline font-semibold text-gray-900 dark:text-white">
                                <svg class="absolute left-1 top-1 h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                Komitmen Kami.
                            </dt>
                            <dd class="inline">Setiap unit baju adat kami rawat dengan standar tertinggi, memastikan Anda tampil memukau dengan pakaian yang bersih, otentik, dan terawat sempurna.</dd>
                        </div>
                        <div class="relative ps-9">
                            <dt class="inline font-semibold text-gray-900 dark:text-white">
                                <svg class="absolute left-1 top-1 h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                Misi Pelestarian.
                            </dt>
                            <dd class="inline">Lebih dari sekadar sewa, kami adalah bagian dari gerakan untuk menjaga warisan budaya. Setiap peminjaman Anda turut berkontribusi dalam pelestarian ini.</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        {{-- ====================================================== --}}
        {{-- BAGIAN 3: FEATURED PRODUCTS (3 CARD) --}}
        {{-- ====================================================== --}}
        <section id="products" class="py-16 sm:py-24 bg-gray-50 dark:bg-gray-800 rounded-lg px-4">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Koleksi Pilihan Kami</h2>
                <p class="mt-4 text-lg leading-8 text-gray-600 dark:text-gray-300">
                    Lihat 3 dari koleksi baju adat terbaik kami yang paling sering diminati.
                </p>
            </div>
            
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($featuredUnits as $unit)
                    {{-- Ini memanggil komponen card produk yang sudah kita buat --}}
                    <x-product-card :unit="$unit" />
                @empty
                    <p class="md:col-span-3 text-center text-gray-500 dark:text-gray-400">Koleksi pilihan akan segera hadir.</p>
                @endforelse
            </div>

            {{-- Tombol Call to Action (CTA) --}}
            <div class="mt-16 text-center">
                <p class="text-lg leading-8 text-gray-600 dark:text-gray-300">
                    Tertarik untuk melihat lebih banyak?
                </p>
                <div class="mt-6 flex items-center justify-center gap-x-6">
                    <a href="{{ route('register') }}" class="rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">
                        Sudah punya akun? <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </section>


        {{-- ====================================================== --}}
        {{-- BAGIAN 4: REVIEWS (SESUAI GAMBAR 3) --}}
        {{-- ====================================================== --}}
        <section id="reviews" class="py-16 sm:py-24 overflow-hidden">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Apa Kata Mereka?</h2>
                <p class="mt-4 text-lg leading-8 text-gray-600 dark:text-gray-300">
                    Pengalaman mereka yang telah percaya pada layanan kami.
                </p>
            </div>

            {{-- Review Carousel --}}
            <div class="review-carousel mt-16">
                {{-- Review 1 --}}
                <div class="px-3 py-3">
                    <figure class="rounded-2xl bg-white dark:bg-gray-800 p-8 shadow-lg ring-1 ring-gray-900/5">
                        <blockquote class="text-gray-900 dark:text-white">
                            <p>“Pelayanannya luar biasa! Bajunya bersih, wangi, dan otentik. Saya merasa sangat gagah memakai baju adat Jawa lengkap di acara pernikahan saya. Terima kasih adaTradify!”</p>
                        </blockquote>
                        <figcaption class="mt-6 flex items-center gap-x-4">
                            <img class="h-10 w-10 rounded-full bg-gray-50" src="{{ asset('images/testimonial-1.jpg') }}" onerror="this.onerror=null; this.src='https://placehold.co/40x40/E0E0E0/757575?text=AS'" alt="Foto Testimonial">
                            <div>
                                <div class="font-semibold text-gray-900 dark:text-white">Andi Saputra</div>
                                <div class="text-gray-600 dark:text-gray-400">@andisaputra</div>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                
                {{-- Review 2 --}}
                <div class="px-3 py-3">
                    <figure class="rounded-2xl bg-white dark:bg-gray-800 p-8 shadow-lg ring-1 ring-gray-900/5">
                        <blockquote class="text-gray-900 dark:text-white">
                            <p>“Sangat membantu untuk acara wisuda saya. Nggak perlu repot cari dan merawat kebaya. Kualitas kebayanya premium, beda dari tempat sewa biasa. Pasti sewa lagi!”</p>
                        </blockquote>
                        <figcaption class="mt-6 flex items-center gap-x-4">
                            <img class="h-10 w-10 rounded-full bg-gray-50" src="{{ asset('images/testimonial-2.jpg') }}" onerror="this.onerror=null; this.src='https://placehold.co/40x40/F8BBD0/C2185B?text=DR'" alt="Foto Testimonial">
                            <div>
                                <div class="font-semibold text-gray-900 dark:text-white">Dewi Lestari</div>
                                <div class="text-gray-600 dark:text-gray-400">@dewilestari</div>
                            </div>
                        </figcaption>
                    </figure>
                </div>

                {{-- Review 3 --}}
                <div class="px-3 py-3">
                    <figure class="rounded-2xl bg-white dark:bg-gray-800 p-8 shadow-lg ring-1 ring-gray-900/5">
                        <blockquote class="text-gray-900 dark:text-white">
                            <p>“Awalnya ragu sewa online, tapi prosesnya gampang banget. Adminnya responsif dan pengirimannya tepat waktu. Baju adat Balinya pas dan cantik sekali. Recommended!”</p>
                        </blockquote>
                        <figcaption class="mt-6 flex items-center gap-x-4">
                            <img class="h-10 w-10 rounded-full bg-gray-50" src="{{ asset('images/testimonial-3.jpg') }}" onerror="this.onerror=null; this.src='https://placehold.co/40x40/C5CAE9/3F51B5?text=RS'" alt="Foto Testimonial">
                            <div>
                                <div class="font-semibold text-gray-900 dark:text-white">Rina Setiawati</div>
                                <div class="text-gray-600 dark:text-gray-400">@rinasw</div>
                            </div>
                        </figcaption>
                    </figure>
                </div>

                {{-- Review 4 (Opsional) --}}
                <div class="px-3 py-3">
                    <figure class="rounded-2xl bg-white dark:bg-gray-800 p-8 shadow-lg ring-1 ring-gray-900/5">
                        <blockquote class="text-gray-900 dark:text-white">
                            <p>“Koleksinya lengkap banget! Saya cari baju adat Palembang yang otentik akhirnya ketemu di sini. Kualitas kain dan aksesorisnya nggak main-main. Bintang 5!”</p>
                        </blockquote>
                        <figcaption class="mt-6 flex items-center gap-x-4">
                            <img class="h-10 w-10 rounded-full bg-gray-50" src="{{ asset('images/testimonial-4.jpg') }}" onerror="this.onerror=null; this.src='https://placehold.co/40x40/D7CCC8/5D4037?text=BP'" alt="Foto Testimonial">
                            <div>
                                <div class="font-semibold text-gray-900 dark:text-white">Budi Prakoso</div>
                                <div class="text-gray-600 dark:text-gray-400">@budiprakoso</div>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </section>


        {{-- ====================================================== --}}
        {{-- BAGIAN 5: CHECK JADWAL (FITUR PENCARIAN LAMA) --}}
        {{-- ====================================================== --}}
        <section id="check-jadwal" class="py-16 sm:py-24 bg-gray-50 dark:bg-gray-800 rounded-lg px-4 mt-16">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Cari Koleksi Kami</h2>
                <p class="mt-4 text-lg leading-8 text-gray-600 dark:text-gray-300">
                    Cari ketersediaan baju adat yang Anda inginkan.
                </p>
            </div>
            
            <!-- Form Pencarian -->
            <form action="{{ route('home') }}" method="GET" class="mt-12 max-w-md mx-auto">
                <div class="flex items-center border border-gray-300 dark:border-gray-700 rounded-full shadow-sm overflow-hidden">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari nama baju adat..." 
                        class="flex-grow p-3 border-none focus:ring-0 dark:bg-gray-700 dark:text-white"
                        value="{{ request('search') }}">
                    <button type="submit" class="px-6 py-3 bg-red-600 text-white font-semibold hover:bg-red-500 transition-colors">
                        Cari
                    </button>
                </div>
            </form>

            <!-- Product Grid -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($units as $unit)
                    <x-product-card :unit="$unit" />
                @empty
                    <p class="md:col-span-3 text-center text-gray-500 dark:text-gray-400">
                        {{ request('search') ? 'Baju adat yang Anda cari tidak ditemukan.' : 'Tidak ada baju adat yang tersedia saat ini.' }}
                    </p>
                @endforelse
            </div>

            <!-- Pagination Links -->
            @if ($units->hasPages())
                <div class="mt-16">
                    {{ $units->links() }}
                </div>
            @endif
        </section>
        
    </div>

    {{-- ====================================================== --}}
    {{-- SCRIPT UNTUK CAROUSEL (BANNER & REVIEW) --}}
    {{-- ====================================================== --}}
    @push('scripts')
        {{-- 
          FIX: Tambahkan jQuery & Slick JS di sini. 
          Error "$ is not defined" terjadi karena script ini 
          dibutuhkan oleh kode carousel di bawahnya.
        --}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
                
        <script>
            // Pastikan jQuery sudah dimuat sebelum menjalankan script
            $(document).ready(function(){
                
                // 1. Inisialisasi Main Carousel (Banner)
                if ($('.main-carousel').length) {
                    $('.main-carousel').slick({
                        dots: true,
                        infinite: true,
                        speed: 500,
                        fade: true,
                        cssEase: 'linear',
                        autoplay: true,
                        autoplaySpeed: 3000,
                        arrows: false
                    });
                }

                // 2. Inisialisasi Review Carousel
                if ($('.review-carousel').length) {
                    $('.review-carousel').slick({
                        dots: true,
                        infinite: true,
                        speed: 500,
                        slidesToShow: 3, // Tampilkan 3 review sekaligus
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 4000,
                        arrows: true,
                        // Pengaturan responsive
                        responsive: [
                            {
                                breakpoint: 1024, // tablet
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 1,
                                }
                            },
                            {
                                breakpoint: 640, // mobile
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    arrows: false // Sembunyikan panah di mobile
                                }
                            }
                        ]
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
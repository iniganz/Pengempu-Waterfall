
 <footer id="footer" class="bg-gradient-to-r from-green-900 to-green-500 text-white py-16">
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-6 md:px-16 lg:px-24 xl:px-32">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- About Section -->
            <div class="col-span-1">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/pengempu.png') }}" alt="Pengempu Logo" class="h-24 w-auto">
                    {{-- <h3 class="text-xl font-bold">Pengempu Waterfall</h3> --}}
                </div>
                <p class="text-green-100 text-sm leading-relaxed mb-4">
                    Jelajahi keindahan alam Air Terjun Pengempu yang spektakuler dengan layanan booking terbaik.
                </p>
                {{-- <div class="flex gap-4">
                    <a href="https://www.youtube.com/@Yooofams" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center hover:bg-opacity-30 transition">
                        <i class="bi bi-youtube text-white"></i>
                    </a>
                    <a href="https://www.facebook.com/gandhi.gunadi.33/" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center hover:bg-opacity-30 transition">
                        <i class="bi bi-facebook text-white"></i>
                    </a>
                    <a href="https://www.instagram.com/deganz__/" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center hover:bg-opacity-30 transition">
                        <i class="bi bi-instagram text-white"></i>
                    </a>
                    <a href="https://wa.me/6287820055714/?text=Hi min, saya tertarik booking di Pengempu Waterfall" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center hover:bg-opacity-30 transition">
                        <i class="bi bi-whatsapp text-white"></i>
                    </a>
                </div> --}}
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-bold mb-5 text-white">Navigasi</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-green-100 hover:text-white transition text-sm">Home</a></li>
                    <li><a href="{{ route('galery') }}" class="text-green-100 hover:text-white transition text-sm">Galery</a></li>
                    <li><a href="{{ route('explore-sekitar') }}" class="text-green-100 hover:text-white transition text-sm">Explore Sekitar</a></li>
                    <li><a href="{{ route('contact') }}" class="text-green-100 hover:text-white transition text-sm">Kontak</a></li>
                    <li><a href="{{ route('product') }}" class="text-green-100 hover:text-white transition text-sm">Booking Tiket</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-bold mb-5 text-white">Kontak</h4>
                <div class="space-y-4 text-sm">
                    <div class="flex gap-3">
                        <i class="bi bi-geo-alt text-green-200 flex-shrink-0 mt-1"></i>
                        <p class="text-green-100">
                            G6J3+798, Jl. Seribupati, Cau Belayu, Kec. Marga, Kabupaten Tabanan, Bali 82181
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <i class="bi bi-telephone text-green-200 flex-shrink-0 mt-1"></i>
                        <a href="tel:+6287820055714" class="text-green-100 hover:text-white transition">+62 878 2005 5714</a>
                    </div>
                    <div class="flex gap-3">
                        <i class="bi bi-envelope text-green-200 flex-shrink-0 mt-1"></i>
                        <a href="mailto:pengempuw@gmail.com" class="text-green-100 hover:text-white transition">pengempuw@gmail.com</a>
                    </div>
                </div>
            </div>

            <!-- Hours -->
            <div>
                <h4 class="text-lg font-bold mb-5 text-white">Jam Operasional</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-green-100">Senin - Minggu</span>
                        <span class="font-semibold">08:00 - 18:00</span>
                    </div>
                    {{-- <div class="flex justify-between">
                        <span class="text-green-100">Sabtu - Minggu</span>
                        <span class="font-semibold">07:00 - 19:00</span>
                    </div> --}}
                    <div class="pt-3 border-t border-green-400">
                        <p class="text-green-100 text-xs">Libur Nasional: Sesuai ketentuan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-green-400 opacity-30"></div>

        <!-- Bottom Footer -->
        <div class="mt-8 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-green-100 text-sm text-center md:text-left">
                &copy; 2024 <span class="font-semibold">Pengempu Waterfall</span>. Semua hak dilindungi.
            </p>
            <div class="flex gap-6 text-sm">
                <a href="#" class="text-green-100 hover:text-white transition">Privacy Policy</a>
                <a href="#" class="text-green-100 hover:text-white transition">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

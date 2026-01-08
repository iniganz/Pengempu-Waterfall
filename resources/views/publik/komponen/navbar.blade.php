{{-- <header id="header" class="header d-flex align-items-center fixed-top"> --}}
<nav
    class="relative z-30 flex h-[120px] w-full items-center justify-between bg-gradient-to-r from-green-900 to-green-500 px-6 transition-all md:px-16 lg:px-24 xl:px-32 shadow-lg">

    <a href="{{ url('/') }}" class="flex-shrink-0">
        <img src="{{ asset('images/pengempu.png') }}" alt="Pengempu Waterfall Logo" class="h-[100px] w-auto">
    </a>

    <ul class="hidden items-center gap-10 font-bold text-white md:flex">
        <li>
            <x-nav-item :href="route('home')" :active="request()->routeIs('home')">
                Home
            </x-nav-item>
        </li>
        <li>
            <x-nav-item :href="route('galery')" :active="request()->routeIs('galery')">
                Galery
            </x-nav-item>
        </li>
        <li>
            <x-nav-item :href="route('explore-sekitar')" :active="request()->routeIs('explore-sekitar')">
                Explore Sekitar
            </x-nav-item>
        </li>
        <li>
            <x-nav-item :href="route('contact')" :active="request()->routeIs('contact')">
                Kontak
            </x-nav-item>
        </li>
    </ul>

    <button type="button"
        class="hidden h-11 w-40 rounded-full bg-white text-sm text-gray-700 transition-all hover:opacity-90 active:scale-95 md:inline font-semibold">
        Get started
    </button>

    <button aria-label="menu-btn" type="button" class="menu-btn inline-block transition active:scale-90 md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="#fff">
            <path
                d="M3 7a1 1 0 1 0 0 2h24a1 1 0 1 0 0-2zm0 7a1 1 0 1 0 0 2h24a1 1 0 1 0 0-2zm0 7a1 1 0 1 0 0 2h24a1 1 0 1 0 0-2z" />
        </svg>
    </button>

    <div
        class="mobile-menu absolute left-0 top-[120px] hidden w-full bg-gradient-to-r from-emerald-900 to-green-600 p-6 md:hidden shadow-lg">
        <ul class="flex flex-col space-y-4 text-lg text-white">
            <li><a href="{{ url('/') }}" class="text-sm hover:text-gray-200 transition">Home</a></li>
            <li><a href="{{ route('galery') }}" class="text-sm hover:text-gray-200 transition">Galery</a></li>
            <li><a href="{{ route('explore-sekitar') }}" class="text-sm hover:text-gray-200 transition">Explore Sekitar</a></li>
            <li><a href="{{ route('contact') }}" class="text-sm hover:text-gray-200 transition">Kontak</a></li>
        </ul>
        <button type="button"
            class="mt-6 w-full h-11 rounded-full bg-white text-sm text-gray-700 transition-all hover:opacity-90 active:scale-95 font-semibold">
            Get started
        </button>
    </div>
</nav>

<script>
    const menuButtons = document.querySelectorAll('.menu-btn');
    const mobileMenus = document.querySelectorAll('.mobile-menu');

    menuButtons.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            mobileMenus[index].classList.toggle('hidden');
        });
    });
</script>

<nav class="navbar navbar-expand-lg py-3" style="background: linear-gradient(to right, #ff0000, #28a745); min-height: 120px; position: relative; z-index: 30;">
    <div class="container-fluid px-3 px-md-4 px-lg-5 px-xl-6">
        <!-- Logo -->
        <a class="navbar-brand me-auto" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Pengempu Waterfall Logo" style="height: 150px; width: auto;">
        </a>

        <!-- Toggle Button untuk Mobile -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="#fff">
                <path d="M3 7a1 1 0 1 0 0 2h24a1 1 0 1 0 0-2zm0 7a1 1 0 1 0 0 2h24a1 1 0 1 0 0-2zm0 7a1 1 0 1 0 0 2h24a1 1 0 1 0 0-2z" />
            </svg>
        </button>

        <!-- Menu Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto gap-3 fw-bold">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link text-white {{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('explore-sekitar') }}" class="nav-link text-white {{ request()->routeIs('explore-sekitar') ? 'active' : '' }}">
                        Explore Sekitar
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('galery') }}" class="nav-link text-white {{ request()->routeIs('galery') ? 'active' : '' }}">
                        Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link text-white {{ request()->routeIs('contact') ? 'active' : '' }}">
                        Kontak
                    </a>
                </li>
            </ul>
        </div>

        <!-- Get Started Button -->
        <button type="button" class="btn btn-light btn-sm ms-3 d-none d-md-inline" style="border-radius: 50px; width: 160px; height: 44px; font-weight: 600;">
            Get started
        </button>
    </div>
</nav>

<style>
    /* Mobile Menu Styling */
    .navbar-collapse {
        position: absolute;
        top: 120px;
        left: 0;
        right: 0;
        background: linear-gradient(to right, #1a6b3c, #28a745);
        border-radius: 0;
        padding: 1.5rem;
        margin-top: 0 !important;
    }

    .navbar-collapse.show {
        display: block !important;
    }

    /* Desktop Menu */
    @media (min-width: 992px) {
        .navbar-collapse {
            position: relative;
            top: auto;
            background: transparent;
            padding: 0;
            display: flex !important;
        }

        .navbar-nav {
            align-items: center;
        }
    }

    /* Nav Item Styling */
    .navbar-expand-lg .navbar-nav .nav-link {
        padding: 0.5rem 1rem;
        font-size: 16px;
        transition: all 0.3s ease-in-out;
        position: relative;
    }

    .navbar-expand-lg .navbar-nav .nav-link:hover,
    .navbar-expand-lg .navbar-nav .nav-link.active {
        color: #ffc451 !important;
    }

    /* Mobile Button di dalam collapse */
    .navbar-collapse .btn {
        width: 100%;
        margin-left: 0 !important;
        margin-top: 1rem;
        border-radius: 50px;
        height: 44px;
        font-weight: 600;
    }

    /* Hamburger Button */
    .navbar-toggler {
        padding: 0;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .navbar-toggler:focus {
        box-shadow: none;
        outline: none;
    }

    /* Hide button di desktop */
    @media (min-width: 992px) {
        .navbar-toggler {
            display: none !important;
        }
    }
</style>

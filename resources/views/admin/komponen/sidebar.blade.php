<div class="sidebar border-right col-sm-6 col-md-3 col-lg-2 col-3 bg-body-tertiary border p-0">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        {{-- <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5> <button type="button"
                            class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                            aria-label="Close"></button>
                    </div> --}}
        <div class="offcanvas-body d-md-flex flex-column pt-lg-3 overflow-y-auto p-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ Request::is('dashboard') ? 'text-success' : '' }} gap-2"
                        aria-current="page" href="/dashboard"> <i class="fa-solid fa-house mr-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2  {{ Request::is('dashboard/posts*') ? 'text-success' : ''}}" href="/dashboard/posts">
                        <i class="fa-solid fa-gamepad mr-1"></i>
                        My Games
                    </a>
                </li>

                <li class="nav-item">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit"
                            class="nav-link d-flex align-items-center text-primary hover:text-info gap-2 bg-white"
                            style="border:none;"><i class="fa-solid fa-right-from-bracket mr-1"></i> Logout</button>
                    </form>
                </li>
            </ul>

        </div>
    </div>
</div>

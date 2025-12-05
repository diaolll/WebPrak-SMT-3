<header class="app-header">
    <div class="app-header-inner">
        <button class="app-toggler" type="button" aria-label="app toggler">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="app-header-start d-none d-md-flex">
            <form class="d-flex align-items-center h-100 w-lg-250px w-xxl-300px position-relative" action="#">
                <button type="button" class="btn btn-sm border-0 position-absolute start-0 ms-3 p-0">
                    <i class="fi fi-rr-search"></i>
                </button>
                <input type="text" class="form-control rounded-5 ps-5" placeholder="Search anything's" data-bs-toggle="modal" data-bs-target="#searchResultsModal">
            </form>
            <ul class="navbar-nav gap-4 flex-row d-none d-xxl-flex">
                <li class="nav-item">
                    <a class="nav-link" href="#">Reports & Analytics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help</a>
                </li>
            </ul>
        </div>
        <div class="app-header-end">
            <div class="px-lg-3 px-2 ps-0 d-flex align-items-center">
                <!-- Theme Toggler (Dibiarkan sebagai placeholder) -->
                <div class="dropdown">
                    <button class="btn btn-icon btn-action-gray rounded-circle waves-effect waves-light position-relative" id="ld-theme" type="button" data-bs-auto-close="outside" aria-expanded="false" data-bs-toggle="dropdown">
                        <i class="fi fi-rr-brightness scale-1x theme-icon-active"></i>
                    </button>
                    <!-- ... Dropdown Theme Menu ... -->
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><button type="button" class="dropdown-item d-flex gap-2 align-items-center" data-bs-theme-value="light" aria-pressed="false"><i class="fi fi-rr-brightness scale-1x" data-theme="light"></i> Light</button></li>
                        <li><button type="button" class="dropdown-item d-flex gap-2 align-items-center" data-bs-theme-value="dark" aria-pressed="false"><i class="fi fi-rr-moon scale-1x" data-theme="dark"></i> Dark</button></li>
                        <li><button type="button" class="dropdown-item d-flex gap-2 align-items-center" data-bs-theme-value="auto" aria-pressed="true"><i class="fi fi-br-circle-half-stroke scale-1x" data-theme="auto"></i> Auto</button></li>
                    </ul>
                </div>
            </div>
            
            <div class="vr my-3"></div> <!-- Vertical Separator -->
            
            <div class="d-flex align-items-center gap-sm-2 gap-0 px-lg-4 px-sm-2 px-1">
                <!-- Email & Notifikasi -->
                <a href="#" class="btn btn-icon btn-action-gray rounded-circle waves-effect waves-light position-relative">
                    <i class="fi fi-rr-envelope"></i>
                    <span class="position-absolute top-0 end-0 p-1 mt-1 me-1 bg-danger border border-3 border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                </a>
                <div class="dropdown text-end">
                    <button type="button" class="btn btn-icon btn-action-gray rounded-circle waves-effect waves-light" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                        <i class="fi fi-rr-bell"></i>
                    </button>
                    <!-- ... Dropdown Notifikasi ... -->
                </div>
                <a href="#" class="btn btn-icon btn-action-gray rounded-circle waves-effect waves-light">
                    <i class="fi fi-rr-calendar"></i>
                </a>
            </div>
            
            <div class="vr my-3"></div> <!-- Vertical Separator -->
            
            <!-- User Profile Dropdown (Tujuan Perbaikan) -->
            <div class="dropdown text-end ms-sm-3 ms-2 ms-lg-4">
                <a href="#" class="d-flex align-items-center py-2" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                    <div class="text-end me-2 d-none d-lg-inline-block">
                        @php
                            $roleId = session('user_role');
                            $roleName = match($roleId) {
                                1 => 'Administrator',
                                2 => 'Dokter',
                                3 => 'Perawat',
                                5 => 'Pemilik',
                                8 => 'Resepsionis',
                                default => 'Guest',
                            };
                        @endphp
                        <div class="fw-bold text-dark">{{ Auth::user()->nama ?? 'Pengguna' }}</div>
                        <small class="text-body d-block lh-sm">
                            <i class="fi fi-rr-angle-down text-3xs me-1"></i> {{ $roleName }}
                        </small>
                    </div>
                    <div class="avatar avatar-sm rounded-circle avatar-status-success">
                        <img src="{{ asset('assets/images/avatar/fotogw.jpg') }}" alt="Foto Profil Saya">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end w-225px mt-1">
                    <li class="d-flex align-items-center p-2">
                        <div class="avatar avatar-sm rounded-circle">
                            <img src="{{ asset('assets/images/avatar/fotogw.jpg') }}" alt="Foto Profil Saya">
                        </div>
                        <div class="ms-2">
                            <div class="fw-bold text-dark">{{ Auth::user()->nama ?? 'Pengguna' }}</div>
                            <small class="text-body d-block lh-sm">{{ Auth::user()->email ?? 'user@example.com' }}</small>
                        </div>
                    </li>
                    <li><div class="dropdown-divider my-1"></div></li>
<li>
    <a class="dropdown-item d-flex align-items-center gap-2" 
       href="{{ route('dokter.profile') }}">
        <i class="fi fi-rr-user scale-1x"></i> View Profile
    </a>
</li>
                    
                    <li><div class="dropdown-divider my-1"></div></li>
                            
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 text-danger">
                                <i class="fi fi-sr-exit scale-1x"></i> Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
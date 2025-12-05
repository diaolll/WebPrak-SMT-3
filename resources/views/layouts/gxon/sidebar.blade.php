<aside class="app-menubar" id="appMenubar">
    <div class="app-navbar-brand">

        {{-- LOGO KLIK SESUAI ROLE --}}
        @php
            $user   = Auth::user();
            $roleId = optional($user->roles->first())->idrole;
        @endphp

        @if ($roleId == 1) {{-- ADMIN --}}
            <a class="navbar-brand-logo" href="{{ route('admin.dashboard') }}">
        @elseif ($roleId == 2) {{-- DOKTER --}}
            <a class="navbar-brand-logo" href="{{ route('admin.Dokter.Dashboard_dokter') }}">
        @elseif ($roleId == 3) {{-- PERAWAT --}}
            <a class="navbar-brand-logo" href="{{ route('admin.perawat.Dashboard_perawat') }}">
        @elseif ($roleId == 5) {{-- PEMILIK --}}
            <a class="navbar-brand-logo" href="{{ route('admin.pemilik.Dashboard_pemilik') }}">
        @elseif ($roleId == 8) {{-- RESEPSIONIS --}}
            <a class="navbar-brand-logo" href="{{ route('admin.Resepsionis.Dashboard_Resepsionis') }}">
        @endif
                <img src="{{ asset('assets/images/logo.svg') }}" alt="RSHP Logo">
            </a>

        <a class="navbar-brand-mini" href="
            {{ $roleId == 1 ? route('admin.dashboard')
                : ($roleId == 2 ? route('admin.Dokter.Dashboard_dokter')
                : ($roleId == 3 ? route('admin.perawat.Dashboard_perawat')
                : ($roleId == 5 ? route('admin.pemilik.Dashboard_pemilik')
                : route('admin.Resepsionis.Dashboard_Resepsionis')))) }}">
            <span class="text-white fw-bold">RS MADURA</span>
        </a>
    </div>

    {{-- ==== MASTER ACTIVE CHECK (ADMIN) ==== --}}
    @php
        $masterRoutes = [
            'admin.jenis_hewan.*', 'admin.ras_hewan.*', 'admin.kategori.*',
            'admin.kategori_klinis.*', 'admin.kode_tindakan_terapi.*',
            'admin.pemilik.*', 'admin.daftar_pet.*',
            'admin.role.*', 'admin.user.*',
            'admin.dokter.*', 'admin.perawat.*'
        ];
        $isMasterActive = request()->routeIs($masterRoutes);
    @endphp

    <nav class="app-navbar" data-simplebar>
        <ul class="menubar">

            {{-- ================= DASHBOARD UMUM ================= --}}
            <li class="menu-item">
                @if ($roleId == 1)
                    <a class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                @elseif ($roleId == 2)
                    <a class="menu-link {{ request()->routeIs('admin.Dokter.Dashboard_dokter') ? 'active' : '' }}"
                       href="{{ route('admin.Dokter.Dashboard_dokter') }}">
                @elseif ($roleId == 3)
                    <a class="menu-link {{ request()->routeIs('admin.perawat.Dashboard_perawat') ? 'active' : '' }}"
                       href="{{ route('admin.perawat.Dashboard_perawat') }}">
                @elseif ($roleId == 5)
                    <a class="menu-link {{ request()->routeIs('admin.pemilik.Dashboard_pemilik') ? 'active' : '' }}"
                       href="{{ route('admin.pemilik.Dashboard_pemilik') }}">
                @elseif ($roleId == 8)
                    <a class="menu-link {{ request()->routeIs('admin.Resepsionis.Dashboard_Resepsionis') ? 'active' : '' }}"
                       href="{{ route('admin.Resepsionis.Dashboard_Resepsionis') }}">
                @endif
                        <i class="fi fi-rr-apps"></i>
                        <span class="menu-label">Dashboard</span>
                    </a>
            </li>

            {{-- =================== ADMIN =================== --}}
            @if ($roleId == 1)
            <li class="menu-heading">
                <span class="menu-label">Master Data</span>
            </li>

            <li class="menu-item menu-arrow {{ $isMasterActive ? 'menu-open' : '' }}">
                <a class="menu-link {{ $isMasterActive ? 'active' : '' }}" href="javascript:void(0);">
                    <i class="fi fi-rr-box"></i>
                    <span class="menu-label">Master Data</span>
                </a>

                <ul class="menu-inner">
                    <li class="menu-item"><a class="menu-link {{ request()->routeIs('admin.jenis_hewan.*') ? 'active' : '' }}" href="{{ route('admin.jenis_hewan.index') }}">Jenis Hewan</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->routeIs('admin.ras_hewan.*') ? 'active' : '' }}" href="{{ route('admin.ras_hewan.index') }}">Ras Hewan</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">Kategori</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->routeIs('admin.kategori_klinis.*') ? 'active' : '' }}" href="{{ route('admin.kategori_klinis.index') }}">Kategori Klinis</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->routeIs('admin.kode_tindakan_terapi.*') ? 'active' : '' }}" href="{{ route('admin.kode_tindakan_terapi.index') }}">Kode Tindakan</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->routeIs('admin.pemilik.*') ? 'active' : '' }}" href="{{ route('admin.pemilik.index') }}">Pemilik</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->routeIs('admin.daftar_pet.*') ? 'active' : '' }}" href="{{ route('admin.daftar_pet.index') }}">Daftar Pet</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">User</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}" href="{{ route('admin.dokter.index') }}">Dokter</a></li>
                    <li class="menu-item"><a class="menu-link {{ request()->routeIs('admin.perawat.*') ? 'active' : '' }}" href="{{ route('admin.perawat.index') }}">Perawat</a></li>
                </ul>
            </li>
            @endif

            {{-- =================== PERAWAT =================== --}}
            @if ($roleId == 3)
            <li class="menu-heading">
                <span class="menu-label">Menu Perawat</span>
            </li>

            @endif

            @if ($roleId == 8)
            <li class="menu-heading">
                <span class="menu-label">Akses Resepsionis</span>
            </li>
            <li class="menu-item"><a class="menu-link {{ request()->routeIs('Resepsionis.pemilik.*') ? 'active' : '' }}" href="{{ route('admin.resepsionis.temu_dokter.index') }}">Temu Dokter</a></li>
            <li class="menu-item"><a class="menu-link {{ request()->routeIs('Resepsionis.pet.*') ? 'active' : '' }}" href="{{ route('admin.Resepsionis.pet.index') }}">Daftar Pet</a></li>
            <li class="menu-item"><a class="menu-link {{ request()->routeIs('Resepsionis.pemilik.*') ? 'active' : '' }}" href="{{ route('admin.resepsionis.pemilik.index') }}">Daftar Pemilik</a></li>


            @endif

        </ul>
    </nav>
</aside>

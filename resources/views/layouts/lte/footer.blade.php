<!DOCTYPE html>
<html lang="en">

@include('layouts.lte.head')

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary" data-lte-app-classes="[{'body':'sidebar-open'}]">
    <div class="app-wrapper">

        <!--begin::Navbar-->
        @include('layouts.lte.navbar')
        <!--end::Navbar-->

        <!--begin::Sidebar-->
        @include('layouts.lte.sidebar')
        <!--end::Sidebar-->

        <!--begin::App Main-->
        <main class="app-main">
            <div class="app-content">
                <div class="container-fluid">
                    
                    <!-- Content Header (Page header) -->
                    @yield('content-header')

                    <!-- Main content -->
                    @yield('content')
                    <!-- /.content -->

                </div>
            </div>
        </main>
        <!--end::App Main-->

        <!--begin::Footer-->
        @include('layouts.lte.footer')
        <!--end::Footer-->

    </div>

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.1.1/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    
    <!--begin::Third Party Plugin(popperjs)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(popperjs)-->
    
    <!--begin::Third Party Plugin(bootstrap)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(bootstrap)-->

    <!--begin::AdminLTE App-->
    <script src="{{ asset('assets/js/adminlte.js') }}"></script>
    <!--end::AdminLTE App-->

    <!-- Tambahan JS Khusus Jika Ada -->
    @stack('scripts')

    <!-- Script untuk inisialisasi OverlayScrollbars (sesuai dokumentasi AdminLTE) -->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };

        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbars !== 'undefined') {
                OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    }
                });
            }
        });
    </script>
</body>
</html>
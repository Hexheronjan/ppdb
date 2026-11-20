<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.partial.head')
    <title>Aplikasi PPDB</title>
    <style>
        /* === SIDEBAR RESPONSIVE FIX ===
           Sidebar permanen di laptop (>= 1024px), overlay di HP (< 1024px) */

        /* Tampilkan sidebar permanen di semua layar >= 1024px */
        @media (min-width: 1024px) {
            #application-sidebar-brand {
                display: block !important;
                transform: translateX(0) !important;
                position: fixed !important;
            }
            /* Geser konten ke kanan sejauh lebar sidebar */
            .page-wrapper {
                margin-left: 270px !important;
            }
            /* Sembunyikan tombol hamburger di laptop */
            #headerCollapse {
                display: none !important;
            }
        }

        /* Di HP (< 1024px): sidebar jadi overlay, konten full width */
        @media (max-width: 1023px) {
            .page-wrapper {
                margin-left: 0 !important;
            }
            /* Tampilkan tombol hamburger */
            #headerCollapse {
                display: block !important;
            }
        }

        /* Cegah halaman scroll horizontal */
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body class="bg-grey">
    <main>
        <!-- Start the project -->
        <div id="main-wrapper" class="flex">
			<aside id="application-sidebar-brand"
				class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full  transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed top-0 with-vertical h-screen z-[999] flex-shrink-0 border-r-[1px] w-[270px] border-gray-400  bg-white left-sidebar   transition-all duration-300"
				data-hs-overlay-backdrop-template='<div class="hs-overlay-backdrop bg-gray-900/50 fixed inset-0 z-[998]"></div>'>
				@include('layouts.admin.partial.sidebar')
			</aside>
		
            <div class="w-full page-wrapper">
                <!-- Header Start -->
                <header class="container full-container w-full text-sm py-5 xl:px-9 px-5">
                    @include('layouts.admin.partial.header')
                </header>
                <!-- Header End -->

                <!-- Main Content -->
                <div class="content-container">
                    @yield('content')
                    @include('layouts.admin.partial.footer')
                </div>
             
                <!-- Main Content End -->
				
            </div>
      
     
        </div>
    
        <!-- End of project -->
   
    </main>
    @include('layouts.admin.partial.scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

    <!-- jQuery (dibutuhkan Lightbox2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
	<!-- ApexCharts -->
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    
    <!-- Script Fix Backdrop Sidebar Mobile -->
    <script>
        function cleanupSidebarBackdrop() {
            document.querySelectorAll('.hs-overlay-backdrop').forEach(function(el) {
                el.remove();
            });
            document.body.classList.remove('overflow-hidden');
            document.documentElement.classList.remove('overflow-hidden');
        }

        window.addEventListener('pageshow', cleanupSidebarBackdrop);

        document.addEventListener('DOMContentLoaded', function() {
            cleanupSidebarBackdrop();

            // Saat link menu sidebar diklik di HP, tutup sidebar & hapus backdrop
            document.querySelectorAll('#sidebarnav a, #sidebarnav button').forEach(function(item) {
                item.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        const sidebar = document.getElementById('application-sidebar-brand');
                        if (sidebar && window.HSOverlay) {
                            HSOverlay.close(sidebar);
                        }
                        setTimeout(cleanupSidebarBackdrop, 150);
                    }
                });
            });

            // Klik backdrop untuk menutup langsung
            document.addEventListener('click', function(e) {
                if (e.target && e.target.classList && e.target.classList.contains('hs-overlay-backdrop')) {
                    const sidebar = document.getElementById('application-sidebar-brand');
                    if (sidebar && window.HSOverlay) {
                        HSOverlay.close(sidebar);
                    }
                    setTimeout(cleanupSidebarBackdrop, 100);
                }
            });
        });
    </script>
</body>
</html>
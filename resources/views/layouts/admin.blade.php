<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AppCalzado - Admin')</title>
    <!-- CoreUI CSS -->
    <link href="{{ asset('assets/css/coreui.min.css') }}" rel="stylesheet">
    @yield('css')
    <!-- CoreUI Icons (CDN temporal para iconos) -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/icons@3.0.1/css/all.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .app {
            min-height: 100vh;
        }
        .sidebar {
            z-index: 1030;
            width: 256px;
            transition: all 0.3s ease;
        }
        .sidebar.sidebar-narrow {
            width: 56px;
        }
        .sidebar.sidebar-narrow .sidebar-brand strong,
        .sidebar.sidebar-narrow .nav-link span {
            display: none;
        }
        .sidebar.sidebar-narrow .sidebar-brand {
            padding: 1.71rem 0.5rem;
        }
        .sidebar .nav-link {
            padding: 0.75rem 1rem;
            color: #768192;
            display: flex;
            align-items: center;
        }
        .nav-dropdown-items {
            display: none;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .nav-dropdown.show .nav-dropdown-items {
            display: block !important;
        }

        .nav-dropdown-items .nav-link {
            padding-left: 3rem;
        }

        /* Estilo del chevron */
        .nav-chevron {
            margin-left: auto;
            font-size: 12px;
            transition: transform 0.3s ease;
        }
        /* Rotar chevron cuando está expandido */
        .nav-dropdown.show .nav-chevron {
            transform: rotate(90deg);
        }
        .sidebar .nav-dropdown-items {
            list-style: none;
            padding-left: 0;
            margin-left: 0;
        }
        .sidebar .nav-link:hover {
            color: #e8e7ec;
            background-color: #3540d3;
        }
        .sidebar .nav-link.active {
            color: #e8e7ec;
            background-color: #3540d3;
        }
        .sidebar .nav-icon {
            margin-right: 0.5rem;
            width: 1.25rem;
            text-align: center;
            flex-shrink: 0;
        }
        .sidebar.sidebar-narrow .nav-link {
            padding: 0.75rem 0.5rem;
            justify-content: center;
        }
        .sidebar-brand {
            padding: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid #d8dbe0;
        }
        .sidebar-brand strong {
            font-size: 1.125rem;
            color: #303c54;
        }
        .sidebar.sidebar-narrow .sidebar-brand::before {
            content: '';
            display: block;
            width: 24px;
            height: 24px;
            background-image: url('{{ asset('assets/images/shoe-prints-solid-full.svg') }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        .sidebar.sidebar-narrow .sidebar-brand {
            padding: 1rem 0.5rem;
            justify-content: center;
        }
        .wrapper {
            margin-left: 256px;
            transition: all 0.3s ease;
        }
        .header {
            background: #fff;
            border-bottom: 1px solid #d8dbe0;
            margin-bottom: 0 !important;
        }
        .body {
            padding: 1rem;
            background-color: #ebedef;
        }
        @media (max-width: 991.98px) {
            .wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="app">
        <!-- Sidebar Component -->
        @include('components.sidebar')
        <!-- Main content wrapper -->
        <div class="wrapper d-flex flex-column min-vh-100">
            <!-- Navbar Component -->
            @include('components.navbar')
            <!-- Page Content -->
            <div class="body flex-grow-1">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- Footer Component -->
            @include('components.footer')
        </div>
    </div>

    <!-- CoreUI JavaScript -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/coreui.min.js') }}"></script>
    <script>
        // Función para toggle del sidebar
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const wrapper = document.querySelector('.wrapper');
            if (sidebar && wrapper) {
                sidebar.classList.toggle('sidebar-narrow');
                // Ajustar margen del contenido principal
                if (sidebar.classList.contains('sidebar-narrow')) {
                    wrapper.style.marginLeft = '56px';
                } else {
                    wrapper.style.marginLeft = '256px';
                }
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggles = document.querySelectorAll('.nav-dropdown-toggle');
            
            dropdownToggles.forEach(function(toggle) {
                const parent = toggle.closest('.nav-dropdown');
                const dropdownItems = parent.querySelector('.nav-dropdown-items');
                
                // Verificar si hay una opción activa dentro del dropdown al cargar
                const activeItem = dropdownItems.querySelector('.nav-link.active');
                if (activeItem) {
                    parent.classList.add('show');
                    dropdownItems.style.display = 'block';
                }
                
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Toggle la clase 'show' en el parent
                    parent.classList.toggle('show');
                    
                    // Toggle display del submenu
                    if (parent.classList.contains('show')) {
                        dropdownItems.style.display = 'block';
                    } else {
                        dropdownItems.style.display = 'none';
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>
    @yield('js')
    @include('partials.alerts')
</body>
</html>
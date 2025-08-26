<header class="header header-sticky">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="toggleSidebar()">
            <i class="cil-menu"></i>
        </button>
        
        <!-- Breadcrumb opcional -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                @yield('breadcrumb')
            </ol>
        </nav>
        
        <ul class="header-nav ms-auto">
            <!-- Notificaciones -->
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="cil-bell"></i>
                    <span class="badge badge-sm bg-danger">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <h6 class="dropdown-header">Notificaciones</h6>
                    <a class="dropdown-item" href="#">
                        <i class="cil-info text-info"></i> Nuevo pedido recibido
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="cil-warning text-warning"></i> Stock bajo en productos
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-center" href="#">Ver todas</a>
                </div>
            </li>
            
            <!-- Usuario -->
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md">
                        <i class="cil-user"></i>
                    </div>
                    <span class="ms-2">Admin</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <h6 class="dropdown-header">Cuenta</h6>
                    <a class="dropdown-item" href="#">
                        <i class="cil-user"></i> Mi Perfil
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="cil-settings"></i> Configuración
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <i class="cil-account-logout"></i> Cerrar Sesión
                    </a>
                </div>
            </li>
        </ul>
    </div>
</header>
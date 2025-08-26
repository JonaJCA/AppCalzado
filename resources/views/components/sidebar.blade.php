<div class="sidebar sidebar-fixed">
    <div class="sidebar-brand">
        <strong>AppCalzado</strong>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="nav-icon cil-speedometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon cil-people"></i>
                    <span>Clientes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon cil-basket"></i>
                    <span>Productos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon cil-chart-pie"></i>
                    <span>Reportes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon cil-settings"></i>
                    <span>Configuración</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
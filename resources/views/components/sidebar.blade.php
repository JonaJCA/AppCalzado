<div class="sidebar sidebar-fixed">
    <div class="sidebar-brand">
        <strong>AppCalzado</strong>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="nav-icon cil-speedometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0)">
                    <i class="nav-icon cil-settings"></i>
                    <span>Config. Base</span>
                    <i class="nav-chevron cil-chevron-right"></i>
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tallas.*') ? 'active' : '' }}" href="{{ route('tallas.index') }}">
                            <span class="nav-icon"></span>
                            <span>Tallas</span>
                        </a>
                    </li>
                </ul>
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
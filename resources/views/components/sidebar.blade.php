<div class="sidebar sidebar-fixed">
    <div class="sidebar-brand">
        <strong>AppCalzado</strong>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="nav-icon fa-solid fa-house"></i> Dashboard
                </a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="javascript:void(0)">
                    <i class="nav-icon fa-solid fa-gears"></i>
                    <span>Config. Base</span>
                    <i class="nav-chevron fa-solid fa-chevron-right"></i>
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categorias.*') ? 'active' : '' }}" href="{{ route('categorias.index') }}">
                            <i class="nav-icon fa-solid fa-tag"></i> Categorías
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('colores.*') ? 'active' : '' }}" href="{{ route('colores.index') }}">
                            <i class="nav-icon fa-solid fa-palette"></i> Colores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('marcas.*') ? 'active' : '' }}" href="{{ route('marcas.index') }}">
                            <i class="nav-icon fa-solid fa-clipboard-check"></i> Marcas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('modelos.*') ? 'active' : '' }}" href="{{ route('modelos.index') }}">
                            <i class="nav-icon fa-solid fa-list"></i> Modelos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tallas.*') ? 'active' : '' }}" href="{{ route('tallas.index') }}">
                            <i class="nav-icon fa-solid fa-arrow-down-1-9"></i> Tallas
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}" href="{{ route('productos.index') }}">
                    <i class="nav-icon fa-solid fa-box-open"></i> Productos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('inventarios.*') ? 'active' : '' }}" href="{{ route('inventarios.index') }}">
                    <i class="nav-icon fa-solid fa-file-lines"></i> Inventario
                </a>
            </li>
        </ul>
    </nav>
</div>
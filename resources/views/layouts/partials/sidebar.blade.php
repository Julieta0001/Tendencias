<aside class="main-sidebar sidebar-dark-primary elevation-0">
    {{-- Marca --}}
    <a href="{{ url('/home') }}" class="brand-link">
        <span class="brand-mark"><i class="fas fa-paper-plane"></i></span>
        <span class="brand-text">Turismo</span>
    </a>

    {{-- Sidebar --}}
    <div class="sidebar">
        {{-- Menú --}}
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-compass"></i>
                        <p>Panel</p>
                    </a>
                </li>

                {{-- Traveler --}}
                <li class="nav-item">
                    <a href="{{ url('/travelers') }}" class="nav-link {{ request()->is('travelers*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-suitcase-rolling"></i>
                        <p>Viajeros</p>
                    </a>
                </li>

                {{-- Destination --}}
                <li class="nav-item">
                    <a href="{{ url('/destinations') }}" class="nav-link {{ request()->is('destinations*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>Destinos</p>
                    </a>
                </li>

            </ul>
        </nav>
        {{-- /.sidebar-menu --}}
    </div>
    {{-- /.sidebar --}}
</aside>
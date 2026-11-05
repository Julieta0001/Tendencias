@php
    $primerNombre = explode(' ', trim(Auth::user()->name))[0];
@endphp
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    {{-- Izquierda: menú + saludo --}}
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link menu-toggle" data-widget="pushmenu" href="#" role="button" title="Mostrar u ocultar menú">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item">
            <div class="greet">
                <strong><span id="greetText">Hola</span>, {{ $primerNombre }}</strong>
                <small id="greetDate"></small>
            </div>
        </li>
    </ul>

    {{-- Derecha: reloj, usuario y salir --}}
    <ul class="navbar-nav ml-auto align-items-center">
        
        <li class="nav-item">
            <div class="user-chip">
                @php
                $userPhotoPath = 'uploads/users/' . Auth::user()->photo;
                @endphp
                <span class="ring">
                    @if (!empty(Auth::user()->photo) && file_exists(public_path($userPhotoPath)))
                    <img src="{{ asset($userPhotoPath) }}" alt="{{ Auth::user()->name }}">
                    @else
                    <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" alt="">
                    @endif
                </span>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-logout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" title="Cerrar sesión" role="button">
                <i class="fas fa-power-off"></i><span>Salir</span>
            </a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                @csrf
            </form>
        </li>
    </ul>
</nav>


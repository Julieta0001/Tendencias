@extends('layouts.app')

@section('title','Panel De Control')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('title')</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">

            {{-- Portada: volando sobre las nubes --}}
            <div class="hero-sky">
                <svg viewBox="0 0 1200 360" preserveAspectRatio="xMidYMax slice" aria-hidden="true">
                    <defs>
                        <linearGradient id="cielo" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0" stop-color="#0B49C2"/>
                            <stop offset=".5" stop-color="#2E7DEB"/>
                            <stop offset=".8" stop-color="#8EC5FF"/>
                            <stop offset="1" stop-color="#E9F3FF"/>
                        </linearGradient>
                        <radialGradient id="luz" cx=".5" cy=".5" r=".5">
                            <stop offset="0" stop-color="#fff" stop-opacity=".55"/>
                            <stop offset="1" stop-color="#fff" stop-opacity="0"/>
                        </radialGradient>
                        <g id="nube" fill="#fff">
                            <circle cx="60" cy="44" r="30"/>
                            <circle cx="104" cy="28" r="38"/>
                            <circle cx="152" cy="44" r="30"/>
                            <rect x="30" y="44" width="152" height="30" rx="15"/>
                        </g>
                    </defs>

                    <rect width="1200" height="360" fill="url(#cielo)"/>
                    <circle cx="1020" cy="60" r="230" fill="url(#luz)"/>

                    {{-- Nubes lejanas que se desplazan despacio --}}
                    <g class="drift">
                        <use href="#nube" transform="translate(520 74) scale(.9)" opacity=".5"/>
                        <use href="#nube" transform="translate(790 170) scale(1.1)" opacity=".38"/>
                        <use href="#nube" transform="translate(240 190) scale(1.2)" opacity=".3"/>
                        <use href="#nube" transform="translate(1040 190) scale(.8)" opacity=".4"/>
                    </g>

                    {{-- Ruta de vuelo --}}
                    <path d="M470 250 C 560 235 640 200 690 165 C 735 133 700 90 660 105 C 620 120 640 175 720 150 C 800 126 880 90 950 74"
                          fill="none" stroke="#fff" stroke-opacity=".85" stroke-width="2.2" stroke-dasharray="4 9" stroke-linecap="round"/>

                    {{-- Avión de papel --}}
                    <g class="float">
                        <g transform="translate(900 22) scale(.95) rotate(-6)">
                            <polygon points="10,80 300,5 120,100" fill="#FFFFFF"/>
                            <polygon points="300,5 120,100 165,165" fill="#CFE3FF"/>
                            <polygon points="120,100 165,165 104,128" fill="#9CC4F5"/>
                            <polygon points="10,80 120,100 104,128" fill="#E8F1FF"/>
                        </g>
                    </g>

                    {{-- Mar de nubes --}}
                    <path d="M0 290 C 70 262 150 266 210 288 C 270 254 370 254 430 284 C 510 250 630 254 690 284 C 770 252 890 254 950 282 C 1030 254 1130 262 1200 282 L1200 360 L0 360Z" fill="#fff" opacity=".6"/>
                    <path d="M0 316 C 90 290 170 296 240 314 C 320 284 420 288 490 312 C 580 282 700 288 770 312 C 850 286 960 290 1030 310 C 1100 288 1160 296 1200 306 L1200 360 L0 360Z" fill="#fff"/>
                </svg>
                <div class="hero-text">
                    <h2>Despegamos, {{ Auth::user()->name }}</h2>
                    <p class="script">Explora. Sueña. Descubre.</p>
                    <p class="sub">Tu torre de control de viajeros y destinos.</p>
                </div>
            </div>

            <div class="row">
                {{-- Viajeros --}}
                <div class="col-lg-6">
                    <div class="ticket-wrap">
                        <div class="ticket">
                            <div class="tk-top">
                                <span class="tk-bars"><i></i><i></i><i></i><i></i></span>
                                <span class="tk-flight">Vuelo TUR-01 / Puerta A</span>
                            </div>
                            <div class="tk-body">
                                <i class="fas fa-suitcase-rolling tk-icon"></i>
                                <div>
                                    <h3>Viajeros</h3>
                                    <p>Quién viaja con nosotros</p>
                                </div>
                            </div>
                            <div class="tk-cut"></div>
                            <div class="tk-bottom">
                                <div class="tk-actions">
                                    <a href="{{ url('/travelers') }}" class="tk-btn"><i class="fas fa-list"></i> Ver lista</a>
                                    <a href="{{ url('/travelers/create') }}" class="tk-btn ghost"><i class="fas fa-plus"></i> Agregar</a>
                                </div>
                                <span class="tk-barcode" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Destinos --}}
                <div class="col-lg-6">
                    <div class="ticket-wrap is-sky">
                        <div class="ticket">
                            <div class="tk-top">
                                <span class="tk-bars"><i></i><i></i><i></i><i></i></span>
                                <span class="tk-flight">Vuelo TUR-02 / Puerta B</span>
                            </div>
                            <div class="tk-body">
                                <i class="fas fa-map-marked-alt tk-icon"></i>
                                <div>
                                    <h3>Destinos</h3>
                                    <p>A dónde queremos llegar</p>
                                </div>
                            </div>
                            <div class="tk-cut"></div>
                            <div class="tk-bottom">
                                <div class="tk-actions">
                                    <a href="{{ url('/destinations') }}" class="tk-btn"><i class="fas fa-list"></i> Ver lista</a>
                                    <a href="{{ url('/destinations/create') }}" class="tk-btn ghost"><i class="fas fa-plus"></i> Agregar</a>
                                </div>
                                <span class="tk-barcode" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
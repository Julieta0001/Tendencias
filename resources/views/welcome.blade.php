<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turismo | Bienvenido</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;1,9..144,400&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --mar: #0b2a33;
            --arena: #f3ead9;
            --oro: #e3a857;
            --espuma: #fbf8f1;
        }

        body { font-family: 'Manrope', sans-serif; }
        .titulo { font-family: 'Fraunces', Georgia, serif; }

        /* Fondo: foto a pantalla completa. Si no carga, queda el degradado */
        .hero {
            background-color: var(--mar);
            background-image:
                linear-gradient(100deg, rgba(11,42,51,.88) 0%, rgba(11,42,51,.45) 55%, rgba(11,42,51,.15) 100%),
                url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }

        /* Tarjeta tipo pase de abordar: dos mitades con muescas laterales */
        .pase-top {
            border-radius: 20px 20px 0 0;
            -webkit-mask:
                radial-gradient(circle 13px at 0 100%, #0000 97%, #000) left / 51% 100% no-repeat,
                radial-gradient(circle 13px at 100% 100%, #0000 97%, #000) right / 51% 100% no-repeat;
            mask:
                radial-gradient(circle 13px at 0 100%, #0000 97%, #000) left / 51% 100% no-repeat,
                radial-gradient(circle 13px at 100% 100%, #0000 97%, #000) right / 51% 100% no-repeat;
        }
        .pase-stub {
            position: relative;
            border-radius: 0 0 20px 20px;
            -webkit-mask:
                radial-gradient(circle 13px at 0 0, #0000 97%, #000) left / 51% 100% no-repeat,
                radial-gradient(circle 13px at 100% 0, #0000 97%, #000) right / 51% 100% no-repeat;
            mask:
                radial-gradient(circle 13px at 0 0, #0000 97%, #000) left / 51% 100% no-repeat,
                radial-gradient(circle 13px at 100% 0, #0000 97%, #000) right / 51% 100% no-repeat;
        }
        .pase-stub::before {
            content: "";
            position: absolute;
            top: 0; left: 22px; right: 22px;
            border-top: 2px dashed rgba(11,42,51,.25);
        }

        /* Única animación: el pase aparece al cargar la página */
        @keyframes llegada {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: none; }
        }
        .llegada { animation: llegada .8s ease-out both; }
        @media (prefers-reduced-motion: reduce) { .llegada { animation: none; } }

        .btn:focus-visible { outline: 3px solid var(--oro); outline-offset: 3px; }
    </style>
</head>

<body class="hero min-h-screen text-white">
    <main class="min-h-screen max-w-6xl mx-auto px-6 py-10 grid lg:grid-cols-2 gap-12 items-center">

        {{-- Mensaje principal --}}
        <section class="order-2 lg:order-1">
            <p class="flex items-center gap-2 text-sm font-semibold" style="color: var(--oro)">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                </svg>
                Viajes y destinos
            </p>

            <h1 class="titulo mt-5 text-5xl sm:text-6xl leading-[1.05]">
                El mundo es más grande<br>de lo que imaginas.
            </h1>

            <p class="mt-6 text-lg max-w-md leading-relaxed" style="color: rgba(251,248,241,.8)">
                Gestiona destinos, clientes y reservas desde un solo lugar y diseña viajes que la gente recuerde.
            </p>
        </section>

        {{-- Pase de abordar: acceso --}}
        <section class="order-1 lg:order-2 flex justify-center lg:justify-end">
            <div class="llegada w-full max-w-sm drop-shadow-2xl">

                <div class="pase-top p-8 pb-9" style="background: var(--espuma); color: var(--mar)">
                    <div class="flex items-center justify-between">
                        <span class="titulo text-2xl">Turismo</span>
                        <span class="text-sm" style="color: rgba(11,42,51,.6)">Pase de acceso</span>
                    </div>

                    {{-- Ruta: origen → destino --}}
                    <div class="mt-8 flex items-center gap-3" aria-hidden="true">
                        <span class="w-2.5 h-2.5 rounded-full" style="background: var(--mar)"></span>
                        <span class="flex-1 border-t-2 border-dashed" style="border-color: rgba(11,42,51,.3)"></span>
                        <svg class="w-6 h-6 rotate-90" viewBox="0 0 24 24" fill="currentColor" style="color: var(--oro)">
                            <path d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                        </svg>
                        <span class="flex-1 border-t-2 border-dashed" style="border-color: rgba(11,42,51,.3)"></span>
                        <span class="w-2.5 h-2.5 rounded-full border-2" style="border-color: var(--mar)"></span>
                    </div>

                    <h2 class="titulo mt-8 text-3xl leading-tight">Tu próximo destino empieza aquí</h2>
                    <p class="mt-2 text-sm" style="color: rgba(11,42,51,.7)">
                        Inicia sesión o crea tu cuenta para continuar.
                    </p>
                </div>

                <div class="pase-stub p-8 pt-9 space-y-3" style="background: var(--arena)">
                    <a href="{{ route('login') }}"
                       class="btn block w-full text-center font-semibold py-3.5 rounded-xl transition-colors"
                       style="background: var(--mar); color: var(--espuma)"
                       onmouseover="this.style.background='#12404c'" onmouseout="this.style.background='#0b2a33'">
                        Iniciar sesión
                    </a>

                    <a href="{{ route('register') }}"
                       class="btn block w-full text-center font-semibold py-3.5 rounded-xl border-2 transition-colors"
                       style="border-color: var(--mar); color: var(--mar)"
                       onmouseover="this.style.background='rgba(11,42,51,.08)'" onmouseout="this.style.background='transparent'">
                        Crear cuenta
                    </a>

                    <p class="pt-2 text-center text-sm" style="color: rgba(11,42,51,.65)">
                        ¿Necesitas ayuda?
                        <a href="#" class="font-semibold underline underline-offset-2" style="color: var(--mar)">Contáctanos</a>
                    </p>
                </div>

            </div>
        </section>

    </main>
</body>
</html>
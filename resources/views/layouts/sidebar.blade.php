<nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid d-flex align-items-center">
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
            <button 
                class="navbar-toggler"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            @auth
                @canany(['user','admin','adminMax'])
                    <a class="bot botNegro" href="{{ url('/home') }}" title="Carrito" style="font-size: 20px;">
                        🪪
                    </a>
                @endcanany
            @endauth
        </div>        
        {{-- CENTRO: Logo --}}
        <div class="mx-auto">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" style="width:40px; height:auto;">
            </a>
        </div>
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
            @guest
                <a href="{{ route('login') }}" class="bot botNegro" title="Iniciar sesión">
                    🟠👤
                </a>
            @else
                <span class="small fw-semibold text-truncate d-inline-block" 
                    style="font-size: 1.5rem; max-width:120px;">
                    {{ explode(' ', Auth::user()->name)[0] }}
                </span>
                @canany(['admin', 'adminMax'])
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="bot botNegro" title="Cerrar sesión">🟢⚙️</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="bot botNegro" title="Cerrar sesión">🟢👤</button>
                    </form>
                @endcanany
            @endguest
        </div>
    </div>

    {{-- OFFCANVAS --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">
                @canany(['admin','adminMax'])
                    🛠️ Panel Administrativo
                @else
                    📂 Menú
                @endcanany
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body">
            <ul class="navbar-nav flex-grow-1 pe-3">
                <li class="nav-item dropdown mt-2">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        👥 Miembros de AA
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/carritos') }}">📚 Literatura y Plenitud</a></li>
                        <li><a class="dropdown-item" href="{{ url('/') }}">📰 Boletín mensual</a></li>
                        <li><a class="dropdown-item" href="{{ url('/miscelanea#servidores') }}">👤 Servidores de área</a></li>
                        <li><a class="dropdown-item" href="{{ url('/miscelanea#mapa') }}">🗺️ Mapa de grupos</a></li>
                        <li><a class="dropdown-item" href="{{ url('/miscelanea#rifa') }}">🎟️ Rifa</a></li>
                    </ul>
                </li>                
                @canany(['admin', 'adminMax'])
                    <li class="nav-item dropdown mt-2">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            🔧 Catálogos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/users') }}">👤 Usuarios</a></li>
                            <li><a class="dropdown-item" href="{{ url('/mensajes') }}">💬 Mensajes</a></li>
                            <li><a class="dropdown-item" href="{{ url('/distritos') }}">📍 Distritos</a></li>
                            <li><a class="dropdown-item" href="{{ url('/grupos') }}">🏘️ Grupos</a></li>
                        </ul>
                    </li>
                @endcanany

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/registro') }}">📝 Registro</a>
                    </li>                
                @else
                @endguest
            </ul>
        </div>
    </div>
</nav>

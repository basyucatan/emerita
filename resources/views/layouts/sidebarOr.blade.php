<nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid d-flex align-items-center">
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
            <button 
                class="navbar-toggler" 
                type="button" 
                data-bs-toggle="offcanvas" 
                data-bs-target="#offcanvasNavbar" 
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            @auth
                @canany(['user','admin','adminMax'])
                    <a class="bot botNegro" href="{{ url('/home') }}" title="Inicio" style="font-size: 20px;">
                        🪪
                    </a>
                @endcanany
            @endauth
        </div>
        <div class="mx-auto">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" style="width:40px; height:auto;" alt="Logo">
            </a>
        </div>
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
            @guest
                <a href="{{ route('login') }}" class="bot botNegro" title="Iniciar sesión">
                    🟠👤
                </a>
            @else
                <span class="small fw-semibold text-truncate d-inline-block" style="font-size: 1.5rem; max-width:120px;">
                    {{ explode(' ', Auth::user()->name)[0] }}
                </span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="bot botNegro" title="Cerrar sesión">
                        @canany(['admin', 'adminMax']) 🟢⚙️ @else 🟢👤 @endcanany
                    </button>
                </form>
            @endguest
        </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menú</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active text-dark fs-4" href="{{ url('/presus') }}" title="Presupuestos">
                            <i class="bi bi-currency-dollar"></i>⚡Presupuestos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            🔗 Catálogos
                        </a>
                        <ul class="dropdown-menu show">
                            <li class="dropend">
                                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    🏢 Empresas
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/negocios') }}" class="dropdown-item">🧰 Negocio</a></li>
                                    <li><a href="{{ url('/divisions') }}" class="dropdown-item">📌 Divisiones</a></li>
                                    <li><a href="{{ url('/empresas') }}" class="dropdown-item">🏢 Empresas</a></li>
                                    <li><a href="{{ url('/obras') }}" class="dropdown-item">🏗️ Obras</a></li>
                                </ul>
                            </li>
                            <li class="dropend">
                                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    🪟 Presupuestos y Modelos
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/marcas') }}" class="dropdown-item">🧿 Marcas</a></li>
                                    <li><a href="{{ url('/lineas') }}" class="dropdown-item">📁 Líneas</a></li>
                                    <li><a href="{{ url('/modelos') }}" class="dropdown-item">🪟 Modelos</a></li>
                                </ul>
                            </li>

                            @can('admin')
                                <li class="dropend">
                                    <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" aria-expanded="false">
                                        🧱 Materiales
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="dropend">
                                            <a class="dropdown-item dropdown-toggle custom-toggle" href="#">
                                                📑 Generales</a>
                                            <ul class="dropdown-menu inner-menu">
                                                <li><a href="{{ url('/fichamats') }}" class="dropdown-item">🗂️ Ficha del Material</a>
                                                </li>
                                                <li><a href="{{ url('/vidrios') }}" class="dropdown-item">🪟 Vidrios</a>
                                                </li>
                                                <li><a href="{{ url('/clases') }}" class="dropdown-item">🧩 Clases</a></li>
                                                <li><a href="{{ url('/tablaherrajes') }}" class="dropdown-item">🛠️ Tabla
                                                        Herrajes</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropend">
                                            <a class="dropdown-item dropdown-toggle custom-toggle" href="#">
                                                🪟 Ventanas</a>
                                            <ul class="dropdown-menu inner-menu">
                                                <li><a href="{{ url('/barras') }}" class="dropdown-item">📏 Barras</a></li>
                                                <li><a href="{{ url('/panels') }}" class="dropdown-item">🔳 Paneles</a>
                                                </li>
                                                <li><a href="{{ url('/tipos') }}" class="dropdown-item">🏷️ Tipos</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropend">
                                            <a class="dropdown-item dropdown-toggle custom-toggle" href="#">
                                                🔲 Cortinas</a>
                                            <ul class="dropdown-menu inner-menu">
                                                <li><a href="{{ url('/laminas') }}" class="dropdown-item">💲 Láminas</a>
                                                </li>
                                                <li><a href="{{ url('/guias') }}" class="dropdown-item">💲 Guías</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropend">
                                    <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        📦 Inventarios
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/kardex') }}" class="dropdown-item">📇 Kardex</a></li>
                                        <li><a href="{{ url('/invfisicos') }}" class="dropdown-item">📊 Inv. Físico</a>
                                        </li>
                                        <li><a href="{{ url('/compras') }}" class="dropdown-item">🛒 Compras</a></li>
                                        <li><a href="{{ url('/cortes') }}" class="dropdown-item">🪚 Cortes</a></li>
                                    </ul>
                                </li>
                                <li class="dropend">
                                    <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        🛠️ Básicos
                                    </a>
                                    <ul class="dropdown-menu">
                                        @can('adminMax')
                                            <li><a href="{{ url('/users') }}" class="dropdown-item">👥 Usuarios</a></li>
                                            <li><a href="{{ url('/deptos') }}" class="dropdown-item">🧑‍🤝‍🧑
                                                    Departamentos</a></li>
                                        @endcan
                                        <li><a href="{{ url('/unidads') }}" class="dropdown-item">🧮 Unidades</a></li>
                                        <li><a href="{{ url('/monedas') }}" class="dropdown-item">🪙 Monedas</a></li>
                                        <li><a href="{{ url('/colors') }}" class="dropdown-item">🌈 Colores</a></li>
                                        <li><a href="{{ url('/colorables') }}" class="dropdown-item">🖌️ Colorables</a>
                                        </li>
                                        <li><a href="{{ url('/aperturas') }}" class="dropdown-item">↩️ Aperturas</a></li>
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">🔑 {{ __('Login') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                🔑 {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    🚪 {{ __('Salir') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('custom-toggle')) {
            e.preventDefault();
            e.stopPropagation();
            const menu = e.target.nextElementSibling;
            const isVisible = menu.classList.contains('show');
            const parentMenu = e.target.closest('.dropdown-menu');
            parentMenu.querySelectorAll('.inner-menu').forEach(el => {
                el.classList.remove('show');
            });
            if (!isVisible) {
                menu.classList.add('show');
            }
        }
    });
</script>
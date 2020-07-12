
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <meta id= 23 name="prueba" content="23">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/js/bootstrap-colorpicker.min.js"></script>
    <script src="{{ asset('js/siplac.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/open-iconic.min.css')}}" />
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.min.css" rel="stylesheet">

</head>
<body>
    {{-- solo falta agregar que sea una pantalla en modal fade --}}
    @include('cargando.cargando')
    <div id="app">
        <div class="container-fluid">
            <nav class="mb-0 navbar navbar-expand-md navbar-light bg-white shadow-lg">
                <div class="">

                    <a class="display-5 navbar-brand" href="{{ url('/inicio') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                {{-- si esta logiado pone esta parte --}}
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Menu superior-->
                    @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                        <ul class="nav nav-tabs mr-auto">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Mantenimientos</a>
                                <div class="dropdown-menu">

                                    @can('usuarios.index')
                                    <a class="dropdown-item" href="{{ route('usuarios.index')}}">
                                        Usuarios
                                    </a>
                                    @endcan

                                    @can('profesores.index')
                                    <a class="dropdown-item " href="{{ route('profesores.index')}}">
                                        Profesores
                                    </a>
                                    @endcan

                                    @can('aulas.index')
                                    <a class="dropdown-item " href="{{ route('aulas.index')}}">
                                        Aulas
                                    </a>
                                    @endcan

                                    @can('cursos.index')
                                    <a class="dropdown-item " href="{{ route('cursos.index')}}">
                                        Cursos
                                    </a>
                                    @endcan

                                    <a class="dropdown-item " href="{{ route('proyectos.index')}}">
                                        Proyectos
                                    </a>

                                    @can('ciclo.index')
                                    <a class="dropdown-item " href="{{ route('ciclo.index')}}">
                                        Ciclos
                                    </a>
                                    @endcan

                                    @can('carrera.index')
                                    <a class="dropdown-item " href="{{ route('carrera.index')}}">
                                        Carrera
                                    </a>
                                    @endcan

                                    @can('areaacademica.index')
                                    <a class="dropdown-item " href="{{ route('areaacademica.index')}}">
                                        Area academica
                                    </a>
                                    @endcan

                                </div>
                            </li>


                            <li>
                                <a class="nav-link" href="{{ route('horario2.index')}}">
                                    Horario reporte
                                </a>
                            </li>

                            @can('reportes.index')
                            <li>
                                <a class="nav-link" href="{{ route('reportes.index')}}">
                                    Reportes
                                </a>
                            </li>
                            @endcan
                            @can('backups.index')
                            <li>
                                <a class="nav-link" href="{{ route('backups.index')}}">
                                    Backups
                                </a>
                            </li>
                            @endcan
                            @can('bitacora.index')
                            <li>
                                <a class="nav-link" href="{{ route('bitacora.index')}}">
                                    Bitacora
                                </a>
                            </li>
                            @endcan

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Asignacion De Cursos</a>
                                <div class="dropdown-menu">
                                    @can('asignacioncursos.index')
                                    <a class="dropdown-item" href="{{ route('asignacioncursos.index')}}">
                                        Programacion de Cursos
                                    </a>
                                    @endcan
    
                                    <a class="dropdown-item" href="{{ route('horario.index')}}">
                                       Programacion de Horario
                                    </a>
                   
                                </div>
                            </li>

                        </ul>
                        @endauth
                    </div>
                    @endif
                    {{-- Si no esta logiado entoces pone esta parte  --}}
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <!--    <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                        </li>
                        @endif -->
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->nombre }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <!--<a class="dropdown-item" href="{{ route('home.ayuda') }}">Ayuda</a>-->
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </div>
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</body>

</html>
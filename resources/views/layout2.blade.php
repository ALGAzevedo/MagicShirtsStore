<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>MagicShirts Store</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/public/assets/favicon.ico"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/styles.css" rel="stylesheet"/>

</head>
<body>

<div class="utility-nav d-none d-md-block">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <p class="small">Estampagem de t-shirts Online
                </p>
            </div>

            <div class="col-12 col-md-6 text-right">
                <a href="#"><i class="fas fa-user mr-1"></i> Iniciar sessão</a>
                </li>
            </div>
        </div>
    </div>
</div>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-brand">
            <img class="logo-img .img-responsive .img-fluid" src="{{asset('storage/logo.png')}}" alt="Logo">
            <a class="navbar-brand" href="{{url('/')}}"> Magic Shirt Store</a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link {{Route::currentRouteName() == 'home' ? 'active' : ''}}"
                       href="{{route('home')}}">
                        Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item"><a class="nav-link {{Route::currentRouteName() == 'about' ? 'active' : ''}}"
                                        href="{{route('about')}}">About</a>
                </li>
                <li class="nav-item"><a
                        class="nav-link {{Route::currentRouteName() == 'estampas.index' ? 'active' : ''}}"
                        href="{{route('estampas.index')}}">Catálogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::currentRouteName() == 'administracao' ? 'active' : ''}}"
                       href="{{route('administracao')}}">
                        Administração
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mx-2"
                       title="Carrinho"
                       href="{{route('cart')}}">
                        <i class="fas fa-shopping-bag" aria-hidden="true"></i> <span
                            class="badge badge-pill badge-danger ml-1">3</span>
                    </a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                            <img class="img-profile rounded-circle"
                                 src="{{Auth::user()->foto_url ? asset('storage/fotos/' . Auth::user()->foto_url) : asset('img/default_img.png') }}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Perfil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>

        </div>


    </div>
</nav>
<div class="container-fluid text-center">
    <!-- Page Content-->
    @if (session('alert-msg'))
        @include('partials.message')
    @endif
    @if ($errors->any())
        @include('partials.errors-message')
    @endif

    @yield('content')
</div>

<!-- Footer-->
<footer id="footer" class="py-5 bg-dark mt-auto">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
    </div>
</footer>

<!-- Bootstrap core JS-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>

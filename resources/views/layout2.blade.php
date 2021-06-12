<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title> @isset($pageTitle){{$pageTitle}} | @endisset MagicShirts Store</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}"/>
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon-16x16.png')}}">
    <!-- Font Awesome -->
    <link href="{{asset('fonts/fontawesome/all.css')}}" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet"/>

</head>
<body>
<noscript>
    <div class="alert alert-warning border-0 text-center">
        <p><i class="fa fa-exclamation-triangle mr-2 "></i>Para o bom funcionamento da loja, é preciso que o JavaScript esteja ativado no navegador.</p>
    </div>
</noscript>

<header class="section-header">
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-12 text-center text-lg-left">
                    <a href="{{url('/')}}" class="brand-wrap">
                        <img class="logo img-fluid" alt="" src="{{asset('img/logo-tshirt.png')}}">
                    </a>
                </div>
                {{-- TODO: IMPLEMENTAR PESQUISA DE ESTAMPAS--}}
                <div class="col-lg-6 col-sm-6 my-3 my-lg-0">
                    <form action="{{route('estampas.index')}}" method="GET">
                        <div class="input-group w-100">
                            <input type="text" name="s" value="{{old('s')}}" class="form-control"
                                   placeholder="Pesquisar estampas...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> <!-- /col. -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="auth-wrap flex-wrap flex-md-nowrap d-flex justify-content-between">
                        @guest
                            <div class="auth-header-item auth-flex ">
                                <a href="#" class="user-avatar"> <img class="img-fluid"
                                                                      src="{{asset('img/default_user.jpg')}}" alt="">
                                </a>
                                <div class="auth-info">
                                    <h6 class="user-name">A minha conta</h6>
                                    <div>
                                        <a href="{{ route('login') }}">Iniciar Sessão</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="auth-header-item auth-flex ">
                                <a href="#" class="user-avatar"> <img class="img-fluid"
                                                                      src="{{Auth::user()->foto_url ? asset('storage/fotos/' . Auth::user()->foto_url) : asset('img/default_user.jpg') }}"
                                                                      alt=""> </a>
                                <div class="auth-info">
                                    <h6 class="user-name"><span>Olá, {{Auth::user()->name}}</span></h6>
                                    <div>
                                        <div class=" dropdown">
                                            <a class="dropdown-toggle" href="#" data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">A minha conta</a>
                                            <div class="dropdown-menu">
                                                @can('viewProfile', App\Models\Cliente::class)
                                                <a class="dropdown-item" href="{{ route('cliente.encomendas') }}">Encomendas</a>
                                                    <a class="dropdown-item"
                                                       href="{{route('cliente.edit', ['cliente'=> Auth::user()->id])}}">Perfil
                                                    </a>
                                                <a class="dropdown-item" href="{{ route('cliente.estampas') }}">Estampas</a>
                                                    <div class="dropdown-divider"></div>
                                                @endcan

                                                <a class="dropdown-item" href="{{ route('logout') }}"  data-toggle="modal" data-target="#logoutModal">Terminar Sessão</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endguest

                        <div class="auth-header-item">
                            <a class="header-cart nav-link mx-2"
                               title="Carrinho"
                               href="{{route('carrinho')}}">
                                <i class="fas fa-shopping-bag"
                                   aria-hidden="true"></i> @if(session()->has('carrinho_qty') && session('carrinho_qty')>0)
                                    <span
                                        class="badge badge-pill badge-danger ml-1">{{session('carrinho_qty')}}</span>@endif
                            </a>
                        </div>

                    </div> <!-- /auth-wrap -->
                </div> <!-- /col -->
            </div> <!-- /row -->
        </div> <!-- /container -->
    </section> <!-- /header-main -->
</header>
<nav class="navbar navbar-main navbar-expand-lg navbar-light border-bottom bg-light wrapper-menu-bar">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/')}}">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('estampas.index')}}">Catálogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('about')}}">Quem Somos</a>
                </li>
                @can('access-administration')
                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteName() == 'administracao.dashboard' ? 'active' : ''}}"
                           href="{{route('admin.dashboard')}}">
                            Administração
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link mx-2"
                       title="Carrinho"
                       href="{{route('carrinho')}}">
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
                            @can('viewProfile', App\Models\Cliente::class)
                                <a class="dropdown-item"
                                   href="{{route('cliente.edit', ['cliente'=> Auth::user()->id])}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                            @endcan
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div> <!-- collapse .// -->
    </div> <!-- container .// -->
</nav>

@yield('content')



<!-- Footer-->
<footer id="footer" class="mt-auto">

    <section class="payment-footer mt-5  py-4">
        <div class="container">
            <div class="row mx-auto justify-content-center text-center">
                <div class="col-md-3"><img src="{{asset('assets/paypal.svg')}}" class="img-fluid"></div>
                <div class="col-md-3"><img src="{{asset('assets/visa.svg')}}" class="img-fluid"></div>
                <div class="col-md-3"><img src="{{asset('assets/mastercard.svg')}}" class="img-fluid"></div>
            </div>
        </div> <!-- container //  -->
    </section>

    <div class="container-fluid py-3 bg-dark ">
        <p class="m-0 text-center small text-white">Copyright &copy; MagicShirtsStore {{date('Y')}}</p>
    </div>
</footer>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{route('logout')}}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JS-->
<script src="{{asset('js/jquery-3.5.1.slim.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.lazy.min.js')}}"></script>
<!-- Core theme JS-->
<script src="{{asset('js/scripts.js')}}"></script>
</body>
</html>

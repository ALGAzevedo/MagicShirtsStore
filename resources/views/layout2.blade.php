<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title> @isset($pageTitle){{$pageTitle}} | @endisset MagicShirts Store</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/public/assets/favicon.ico"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/styles.css" rel="stylesheet"/>

</head>
<body class="pb-5">
<header class="section-header">
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-4">
                    <a href="{{url('/')}}" class="brand-wrap">
                        <img class="logo" alt="" src="{{asset('img/logo-tshirt.png')}}">
                    </a>
                </div>
                {{-- TODO: IMPLEMENTAR PESQUISA DE ESTAMPAS--}}
                <div class="col-lg-6 col-sm-12">
                    <form action="{{route('estampas.index')}}" method="GET">
                        <div class="input-group w-100">
                            <input type="text" name="s" value="{{old('s')}}" class="form-control" placeholder="Pesquisar estampas...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> <!-- /col. -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="auth-wrap float-md-right">
                        @guest
                        <div class="auth-header-item auth-flex ">
                            <a href="#" class="user-avatar"> <img class="img-fluid" src="{{asset('img/default_user.jpg')}}" alt=""> </a>
                            <div class="auth-info">
                                <h6 class="user-name">A minha conta</h6>
                                <div>
                                    <a href="{{ route('login') }}">Iniciar Sessão</a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="auth-header-item auth-flex ">
                            <a href="#" class="user-avatar"> <img class="img-fluid" src="{{Auth::user()->foto_url ? asset('storage/fotos/' . Auth::user()->foto_url) : asset('img/default_user.jpg') }}" alt=""> </a>
                            <div class="auth-info">
                                <h6 class="user-name">Olá,{{Auth::user()->name}}</h6>
                                <div>
                                    <div class=" dropdown">
                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">A minha conta</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Encomendas</a>
                                            <a class="dropdown-item" href="#">Perfil</a>
                                            <a class="dropdown-item" href="#">Estampas</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Terminar Sessão</a>
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
                                <i class="fas fa-shopping-bag" aria-hidden="true"></i> @if(session()->has('carrinho_qty') && session('carrinho_qty')>0) <span class="badge badge-pill badge-danger ml-1">{{session('carrinho_qty')}}</span>@endif
                            </a>
                        </div>

                    </div> <!-- /auth-wrap -->
                </div> <!-- /col -->
            </div> <!-- /row -->
        </div> <!-- /container -->
    </section> <!-- /header-main -->
</header>
<nav class="navbar navbar-main navbar-expand-lg navbar-light border-bottom bg-light">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('estampas.index')}}">Catálogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>
        </div> <!-- collapse .// -->
    </div> <!-- container .// -->
</nav>
@yield('content')
<!-- Footer-->
<footer id="footer"class="py-3 bg-dark mt-auto">
    <div class="container">
        <p class="m-0 text-center small text-white">Copyright &copy; MagicShirtsStore {{date('Y')}}</p>
    </div>
</footer>

<!-- Bootstrap core JS-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="/js/scripts.js"></script>
</body>
</html>

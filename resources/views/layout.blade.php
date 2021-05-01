<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="/css/estilos.css">

    <title>Magic Shirt Store</title>
</head>

<body>
    <header>
        <div id="logo">
            <img src="/img/logo.png" alt="Logo">
        </div>
        <h1>Magic Shirt Store</h1>

        <div class="avatar-area">
            <span class="name-user">Maria Costa</span>
            <img src="/img/default_img.png" alt="User img">
        </div>

        <div class="cart">
            <a href="#">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </div>

        <div id="menuIcon">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </header>
    <div class="container">
        <nav>
            <ul>
                <li class="{{Route::currentRouteName() == 'home' ? 'sel' : ''}}">
                    <i class="fas fa-info-circle"></i>
                    <a href="{{route('home')}}">About</a>
                </li>
                <li class="{{Route::currentRouteName() == 'estampas.index' ? 'sel' : ''}}">
                    <i class="fas fa-box"></i>
                    <a href="{{route('estampas.index')}}">Estampas</a>
                </li>
                <li class="{{Route::currentRouteName() == 'disciplinas.index' ? 'sel' : ''}}">
                    <i class="far fa-file"></i>
                    <a href="{{route('disciplinas.index')}}">Disciplinas</a>
                </li>
                <li class="{{Route::currentRouteName() == 'docentes.index' ? 'sel' : ''}}">
                    <i class="fas fa-users"></i>
                    <a href="{{route('docentes.index')}}">Docentes</a>
                </li>
                <li class="{{Route::currentRouteName()== 'candidaturas.index' ? 'sel' : ''}}">
                    <i class="fab fa-wpforms"></i>
                    <a href="{{route('candidaturas.index')}}">Candidatura</a>
                </li>
            </ul>
        </nav>


        <section id="main">
            <div class="content">
                <div class="left-content">
                    @if (session('alert-msg'))
                        <div class="alert alert-{{ session('alert-type') }}">
                            <span class="closebtn"
                                onclick="this.parentElement.style.display='none';">&times;</span>
                            <span>{{ session('alert-msg') }}</span>
                        </div>
                    @endif
                    @yield('content')
                </div>
                <aside>
                    <h3>Disciplinas</h3>
                    <div class="disc-area">
                        <div class="disc">
                            <div class="disc-name">Programação I</div>
                            <div class="del-disc"><i class="far fa-trash-alt"></i></div>
                        </div>
                        <div class="disc">
                            <div class="disc-name">Análise Matemática</div>
                            <div class="del-disc"><i class="far fa-trash-alt"></i></div>
                        </div>
                        <div class="disc">
                            <div class="disc-name">Fisica Aplicada</div>
                            <div class="del-disc"><i class="far fa-trash-alt"></i></div>
                        </div>
                        <div class="disc">
                            <div class="disc-name">Álgebra Linear</div>
                            <div class="del-disc"><i class="far fa-trash-alt"></i></div>
                        </div>
                    </div>
                    <div class="bt-area">
                        <button type="button" class="bt">Inscrever</button>
                        <button type="button" class="bt">Limpar</button>
                    </div>
                </aside>
            </div>
            <footer>
                <p>
                    © <a href="mailto:	coord.dei.estg@ipleiria.pt"> Departamento de Engenharia Informática</a>
                </p>
            </footer>

        </section>
    </div>
    <script src="js/menu.js"></script>
</body>

</html>

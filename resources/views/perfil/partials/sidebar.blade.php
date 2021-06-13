<aside class="col-md-3">
    <!--   SIDEBAR   -->
    <div class="list-group mb-3 mb-lg-0">
        <a class="list-group-item list-group-item-action {{ request()->is('cliente/encomenda*') ? 'active' : '' }}" href="{{ route('cliente.encomendas') }}"> <i class="fas fa-shopping-bag pr-3"></i>Encomendas </a>
        <a class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'cliente.edit' ? 'active' : '' }}" href="{{route('cliente.edit', ['cliente'=> Auth::user()->id])}}"> <i class="fas fa-user pr-3"></i>Dados de cliente</a>
        <a class="list-group-item list-group-item-action {{ request()->is('cliente/es*') ? 'active' : '' }}" href="{{ route('cliente.estampas') }}"> <i class="far fa-tshirt pr-3"></i>Minhas Estampas </a>
        <a class="list-group-item list-group-item-action list-group-item-danger"  href="{{ route('logout') }}"  data-toggle="modal" data-target="#logoutModal"> <i class="far fa-sign-out pr-3"></i> Sair</a>
    </div>
    <!--   /SIDEBAR .//END   -->
</aside>

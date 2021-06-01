<aside class="col-md-3">
    <div class="card">
        <header class="card-header">
            <h6>Estampas por categorias</h6>
        </header>
        <div class="card-body pt-0">
            <ul class="list-menu">
                @foreach ($listaCategorias as $cat)
                    <li><a href="{{route('estampas.index').'?categoria='.$cat->id}}"
                           class="{{ $categoria->id == $cat->id ? 'link-active' : ''}}">{{$cat->nome}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div> <!-- card.// -->
</aside> <!-- col.// -->

<aside class="col-md-3">
    <div class="card mb-3 mb-md-0">
        <header class="card-header">
            <a href="#" data-toggle="collapse" data-target="#categories" aria-expanded="false" class="collapsed-sm d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Estampas por categorias</h6>
                <i class="icon-control fa fa-chevron-down"></i>
            </a>
        </header>
        <div class="filter-content collapse show" id="categories">
        <div class="card-body pt-0">
            <ul class="list-menu">
                <li><a href="{{route('estampas.index').'?categoria=sc'}}"
                       class="{{ $categoria->id == 'sc' ? 'link-active' : ''}}">Sem categoria</a>
                </li>
                @foreach ($listaCategorias as $cat)
                    <li><a href="{{route('estampas.index').'?categoria='.$cat->id}}"
                           class="{{ $categoria->id == $cat->id ? 'link-active' : ''}}">{{$cat->nome}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    </div>
</aside>

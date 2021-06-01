@extends('layout2')

@section('content')
    <div class="container">
        <section class="mt-4 mb-4">
            <div class="page-title-wrapper mb-4">
                <h1>Resultado de pesquisa para "{{old('s')}}"</h1>
            </div>
        </section>
        <div class="row">
            <div class="col-md-12">
                <header class="mb-3">
                    <form action="{{route('estampas.index')}}" method="GET">
                        <div class="input-group w-100">
                            <select class="custom-select col-3"  name="categoria" onchange="this.form.submit()">
                                <option value="" >Todas as Categoria</option>
                                @foreach ($listaCategorias as $cat)
                                    <option value="{{$cat->id}}" {{ $categoria == $cat->id ? 'selected' : ''}}>
                                        {{$cat->nome}}
                                    </option>
                                @endforeach
                            </select>

                            <input type="text" name="s" class="form-control" placeholder="Pesquisar estampas por nome ou descrição...">

                            <div class="input-group-append">
                                <button class="btn btn-light" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </header><!-- sect-heading -->

                @include('estampas.partials.list')

            </div> <!-- col.// -->

        </div>

    </div>



@endsection

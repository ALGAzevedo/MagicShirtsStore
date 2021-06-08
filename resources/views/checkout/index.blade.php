@extends('layout2')

@section('content')
    <div class="container">
        @can('create',App\Models\Cliente::class)
        <section class="mt-4 mb-4">
            <div class="page-title-wrapper mb-4">
                <h1>Checkout</h1>
            </div>
        </section>


        <form action="{{ route('checkout.order') }}" method="POST" role="form">
        <div class="row">

            <!--Grid column-->
            <div class="col-lg-7">
                @if (session('alert-msg'))
                    @include('partials.message')
                @endif
                @if ($errors->any())
                    @include('partials.errors')
                @endif
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Dados de Cliente</h5>

                            @csrf
                            @method('POST')
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label>Nome</label>
                                    <input type="text" placeholder="Nome" name="name" readonly
                                           value="{{$cliente->user->name}}" class="form-control">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>NIF <small>(opcional)</small></label>
                                    <input type="text" placeholder="NIF" name="nif" value="{{old('nif', $cliente->nif)}}"
                                           class="form-control">
                                    @error('nif')
                                    <div class="invalid-feedback d-block">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label>Endereço</label>
                                    <input type="text" name="endereco"
                                           value="{{old('endereco', $cliente->endereco)}}"
                                           placeholder="Rua e número de casa/apartamento" class="form-control">
                                    @error('endereco')
                                    <div class="invalid-feedback d-block">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="inputPagamento">Tipo Pagamento</label>
                                    <select name="tipo_pagamento" id="inputPagamento" class="custom-select"
                                            value="{{ old('tipo_pagamento', $cliente->tipo_pagamento)}}">
                                        <option value=""{{old('tipo_pagamento', $cliente->tipo_pagamento) == "" ? 'selected' : ""}}>Não inserir</option>
                                        <option value="MC" {{old('tipo_pagamento', $cliente->tipo_pagamento) == "MC" ? 'selected' : ""}}>MC</option>
                                        <option value="PAYPAL" {{old('tipo_pagamento', $cliente->tipo_pagamento) == "PAYPAL" ? 'selected' : ""}}>PAYPAL</option>
                                        <option value="VISA" {{old('tipo_pagamento', $cliente->tipo_pagamento) == "VISA" ? 'selected' : ""}}>VISA</option>
                                    </select>
                                    @error('tipo_pagamento')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="inputReferencia">Referência de pagamento</label>
                                    <input type="text" class="form-control" name="ref_pagamento" id="inputReferencia"
                                           value="{{old('ref_pagamento', $cliente->ref_pagamento)}}">
                                    @error('ref_pagamento')
                                    <div class="invalid-feedback d-block">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Notas da encomenda (opcional)</label>
                                    <textarea class="form-control" rows="2" name="notas"
                                              placeholder="Notas sobre a sua encomenda">{{old('notas')}}</textarea>
                                    <small class="text-muted">Utilize este campo para "Observações" (por exemplo,
                                        informações pertinentes sobre a encomenda).</small>
                                </div>
                            </div>

                    </div> <!-- card-body.// -->
                </div> <!-- /Card -->


            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-5">

                <!-- Card -->
                <div class="card mb-4">
                    <div class="card-body pb-0">

                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="">A sua encomenda</h5>
                            <a href="{{route('carrinho')}}" class="btn btn-light text-primary btn-sm"> <i class="fas fa-shopping-bag" aria-hidden="true"></i> carrinho </a>
                        </div>

                        <ul class="list-group list-group-flush ">
                            @foreach ($carrinho as $key=>$row)

                            <li class="list-group-item d-flex checkout-item justify-content-between align-items-center px-0 ">
                                <div class="checkout-thumb">
                                    <div class="shirt_thumb border image">
                                        <img
                                            class="cart-item_product__thumbnail img-{{$key}}"
                                            src="{{asset('storage/tshirt_base/' .$row['cor_codigo'] . '.jpg')}}"
                                            alt="">
                                        <div class="shirt_thumb-overlay">
                                            <img class="shirt_thumb-overlay-img" src="{{static_asset($row['categoria_id'],$row['imagem_url'])}}"
                                                 alt="{{$row['nome']}}"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="data px-3 flex-fill">
                                    <p class="name">{{ $row['nome'] }} </p>
                                    <p class="small text-muted">Cor: {{ $row['cor_codigo'] }} </p>
                                    <p class="small text-muted">Tamanho: {{ $row['tamanho'] }} </p>
                                </div>
                                <p class="text-right d-flex flex-column"><span>&times;{{ $row['quantidade'] }}</span> <br> <strong>{{ $row['subtotal'] }}€</strong></p>

                            </li>
                            @endforeach

                        </ul>

                    </div>
                    <hr>
                    <div class="card-body pt-0">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 p-0 ">
                                Subtotal:
                                <span>{{session('carrinho_subtotal')}}€</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0  p-0 text-muted">
                                Entrega
                                <span>Gratis</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 mb-3">
                                <div>
                                    <strong>Valor total </strong>
                                </div>
                                <span><strong>{{session('carrinho_subtotal')}}€</strong></span>
                            </li>
                        </ul>

                        <button type="submit" class="btn btn-lg  btn-primary btn-block">
                            Confirmar <i
                                class="far fa-check ml-2"></i>
                        </button>


                    </div>

                </div>
                <!-- Card -->

            </div>
            <!--Grid column-->

        </div>
        </form>
        @else
            <div class="row">
                <div class="col-lg-12 mt-4">

                    <div class="alert alert-warning">
                        O tipo de utilizador não é compatível com esta operação. <a href="{{route('carrinho')}}">Carrinho de compras.</a>

                    </div>

                </div>
            </div>
        @endcan
    </div>



@endsection

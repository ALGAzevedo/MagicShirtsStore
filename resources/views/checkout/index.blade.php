@extends('layout2')

@section('content')
    <div class="container">
        <section class="mt-4 mb-4">
            <div class="page-title-wrapper mb-4">
                <h1>Checkout</h1>
            </div>
        </section>
        <div class="row">

            <!--Grid column-->
            <div class="col-lg-7">


                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Informação de Faturação</h5>
                        <form action="">

                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label>Nome</label>
                                    <input type="text" placeholder="Nome" class="form-control">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>NIF <small>(opcional)</small></label>
                                    <input type="text" placeholder="NIF" class="form-control">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label>Endereço</label>
                                    <input type="text" name="endereco" placeholder="Rua e número de casa/apartamento" class="form-control">
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label>Métodos de pagamento</label>
                                    <div class="mt-2">

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="payment-visa" name="payment-type" value="VISA" class="custom-control-input">
                                            <label class="custom-control-label" for="payment-visa">VISA</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="payment-mc" name="payment-type" value="MC" class="custom-control-input">
                                            <label class="custom-control-label" for="payment-mc">MC</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="payment-paypal" name="payment-type" value="PAYPAL" class="custom-control-input">
                                            <label class="custom-control-label" for="payment-paypal">PAYPAL</label>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Notas da encomenda (opcional)</label>
                                    <textarea class="form-control" rows="2" placeholder="Notas sobre a sua encomenda"></textarea>
                                    <small class="text-muted">Utilize este campo para "Observações" (por exemplo, informações pertinentes sobre a encomenda).</small>
                                </div>
                            </div>

                        </form>
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
                            <a href="#" class="btn btn-light text-primary btn-sm"> Voltar ao carrinho </a>
                        </div>

                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item d-flex checkout-item justify-content-between align-items-center px-0 ">
                                <div class="image p-1 border">
                                    <img class="img-xs" src="./img/4bd7ef.jpg" alt="">
                                </div>
                                <div class="data px-3 flex-fill">
                                    <p class="name">Logitec headset for gaming </p>
                                    <p class="small text-muted">Cor: Azul noite &amp; Branco </p>
                                    <p class="small text-muted">Tamanho: L </p>
                                </div>
                                <p class="text-right d-flex flex-column"><span>x5</span> <br> <strong>4,30€</strong> </p>

                            </li>
                            <li class="list-group-item d-flex checkout-item justify-content-between align-items-center px-0 ">
                                <div class="image p-1 border">
                                    <img class="img-xs" src="./img/fd4083.jpg" alt="">
                                </div>
                                <div class="data px-3 flex-fill">
                                    <p class="name">Logitec headset for gaming </p>
                                    <p class="small text-muted">Cor: Azul noite &amp; Branco </p>
                                    <p class="small text-muted">Tamanho: L </p>
                                </div>
                                <p class="text-right d-flex flex-column"><span>x5</span> <br> <strong>4,30€</strong> </p>

                            </li>
                            <li class="list-group-item d-flex checkout-item justify-content-between align-items-center px-0">
                                <div class="image p-1 border">
                                    <img class="img-xs" src="./img/00a2f2.jpg" alt="">
                                </div>
                                <div class="data px-3 flex-fill">
                                    <p class="name">Logitec headset for gaming </p>
                                    <p class="small text-muted">Cor: Azul noite &amp; Branco </p>
                                    <p class="small text-muted">Tamanho: L </p>
                                </div>
                                <p class="text-right d-flex flex-column"><span>x5</span> <br> <strong>4,30€</strong> </p>

                            </li>
                        </ul>

                    </div>
                    <hr>
                    <div class="card-body pt-0">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Subtotal:
                                <span>59,95€</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 pb-0 px-0 text-muted">
                                Entrega
                                <span>Gratis</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold px-0 text-warning">
                                Descontos
                                <span>-12,59€</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Valor total	</strong>
                                </div>
                                <span><strong>59,95€</strong></span>
                            </li>
                        </ul>

                        <button type="button" class="btn btn-lxg text-uppercase btn-primary btn-block">Finalizar Encomenda</button>


                    </div>
                </div>
                <!-- Card -->

            </div>
            <!--Grid column-->

        </div>

    </div>



@endsection

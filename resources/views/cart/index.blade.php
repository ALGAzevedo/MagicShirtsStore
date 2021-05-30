@extends('layout2')

@section('content')
<div class="container">

      <!--Section: Block Content-->
      <section class="mt-5 mb-4">

        <!--Grid row-->
        <div class="row">

          <!--Grid column-->
          <div class="col-lg-8">

            <!-- Card -->
            <div class="card wish-list mb-4">
              <div class="card-body">

                <h5 class="mb-4">Meu carrinho <small>(<span>x</span> artigos)</small> </h5>

                <div class="row mb-2">
                  <div class="col-md-5 col-lg-2 col-xl-2">
                    <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                      <a href="#!">
                          <img class="img-fluid w-100" alt="" src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12a.jpg">
                      </a>
                    </div>
                  </div>
                  <div class="col-md-7 col-lg-10 col-xl-10">
                    <div>
                      <div class="d-flex justify-content-between">
                        <div>
                          <h5>Blue denim shirt</h5>
                          <p class="mb-1 text-muted text-uppercase small">Cor: blue</p>
                          <p class="mb-2 text-muted text-uppercase small">Tamanho: M</p>
                        </div>
                        <div>
                          <div class="def-number-input number-input safari_only mb-0 w-100">
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"><i class="far fa-minus"></i></button>
                            <input class="quantity" min="0" name="quantity" value="1" type="number">
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"><i class="far fa-plus"></i></button>
                          </div>
                          <small class="form-text text-muted text-center text-uppercase mt-2">
                            PREÇO UNIT. <strong>59,95€</strong>
                          </small>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <a href="#!" type="button" class="card-link-danger small text-uppercase"><i class="fas fa-trash-alt mr-1"></i> Eliminar </a>
                        </div>
                        <p class="mb-0"><span><strong>17.99 €</strong></span></p>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="mb-4">
              

              </div>
            </div>
            <!-- Card -->

            <!-- Card -->
            <div class="card mb-4">
              <div class="card-body d-flex justify-content-between align-items-center">
              <button type="button" class="btn btn-outline-dark "><i class="fas fa-arrow-left mr-1"></i> Continuar a comprar</button>
              <button type="button" class="btn btn-secondary "><i class="fas fa-sync mr-1"></i> Atualizar carrinho</button>

              </div>
            
            </div>
            <!-- Card -->



          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-4">

            <!-- Card -->
            <div class="card mb-4">
              <div class="card-body">

                <h5 class="mb-3">Resumo do pedido</h5>

                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                  Subtotal:	
                    <span>59,95€</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0 text-muted">
                  Entrega
                    <span>Gratis</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                    <div>
                      <strong>Valor a pagar	</strong>
                    </div>
                    <span><strong>59,95€</strong></span>
                  </li>
                </ul>

                <button type="button" class="btn btn-lg btn-primary btn-block">Finalizar compra</button>
               

              </div>
            </div>
            <!-- Card -->

          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

      </section>
      <!--Section: Block Content-->

    </div>
@endsection

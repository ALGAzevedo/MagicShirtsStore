@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" placeholder="johndoe@mail.com">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nif" class="col-md-4 col-form-label text-md-right">{{ __('NIF') }}</label>

                                <div class="col-md-6">
                                    <input id="nif" type="text"
                                           class="form-control @error('nif') is-invalid @enderror" name="nif"
                                           value="{{ old('nif') }}" autocomplete="nif" autofocus placeholder="123456789">

                                    @error('nif')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="endereco"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Endereço') }}</label>

                                <div class="col-md-6">
                                    <input id="endereco" type="text"
                                           class="form-control @error('endereco') is-invalid @enderror" name="endereco"
                                           value="{{ old('endereco') }}" autocomplete="endereco" autofocus placeholder="Never Land Street 15">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tipo_pagamento"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Pagamento') }}</label>
                                <div class="col-md-6">
                                    <select id="inputPagamento"
                                            class="form-control @error('tipo_pagamento') is-invalid @enderror"
                                            name="tipo_pagamento"
                                            value="{{ old('tipo_pagamento') }}" autocomplete="tipo_pagamento"
                                            autofocus>
                                        <option value="" selected>Não inserir</option>
                                        <option value="MC"{{ old('tipo_pagamento') == 'MC' ? 'selected' : '' }}>MC</option>
                                        <option value="PAYPAL" {{ old('tipo_pagamento') == 'PAYPAL' ? 'selected' : '' }}>PAYPAL</option>
                                        <option value="VISA" {{ old('tipo_pagamento') == 'VISA' ? 'selected' : '' }}>VISA</option>
                                    </select>
                                    @error('tipo_pagamento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ref_pagamento"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Referência de Pagamento') }}</label>

                                <div class="col-md-6">
                                    <input id="ref_pagamento" type="text"
                                           class="form-control @error('ref_pagamento') is-invalid @enderror"
                                           name="ref_pagamento"
                                           value="{{ old('ref_pagamento') }}" autocomplete="ref_pagamento">

                                    @error('ref_pagamento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="tipo" type="hidden" value="C"
                                           class="form-control @error('tipo') is-invalid @enderror" name="tipo">
                                    @error('tipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="bloqueado" type="hidden" value="0"
                                           class="form-control @error('bloqueado') is-invalid @enderror"
                                           name="bloqueado">
                                    @error('bloqueado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

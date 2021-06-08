<div class="form-row">
<div class="col-md-6 mb-3">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="name" id="inputNome" value="{{old('name', $cliente->user->name)}}">
    @error('name')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="col-md-6 mb-3">
    <label for="inputEmail">Email</label>
    <input type="email" class="form-control" name="email" id="inputEmail"
           value="{{old('email', $cliente->user->email)}}">
    @error('email')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
</div>
<div class="form-group">
    <label for="inputNif">NIF</label>
    <input type="text" class="form-control" name="nif" id="inputNif" value="{{old('nif', $cliente->nif)}}">
    @error('nif')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputEndereco">Endereço</label>
    <input type="text" class="form-control" name="endereco" id="inputEndereco"
           value="{{old('endereco', $cliente->endereco)}}">
    @error('endereco')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-row">
    <div class="col-md-6 mb-3">
    <label for="inputPagamento">Tipo Pagamento</label>
    <select name="tipo_pagamento" id="inputPagamento" class="custom-select"
            value="{{ old('tipo_pagamento', $cliente->tipo_pagamento)}}">
        <option value=""{{old('tipo_pagamento',  $cliente->tipo_pagamento) == "" ? 'selected' : ""}}>Não inserir</option>
        <option value="MC" {{old('tipo_pagamento', $cliente->tipo_pagamento) == "MC" ? 'selected' : ""}}>MC</option>
        <option value="PAYPAL" {{old('tipo_pagamento',$cliente->tipo_pagamento) == "PAYPAL" ? 'selected' : ""}}>PAYPAL</option>
        <option value="VISA" {{old('tipo_pagamento',$cliente->tipo_pagamento) == "VISA" ? 'selected' : ""}}>VISA</option>
    </select>
    @error('tipo_pagamento')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6 mb-3">
    <label for="inputReferencia">Referência de pagamento</label>
    <input type="text" class="form-control" name="ref_pagamento" id="inputReferencia"
           value="{{old('ref_pagamento', $cliente->ref_pagamento)}}">
    @error('ref_pagamento')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
</div>

@can('updateBlock', $cliente)
    <div class="form-group">
        <div class="form-check form-check-inline">
            <input type="hidden" name="bloqueado" value="0">
            <input type="checkbox" class="form-check-input" id="inputBloqueado" name="bloqueado"
                   value="1" {{old('bloqueado', $cliente->user->bloqueado) == '1' ? 'checked' : ''}}>
            <label class="form-check-label" for="inputAdmin">
                Bloqueado
            </label>
        </div>
        @error('bloqueado')
        <div class="small text-danger">{{$message}}</div>
        @enderror
    </div>
@endcan

<div class="form-group">
    <label for="inputFoto">Upload da foto</label>
    <input type="file" class="form-control-file" name="foto" id="inputFoto">
    @error('foto')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group mb-0">
    <div class="form-check form-check-inline">
        <input type="hidden" name="tipo" value="C">
    </div>
    @error('tipo')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


@can('updatePassword', $cliente)
    <span class="h5">Alterar Password</span>
    <div class="form-group mt-2">
        <a href="{{route('cliente.password.update', ['cliente' => $cliente]) }}"
           class="btn btn-dark">Alterar Password</a>
    </div>
@endcan

<hr>

<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="name" id="inputNome" value="{{old('name', $cliente->user->name)}}">
    @error('name')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input type="email" class="form-control" name="email" id="inputEmail"
           value="{{old('email', $cliente->user->email)}}">
    @error('email')
    <div class="small text-danger">{{$message}}</div>
    @enderror
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
<div class="form-group">
    <label for="inputPagamento">Tipo Pagamento</label>
    <select name="tipo_pagamento" id="inputPagamento">
        <option value="MC" selected>MC</option>
        <option value="PAYPAL">PAYPAL</option>
        <option value="VISA">VISA</option>
    </select>
    @error('tipo_pagamento')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputReferencia">Referência de pagamento</label>
    <input type="text" class="form-control" name="ref_pagamento" id="inputReferencia"
           value="{{old('ref_pagamento', $cliente->ref_pagamento)}}">
    @error('ref_pagamento')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputPassword">Password</label>
    <input type="password" class="form-control" name="password" id="password"
           value="">
    @error('password')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

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
<div class="form-group">
    <div class="form-check form-check-inline">
        <input type="hidden" name="tipo" value="C">
    </div>
    @error('tipo')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputFoto">Upload da foto</label>
    <input type="file" class="form-control" name="foto" id="inputFoto">
    @error('foto')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


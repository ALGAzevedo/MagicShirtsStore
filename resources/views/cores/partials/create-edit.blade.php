<div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="inputNome">Nome</label>
        <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $cor->nome)}}">
        @error('nome')
        <div class="small text-danger">{{$message}}</div>
        @enderror
    </div>
    <div>
        <label for="inputColor">Cor</label>
        <input type="text" class="form-control" name="codigo" id="inputColor">
        @error('codigo')
        <div class="small text-danger">{{$message}}</div>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="inputNome">T-shirt</label>
        <input type="file" class="form-control" name="imgShirt" id="inputIMG">
        @error('imgShirt')
        <div class="small text-danger">{{$message}}</div>
        @enderror
    </div>
</div>


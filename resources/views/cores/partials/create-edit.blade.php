<div class="form-row">
    <div class="form-group col-md-6 col-lg-4">
        <label for="inputNome">Nome</label>
        <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $cor->nome)}}">
        @error('nome')
        <div class="small text-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group col-md-4 col-lg-2">
        <label for="inputColorx">Cor</label>
        <div id="inputColor" class="input-group">
            <input type="text" class="form-control text-lowercase" name="codigo" id="inputColorx" value="#{{old('codigo')}}">
            <span class="input-group-append">
                <span class="input-group-text colorpicker-input-addon"><i></i></span>
            </span>
        </div>

        @error('codigo')
        <div class="small text-danger">{{$message}}</div>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="inputNome">T-shirt</label>
        <input type="file" class="form-control-file" name="imgShirt" id="inputIMG">
        @error('imgShirt')
        <div class="small text-danger">{{$message}}</div>
        @enderror
    </div>
</div>


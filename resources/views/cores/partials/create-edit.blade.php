<div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="inputNome">Nome</label>
        <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $cor->nome)}}">
        @error('nome')
        <div class="small text-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="col-md-1 mb-3">
        <label for="inputColor">Cor Picker</label>
        <input type="color" class="form-control" name="codigo_picker" id="inputColor"
               value="{{old('codigo', $cor->codigo)}}">
        @error('codigo_picker')
        <div class="small text-danger">{{$message}}</div>
        @enderror
    </div>

    <div>
        <label for="inputColor">Cor Text</label>
        <input type="text" class="form-control" name="codigo_text" id="inputColor"
               >
        @error('codigo_text')
        <div class="small text-danger">{{$message}}</div>
        @enderror
    </div>

</div>

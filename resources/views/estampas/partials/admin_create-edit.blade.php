

<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $estampa->nome)}}" />
    @error('nome')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputCurso">Categoria</label>
    <select class="custom-select" name="categoria_id" id="inputCategoria">
        <option value="" {{old('categoria_id', $estampa->categoria_id) == NULL ? 'selected' : ''}}>Sem categoria</option>
        @foreach ($listaCat as $cat)
            <option value="{{$cat->id}}" {{ old('categoria_id', $estampa->categoria_id) == $cat->id ? 'selected' : ''}}>{{$cat->nome}}</option>
        @endforeach
    </select>
    @error('categoria_id')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

<div class="form-group">
    <label for="inputDescricao">Descricao</label>
    <textarea class="form-control" name="descricao" id="inputDescricao">{{old('descricao', $estampa->descricao)}}</textarea>
    @error('descricao')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>



<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="name" id="inputNome"
           @cannot('update',$funcionario) readonly @endcannot
           value="{{old('name', $funcionario->name)}}">
    @error('name')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input type="email" class="form-control" name="email" id="inputEmail"
           @cannot('update',$funcionario) readonly @endcannot
           value="{{old('email', $funcionario->email)}}">
    @error('email')
    <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
@can('updatePassword', $funcionario)
    <div class="form-group">
        <a href="{{route('admin.funcionarios.password.update', ['funcionario' => $funcionario]) }}"
           class="btn btn-dark">Alterar Password</a>
    </div>
@endcan
@can('update', $funcionario)
    <div class="form-group">
        <div>Tipo</div>
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="inputFuncionario" name="tipo"
                   value="F" {{old('tipo',  $funcionario->tipo) == 'F' ? 'checked' : ''}}>
            <label class="form-check-label" for="inputFuncionario"> Funcionário </label>
            <input type="radio" class="form-check-input ml-4" id="inputAdministrador" name="tipo"
                   value="A" {{old('tipo',  $funcionario->tipo) == 'A' ? 'checked' : ''}}>
            <label class="form-check-label" for="inputAdministrador"> Administrador </label>
        </div>
        @error('tipo')
        <div class="small text-danger">{{$message}}</div>
        @enderror
    </div>
    @can('updateBlock', $funcionario)
    <div class="form-group">
        <div class="form-check form-check-inline">
            <input type="hidden" name="bloqueado" value="0">
            <input type="checkbox" class="form-check-input" id="inputBloqueado" name="bloqueado"
                   value="1" {{old('bloqueado', $funcionario->bloqueado) == '1' ? 'checked' : ''}}>
            <label class="form-check-label" for="inputBloqueado">
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
@endcan


<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPost;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function admin_funcs()
    {

        $qry = User::query();
        $qry->where('tipo', 'F')
            ->orWhere('tipo', 'A')
            ->orderBy('name');

        //$funcionarios = User::pluck('name', 'email', 'tipo')->paginate(10);
        $funcs = $qry->paginate(10);
        return view('funcionarios.admin')
            ->withFuncs($funcs);
    }

    public function edit(User $funcionario)
    {
        return view('funcionarios.edit')
            ->withFuncionario($funcionario);
    }

    public function update(UserPost $request, User $funcionario)
    {

//        $funcionario->fill($request->validated());
//        $funcionario->save();
        $validated_data = $request->validated();
        $funcionario->email = $validated_data['email'];
        $funcionario->name = $validated_data['name'];
        $funcionario->tipo = $validated_data['tipo'];
        $funcionario->bloqueado = $validated_data['bloqueado'];
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos/' . $funcionario->foto_url);
            $path = $request->foto->store('public/fotos');
            $funcionario->foto_url = basename($path);
        }
        $funcionario->save();
        return redirect()->route('admin.funcionarios')
            ->with('alert-msg', 'Funcionario "' . $funcionario->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function create()
    {
        $newFuncionario = new User;
        return view('funcionarios.create')
            ->withFuncionario($newFuncionario);
    }

    public function store(UserPost $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->email = $validated_data['email'];
        $newUser->name = $validated_data['name'];
        $newUser->tipo = $validated_data['tipo'];
        $newUser->bloqueado = $validated_data['bloqueado'];
        $newUser->password = Hash::make($validated_data['password']);
        $newUser->save();

        return redirect()->route('admin.funcionarios')
            ->with('alert-msg', 'Funcionario "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy_foto(User $funcionario)
    {
        Storage::delete('public/fotos/' . $funcionario->foto_url);
        $funcionario->foto_url = null;
        $funcionario->save();
        return redirect()->route('admin.funcionarios.edit', ['funcionario' => $funcionario])
            ->with('alert-msg', 'Foto do docente "' . $funcionario->name .
                '" foi removida!')
            ->with('alert-type', 'success');
    }

}





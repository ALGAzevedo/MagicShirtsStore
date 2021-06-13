<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFuncUpdatePost;
use App\Http\Requests\UserPost;
use App\Http\Requests\UserUpdatePost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function admin_funcs(Request $request)
    {
        $qry = User::withoutTrashed();
        if ($request->filled('bloqueado')) {
            $qry->where('bloqueado', '=', $request->input('bloqueado'));
        }
        if ($request->filled('tipo')) {
            $qry->where('tipo', '=', $request->input('tipo'));
        }
        if ($request->filled('name')) {
            $qry->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if ($request->filled('email')) {
            $qry->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }
        $qry->where('tipo', '!=', 'C')
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

    public function update(UserUpdatePost $request, User $funcionario)
    {

        $validated_data = $request->validated();

        $funcionario->email = $validated_data['email'];
        $funcionario->name = $validated_data['name'];
        $funcionario->tipo = $validated_data['tipo'];
        $funcionario->bloqueado = $validated_data['bloqueado'];

        if ($request->filled('password')) {
            $funcionario->password = Hash::make($validated_data['password']);
        }
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

    public function viewPassword(User $funcionario)
    {

        return view('funcionarios.password')
            ->withFuncionario($funcionario);
    }

    public function updatePassword(UserFuncUpdatePost $request, User $funcionario)
    {

        $validated_data = $request->validated();

        if (Hash::check($validated_data['oldPassword'], $funcionario->getAuthPassword())) {
            //Password validada
            $funcionario->password = Hash::make($validated_data['newPassword']);
            $funcionario->save();
            return redirect()->route('admin.funcionarios.edit', ['funcionario' => $funcionario])
                ->with('alert-msg', 'Funcionario "' . $funcionario->name . '" foi alterado com sucesso!')
                ->with('alert-type', 'success');
        }

        return redirect()->route('admin.funcionarios.password.update', ['funcionario' => $funcionario])
            ->with('alert-msg', 'Password antiga do funcionário "' . $funcionario->name . '" está incorreta!')
            ->with('alert-type', 'danger');
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
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('public/fotos');
            $newUser->url_foto = basename($path);
        }
        $newUser->password = Hash::make($validated_data['newPassword']);
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
            ->with('alert-msg', 'Foto do funcionário "' . $funcionario->name .
                '" foi removida!')
            ->with('alert-type', 'success');
    }

    public function destroy(User $funcionario)
    {
        $oldName = $funcionario->name;
        $oldUserID = $funcionario->id;
        $oldUrlFoto = $funcionario->foto_url;
        try {
            User::destroy($oldUserID);
            Storage::delete('public/fotos/' . $oldUrlFoto);
            return redirect()->route('admin.funcionarios')
                ->with('alert-msg', 'Funcionário "' . $oldName . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');

        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('admin.funcionários')
                    ->with('alert-msg', 'Não foi possível apagar o Funcionário "' . $oldName . '", porque este funcionário já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('admin.funcionários')
                    ->with('alert-msg', 'Não foi possível apagar o Funcionário "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

}





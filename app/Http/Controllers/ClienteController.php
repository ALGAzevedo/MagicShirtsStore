<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientePost;
use App\Http\Requests\ClienteUpdatePost;


use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function show_clientes()
    {
        $qry = Cliente::withoutTrashed();
        $clientes = $qry->paginate(10);
        return view('clientes.admin')
            ->withClientes($clientes);
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit')
            ->withCliente($cliente);
    }

    public function update(ClienteUpdatePost $request, Cliente $cliente)
    {
        $validated_data = $request->validated();
        $cliente->user->name = $validated_data['name'];
        $cliente->user->bloqueado = $validated_data['bloqueado'];
        $cliente->user->email = $validated_data['email'];
        if ($request->filled('password')) {
            $cliente->user->password = $validated_data['password'];
        }
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos/' . $cliente->user->foto_url);
            $path = $request->foto->store('public/fotos');
            $cliente->user->foto_url = basename($path);
        }
        $cliente->user->save();

        $cliente->endereco = $validated_data['endereco'];
        $cliente->nif = $validated_data['nif'];
        $cliente->tipo_pagamento = $validated_data['tipo_pagamento'];
        $cliente->ref_pagamento = $validated_data['ref_pagamento'];
        $cliente->save();

        return redirect()->route('home')
            ->with('alert-msg', 'Cliente "' . $cliente->user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function create(ClientePost $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->name = $validated_data['name'];
        $newUser->bloqueado = $validated_data['bloqueado'];
        $newUser->email = $validated_data['email'];
        $newUser->password = Hash::make($validated_data['password']);
        $newUser->save();

        $newCliente = new Cliente;
        $newCliente->id = $newUser->id;
        if ($request->filled('nif')) {
            $newCliente->nif = $validated_data['nif'];
        }
        if ($request->filled('endereco')) {
            $newCliente->endereco = $validated_data['endereco'];
        }
        if ($request->filled('tipo_pagamento')) {
            $newCliente->tipo_pagamento = $validated_data['tipo_pagamento'];
            $newCliente->ref_pagamento = $validated_data['ref_pagamento'];
        }

        $newCliente->save();

        return redirect()->route('/')
            ->with('alert-msg', 'Cliente "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

//    public function store(UserPost $request)
//    {
//        $validated_data = $request->validated();
//        $newUser = new User;
//        $newUser->name = $validated_data['name'];
//        $newUser->bloqueado = $validated_data['bloqueado'];
//        $newUser->email = $validated_data['email'];
//        $newUser->password = Hash::make($validated_data['password']);
//        if ($request->hasFile('foto')) {
//            Storage::delete('public/fotos/' . $newUser->foto_url);
//            $path = $request->foto->store('public/fotos');
//            $newUser->foto_url = basename($path);
//        }
//        $newUser->save();
//
//        $newCliente = new Cliente;
//        $newCliente->id = $newUser->id;
//        $newCliente->endereco = $validated_data['endereco'];
//        $newCliente->nif = $validated_data['nif'];
//        $newCliente->tipo_pagamento = $validated_data['tipo_pagamento'];
//        $newCliente->ref_pagamento = $validated_data['ref_pagamento'];
//        $newCliente->save();
//
//        return redirect()->route('/')
//            ->with('alert-msg', 'Cliente "' . $validated_data['name'] . '" foi criado com sucesso!')
//            ->with('alert-type', 'success');
//    }

    public function destroy(Cliente $cliente)
    {
        $oldName = $cliente->user->name;
        $oldUserID = $cliente->user->id;
        $oldUrlFoto = $cliente->user->foto_url;
        try {
            Cliente::destroy($oldUserID);
            User::destroy($oldUserID);
            Storage::delete('public/fotos/' . $oldUrlFoto);
            return redirect()->route('admin.clientes')
                ->with('alert-msg', 'Cliente "' . $oldName . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');

        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('admin.clientes')
                    ->with('alert-msg', 'Não foi possível apagar o Cliente "' . $oldName . '", porque este cliente já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('admin.clientes')
                    ->with('alert-msg', 'Não foi possível apagar o Cliente "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function block(Cliente $cliente)
    {
        if ($cliente->user->bloqueado == '0') {
            $cliente->user->bloqueado = '1';
        } else {
            $cliente->user->bloqueado = '0';
        }
        $cliente->user->save();

        return redirect()->route('admin.clientes')
            ->with('alert-msg', 'Cliente "' . $cliente->user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

}

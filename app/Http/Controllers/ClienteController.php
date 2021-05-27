<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientePost;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function show_clientes()
    {
        $qry = Cliente::query();
        $qry = $qry->where('id', '>', '0');
        $clientes = $qry->paginate(10);
        return view('clientes.admin')
            ->withClientes($clientes);
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit')
            ->withCliente($cliente);
    }

    public function update(ClientePost $request, User $cliente)
    {

        $validated_data = $request->validated();
        $cliente->user->name = $validated_data['name'];
        $cliente->user->bloqueado = $validated_data['bloqueado'];
        $cliente->user->email = $validated_data['email'];
        $cliente->user->password = $validated_data['password'];
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

        return redirect()->route('/')
            ->with('alert-msg', 'Cliente "' . $cliente->user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function store(UserPost $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->name = $validated_data['name'];
        $newUser->bloqueado = $validated_data['bloqueado'];
        $newUser->email = $validated_data['email'];
        $newUser->password = Hash::make($validated_data['password']);
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos/' . $newUser->foto_url);
            $path = $request->foto->store('public/fotos');
            $newUser->foto_url = basename($path);
        }
        $newUser->save();

        $newCliente = new Cliente;
        $newCliente->endereco = $validated_data['endereco'];
        $newCliente->nif = $validated_data['nif'];
        $newCliente->tipo_pagamento = $validated_data['tipo_pagamento'];
        $newCliente->ref_pagamento = $validated_data['ref_pagamento'];
        $newCliente->save();

        return redirect()->route('/')
            ->with('alert-msg', 'Cliente "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

}

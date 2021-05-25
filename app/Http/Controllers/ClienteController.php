<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

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

    public function update(UserPost $request, User $funcionario)
    {

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

}

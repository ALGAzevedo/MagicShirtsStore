<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function show_clientes()
    {
        $clientes = Cliente::all();
        return view('clientes.admin')
        ->withClientes($clientes);
    }
}

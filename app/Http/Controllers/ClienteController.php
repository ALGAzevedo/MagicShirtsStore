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
}

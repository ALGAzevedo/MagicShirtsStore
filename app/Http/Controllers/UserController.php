<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admin_funcs(){

        $qry = User::query();
        $qry->where('tipo','F')
            ->orWhere('tipo', 'A');

        //$funcionarios = User::pluck('name', 'email', 'tipo')->paginate(10);
        $funcs = $qry->paginate(10);
        return view('funcionarios.admin')
            ->withFuncs($funcs);
    }

    public function edit(User $funcionario)
    {
        return view('funcionarios.edit')
            ->withFuncionmario($funcionario);
    }

}

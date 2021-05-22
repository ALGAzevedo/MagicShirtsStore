<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admin_index(){

        $qry = User::query();

        //$users = User::pluck('name', 'email', 'tipo')->paginate(10);
        $users = $qry->paginate(10);
        return view('users.index')
            ->withUsers($users);
    }
}

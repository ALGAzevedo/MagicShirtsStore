<?php

namespace App\Http\Controllers;

use App\Notifications\EncomendaRecebida;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Notification;
use Illuminate\Notifications\Notifiable;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function encomendaRecebida()
    {
        $encomenda = null;
        $user = User::findOrFail(Auth::id());
        $user->notify(new EncomendaRecebida($encomenda));
    }
}

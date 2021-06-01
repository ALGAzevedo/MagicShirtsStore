<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new funcionarios as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect funcionarios after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['tipo_ref'] = 'true';
        if($data['tipo_pagamento'] == ""){
            $data['tipo_ref'] = 'false';
        }

        return Validator::make($data, [

            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nif' => [
                'nullable',
                'numeric',
                'digits:9',
            ],
            'endereco' => 'nullable',
            'tipo_pagamento' => [
                'nullable',
                'in:MC,PAYPAL,VISA',
            ],
            'ref_pagamento' => 'required_if:tipo_ref, true',
            'bloqueado' => [
                'required',
                'in:0'
            ],
            'tipo' => [
                'required',
                'in:C'
            ],
            'email' => [
                'required',
                'email',
                    Rule::unique('users', 'email'),
            ],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'tipo' => $data['tipo'],
            'bloqueado' => $data['bloqueado'],
            'password' => Hash::make($data['password']),
        ]);
        $newUser->save();


        $newCliente = new Cliente;
        $newCliente->id = $newUser->id;
        if($data['nif'] != ""){
            $newCliente->nif = $data['nif'];
        }
        if($data['endereco'] != ""){
            $newCliente->endereco = $data['endereco'];
        }
        if($data['tipo_pagamento'] != ""){
            $newCliente->tipo_pagamento = $data['tipo_pagamento'];
            $newCliente->ref_pagamento = $data['ref_pagamento'];
        }

        $newCliente->save();

        return $newUser;
    }
}

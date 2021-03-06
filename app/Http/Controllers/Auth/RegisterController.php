<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Providers\RouteServiceProvider;
use App\Models\User;
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
    protected $redirectTo = '/email/verify';

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

        $validation_array = [
            'name' => 'required',
            'bloqueado' => 'required|in:1,0',
            'tipo' => 'required|in:C',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'nif' => [
                'nullable',
                'numeric',
                'digits:9'
            ],
            'endereco' => [
                'nullable',
                'string',
                'max:255',
            ],
            'tipo_pagamento' => 'nullable|in:MC,PAYPAL,VISA',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],

            'foto' => 'nullable|image|max:8192', // M??ximum size = 8Mb
        ];


        $messages = [
            'name.required' => 'O campo nome ?? obrigat??rio.',

            'password.required' => 'O campo password ?? obrigat??rio.',
            'password.string' => 'O campo password tem que ser texto.',
            'password.min' => 'O campo password tem que ter tamanho m??nimo 8.',
            'password.confirmed' => 'As passwords n??o coincidem.',

            'password_confirmation.required' => 'O campo confirma????o de password ?? obrigat??rio.',
            'password_confirmation.string' => 'O campo confirma????o de password tem que ser texto.',
            'password_confirmation.min' => 'O campo confirma????o de password tem que ter tamanho m??nimo 8.',

            'nif.numeric' => 'O campo NIF tem que ser num??rico.',
            'nif.digits' => 'O campo NIF tem que ter exatamente 9 d??gitos.',

            'endereco.string' => 'O campo endere??o tem que ser texto.',
            'endereco.max' => 'O campo endere??o tem um limite de 255 caracteres.',

            'email.required' => 'O campo email ?? obrigat??rio.',
            'email.email' => 'O campo email tem que ser um email v??lido.',
            'email.unique' => 'O email que utilizou j?? existe.',

            'foto.image' => 'A foto tem que ser uma imagem.',
            'foto.max:8192' => 'A foto tem que ter tamanho m??ximo de 8Mb.',

            'ref_pagamento.required' => 'O campo refer??ncia de pagamento ?? obrigat??rio.',
            'ref_pagamento.email' => 'A refer??ncia de pagamento deve ser o seu email do PayPal.',
            'ref_pagamento.numeric' => 'A refer??ncia de pagamento deve ser o seu n??mero do cart??o de cr??dito.',
            'ref_pagamento.digits' => 'O n??mero do seu cart??o deve ter 16 digitos.',
        ];


        if ($data['tipo_pagamento'] == 'MC' || $data['tipo_pagamento'] == 'VISA') {
            $validation_array += [
                'ref_pagamento' => ['required', 'numeric', 'digits:16'],
            ];

        }
        if ($data['tipo_pagamento'] == 'PAYPAL') {
            $validation_array += [
                'ref_pagamento' => ['required', 'email'],
            ];
        }


        return Validator::make($data, $validation_array, $messages);

    }


    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'body.required' => 'A message is required',

        ];
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
        if ($data['nif'] != "") {
            $newCliente->nif = $data['nif'];
        }
        if ($data['endereco'] != "") {
            $newCliente->endereco = $data['endereco'];
        }
        if ($data['tipo_pagamento'] != "") {
            $newCliente->tipo_pagamento = $data['tipo_pagamento'];
            $newCliente->ref_pagamento = $data['ref_pagamento'];
        }

        $newCliente->save();

        return $newUser;
    }

}

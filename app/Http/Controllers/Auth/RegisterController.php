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

            'foto' => 'nullable|image|max:8192', // Máximum size = 8Mb
        ];


        $messages = [
            'name.required' => 'O campo nome é obrigatório.',

            'password.required' => 'O campo password é obrigatório.',
            'password.string' => 'O campo password tem que ser texto.',
            'password.min' => 'O campo password tem que ter tamanho mínimo 8.',
            'password.confirmed' => 'As passwords não coincidem.',

            'password_confirmation.required' => 'O campo confirmação de password é obrigatório.',
            'password_confirmation.string' => 'O campo confirmação de password tem que ser texto.',
            'password_confirmation.min' => 'O campo confirmação de password tem que ter tamanho mínimo 8.',

            'nif.numeric' => 'O campo NIF tem que ser numérico.',
            'nif.digits' => 'O campo NIF tem que ter exatamente 9 dígitos.',

            'endereco.string' => 'O campo endereço tem que ser texto.',
            'endereco.max' => 'O campo endereço tem um limite de 255 caracteres.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email tem que ser um email válido.',
            'email.unique' => 'O email que utilizou já existe.',

            'foto.image' => 'A foto tem que ser uma imagem.',
            'foto.max:8192' => 'A foto tem que ter tamanho máximo de 8Mb.',

            'ref_pagamento.required' => 'O campo referência de pagamento é obrigatório.',
            'ref_pagamento.email' => 'A referência de pagamento deve ser o seu email do PayPal.',
            'ref_pagamento.numeric' => 'A referência de pagamento deve ser o seu número do cartão de crédito.',
            'ref_pagamento.digits' => 'O número do seu cartão deve ter 16 digitos.',
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

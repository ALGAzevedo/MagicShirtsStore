<?php

namespace App\Http\Controllers;

use App\Models\Preco;
use Illuminate\Http\Request;
use App\Http\Requests\PrecoPost;

class PrecosController extends Controller
{
    public function admin_index()
    {
        $precos = Preco::all();
        $precos = $precos->first();

        return view('precos.admin', compact('precos'));
    }

    public function edit(Preco $precos)
    {
        /*
        $precos = Preco::all();
        $precos = $precos->first();
        */
        return view('precos.edit', compact('precos'));
    }

    public function update(PrecoPost $request, Preco $precos)
    {

        $precos->fill($request->validated());
        $precos->save();
        return redirect()->route('admin.precos')
            ->with('alert-msg', 'Precos alterados com sucesso!')
            ->with('alert-type', 'success');
    }




}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstampaPost;
use App\Models\Categoria;
use App\Models\Estampa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClienteEstampaController extends Controller
{

    public function index()
    {
        $estampas = Estampa::where('cliente_id', Auth::id())->whereNull('categoria_id') ->orderBy('id', 'desc')->paginate(6);
        return view('estampas.cliente.index',compact('estampas'))->with('pageTitle', 'Minhas Estampas');
    }

    public function create()
    {
        $estampa = new Estampa();
        return view('estampas.cliente.create', compact('estampa'))->with('pageTitle', 'Adicionar nova estampa');
    }


    public function store(EstampaPost $request)
    {


        //TODO: CÓDIGO DUPLICADO COM O ADMIN
        $validated_data = $request->validated();

        $newEstampa = new Estampa;
        $newEstampa->cliente_id = Auth::id();
        $newEstampa->nome = $request->nome;
        $newEstampa->descricao = $request->descricao;
        if ($request->hasFile('estampa_img')) {
            $path = $request->estampa_img->store('public/estampas');
            $newEstampa->imagem_url = basename($path);
        }

        $newEstampa->save();
        return redirect()->route('estampas.cliente')
            ->with('alert-msg', 'Estampa "' . $newEstampa->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');

    }

    public function edit(Estampa $estampa)
    {
        return view('estampas.cliente.edit', compact('estampa'))->with('pageTitle', $estampa->nome);
    }


    public function update(EstampaPost $request, Estampa $estampa)
    {
        //$estampa->fill($request->validated());
        //TODO : Cuidado com o fill
        $request->validated();
        $estampa->fill($request->only(['nome', 'descricao']));

        $estampa->save();
        return redirect()->route('estampas.cliente')
            ->with('alert-msg', 'Estampa "' . $estampa->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }


    public function destroy(Estampa $estampa)
    {

        $oldName = $estampa->nome;
        $oldEstampaUrl = $estampa->imagem_url;
        try {
            $estampa->delete();
            Storage::delete('public/estampas/' . $oldEstampaUrl);
            return redirect()->route('estampas.cliente')
                ->with('alert-msg', 'Estampa "' . $oldName . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {


            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('estampas.cliente')
                    ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldName . '", porque esta estampa já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('estampas.cliente')
                    ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }


}

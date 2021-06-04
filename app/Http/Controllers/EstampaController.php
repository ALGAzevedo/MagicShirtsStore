<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Estampa;
use Illuminate\Http\Request;
use App\Http\Requests\EstampaPost;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EstampaController extends Controller
{
    public function index(Request $request)
    {

        $request->flashOnly('s');

        //$estampas = Estampa::search($request->s)->paginate(5); //TODO: CRIAR MÉTODO SEARCH NO MODEL
        $search = $request->s;
        $listaCategorias = Categoria::all();
        $categoria = new Categoria();
        $view = 'estampas.index';


        //$estampas_user = Estampa::where('cliente_id', Auth::id())->paginate(4);

        // Filtra estampas do catálogo o nome ou descrição:s
        if($request->filled('s')){
            $listaCategorias = Categoria::all();
            $estampas = Estampa::where('nome', 'LIKE', '%' . $search . '%')
                ->whereNull('cliente_id')
                ->orWhere('descricao', 'LIKE', '%' . $search . '%')
                ->paginate(6);

            $view = 'estampas.search';

        }elseif($request->filled('categoria')){
            $id = $request->query('categoria', $listaCategorias[0]->id);
            $categoria = Categoria::findOrFail($id);

            // Filtra estampas do catálogo com categoria:id
            $estampas = Estampa::where('categoria_id', $id)
                ->whereNull('cliente_id')
                ->paginate(6);
        }else{

            // Apenas as estampas do catálogo
             $estampas = Estampa::whereNull('cliente_id')->paginate(6);

            // Filtra estampas do catálogo + estampas do cliente
            //$estampas = Estampa::whereNull('cliente_id')->orWhere('cliente_id', Auth::id()??'')->paginate(4);

        }

        return view(
            $view,
            compact('listaCategorias', 'estampas', 'categoria'));
    }


    public function admin_index(Request $request)
    {
        $categoriaSel = $request->categoria ?? '';
        $nomeSel = null;
        $descricaoSel = null;

        $qry = Estampa::query();

        if ($categoriaSel == 'Sem Categoria') {
            $qry->whereNULL('categoria_id');
        } else if ($categoriaSel && $categoriaSel != 'show_all') {
            $qry->where('categoria_id', '=', $categoriaSel);
        }

        //se nome especificado
        if ($request->has('nome')) {
            $nomeSel = $request->nome;
            $qry->where('nome', 'LIKE', '%' . $nomeSel . '%');
        }

        //se descricao especificada
        if ($request->has('descricao')) {
            $descricaoSel = $request->descricao;
            $qry->where('descricao', 'LIKE', '%' . $descricaoSel . '%');
        }

        //todas as categorias
        $listaCategorias = Categoria::pluck('nome', 'id');
        $estampas = $qry->where('cliente_id', "=", null);
        $estampas = $qry->paginate(10);

        return view('estampas.admin',
            compact('estampas', 'listaCategorias', 'categoriaSel', 'nomeSel', 'descricaoSel'));
    }


    public function edit(Estampa $estampa)
    {
        $listaCat = Categoria::all();
        $cat = $listaCat->where('id', $estampa->id);

        return view('estampas.adminEdit', compact('estampa', 'listaCat', 'cat'));
    }


    public function update(EstampaPost $request, Estampa $estampa)
    {
        $estampa->fill($request->validated());

        $estampa->save();
        return redirect()->route('admin.estampas')
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
            return redirect()->route('admin.estampas')
                ->with('alert-msg', 'Estampa "' . $oldName . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {


            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('admin.estampas')
                    ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldName . '", porque esta estampa já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('admin.estampas')
                    ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    public function create()
    {
        $estampa = new Estampa();
        $listaCat = Categoria::all();
        return view('estampas.AdminCreate', compact('estampa', 'listaCat'));
    }


    public function store(EstampaPost $request)
    {

        $validated_data = $request->validated();

        $newEstampa = new Estampa;

        $newEstampa->nome = $validated_data['nome'];
        $newEstampa->categoria_id = $validated_data['categoria_id'];
        $newEstampa->descricao = $validated_data['descricao'];
        if ($request->hasFile('estampa_img')) {
            $path = $request->estampa_img->store('public/estampas');
            $newEstampa->imagem_url = basename($path);
        }

        $newEstampa->save();
        return redirect()->route('admin.estampas')
            ->with('alert-msg', 'Estampa "' . $newEstampa->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }


}

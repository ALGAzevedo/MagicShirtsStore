<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Http\Requests\CategoriaPost;

class CategoriaController extends Controller
{

    public function admin_index(Request $request)
    {
        $listaCategorias = Categoria::paginate(10);
        return view(
            'categorias.admin',
            compact('listaCategorias'));
    }

    public function create()
    {
        $categoria = new Categoria();
        return view('categorias.create',compact('categoria'));
    }

    public function store(CategoriaPost $request)
    {
        $newCategoria = Categoria::create($request->validated());
        return redirect()->route('admin.categorias')
            ->with('alert-msg', 'Categoria "' . $newCategoria->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit')
            ->withCategoria($categoria);
    }

    public function update(CategoriaPost $request, Categoria $categoria)
    {
        $categoria->fill($request->validated());
        $categoria->save();
        return redirect()->route('admin.categorias')
            ->with('alert-msg', 'Categoria "' . $categoria->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Categoria $categoria)
    {
        $oldName = $categoria->nome;
        try {
            $this->removeCategory($categoria->id);
            $categoria->delete();
            return redirect()->route('admin.categorias')
                ->with('alert-msg', 'Categoria "' . $oldName . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('admin.categorias')
                    ->with('alert-msg', 'N??o foi poss??vel apagar a Categoria "' . $oldName . '", porque esta categoria j?? est?? em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('admin.categorias')
                    ->with('alert-msg', 'N??o foi poss??vel apagar a categoria "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

    //ESTAMPAS DA CATEGORIA ELIMINADA PASSAM A TER CATEGORIA NULL
    private function removeCategory($categoria) {

        $estampas = Estampa::where('categoria_id', $categoria)->get();
        foreach ($estampas as $estampa) {
            $estampa->categoria_id = null;
            $estampa->save();
        }
    }


}

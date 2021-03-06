<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cor;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CorPost;



class CoresController extends Controller
{
    public function index() {
        $cores = Cor::withoutTrashed()->paginate(10);

        return view('cores.admin', compact('cores'));
    }


    public function create()
    {
        $cor = new Cor();
        return view('cores.create',compact('cor'));
    }

    public function store(CorPost $request)
    {
        $validated_data = $request->validated();

        $newCor = new Cor;

        $newCor->nome = $validated_data['nome'];
        $newCor->codigo = strtolower($validated_data['codigo']);

        if ($request->hasFile('imgShirt')) {


            $custom_name = strtolower($validated_data['codigo']).'.'.$validated_data['imgShirt']->extension();

            $request->imgShirt->storeAs('public/tshirt_base/', $custom_name);
        }

        $newCor->save();

        return redirect()->route('admin.cores')
            ->with('alert-msg', 'Cor "' . $newCor->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Cor $cor)
    {

        $oldName = $cor->nome;
        try {
            $cor->delete();
            return redirect()->route('admin.cores')
                ->with('alert-msg', 'Cor "' . $oldName . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('admin.cores')
                    ->with('alert-msg', 'Não foi possível apagar a Cor "' . $oldName . '", porque esta cor já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('admin.cores')
                    ->with('alert-msg', 'Não foi possível apagar a Cor "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }
    }

}

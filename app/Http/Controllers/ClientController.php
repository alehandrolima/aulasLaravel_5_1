<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(){
        return \CodeProject\Client::all();
    }

    public function store(Request $request){
        return Client::create($request->all());
    }

    public function show($id){
        return Client::find($id);
    }

    public function delete($id){
        Cltry{
            if(Client::find($id)){
                Client::find($id)->delete();
                return 'O Cliente foi apagado com sucesso';
            }else{
                return 'Cliente inesistente';
            }
        }
        catch(ModelNotFoundException $e){
            return 'Erro ao tentar deletar o Cliente. Erro: '.$e;
        }
    }

    public function update(Request $request, $id)
    {
        Client::find($id)->update($request->all());
        return Client::find($id);
    }




}

<?php
/**
 * Created by PhpStorm.
 * User: Comp
 * Date: 12/06/2016
 * Time: 19:06
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidators;


class ClientService
{
    protected $repository;
    protected $validator;

    public function __construct(ClientRepository $repository, ClientValidators $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function index()
    {
        try {
            return $this->repository->all();
        } catch (\Exception  $e){
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function show ($id)
    {
        try {
            return $this->repository->find($id);
        } catch (\Exception  $e){
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
    
    public function create (array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (\Exception  $e){ //foi preciso tirar ValidatorException
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function update (array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            $this->repository->find($id)->update($data);
            return $this->repository->find($id);
        }catch(\Exception  $e){
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function delete($id){
        try{
            if($this->repository->find($id)){
                $this->repository->find($id)->delete();
                return 'O Cliente foi apagado com sucesso!';
            }else{
                return 'Cliente inesistente!';
            }
        }
        catch(\Exception $e){
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }


}
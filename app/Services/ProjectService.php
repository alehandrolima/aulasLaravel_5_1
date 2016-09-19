<?php
/**
 * Created by PhpStorm.
 * User: Comp
 * Date: 12/06/2016
 * Time: 19:06
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidators;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class ProjectService
{
    protected $repository;
    protected $validator;

    public function __construct(ProjectRepository $repository, ProjectValidators $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function index()
    {
        try {
            //return $this->repository->all();
            return $this->repository->findWhere(['owner_id'=> Authorizer::getResourceOwnerId()]);
        } catch (\Exception  $e){
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }


    public function store (array $data)
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
                return 'O Projeto foi apagado com sucesso!';
            }else{
                return 'Projeto inesistente!';
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
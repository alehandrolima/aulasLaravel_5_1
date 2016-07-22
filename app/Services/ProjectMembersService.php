<?php

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectMembersRepository;
use CodeProject\Validators\ProjectMembersValidator;


class ProjectMembersService
{
    protected $repository;
    protected $validator;

    public function __construct(ProjectMembersRepository $repository, ProjectMembersValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function index($id)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id]);
        } catch (\Exception  $e){
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function show ($id, $membersId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id , 'user_id' => $membersId]);
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
                return 'Member apagado com sucesso!';
            }else{
                return 'Member inesistente!';
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
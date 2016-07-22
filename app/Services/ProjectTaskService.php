<?php

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;


class ProjectTaskService
{
    protected $repository;
    protected $validator;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
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

    public function show ($id, $taskId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id , 'id' => $taskId]);
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
                return 'Task apagada com sucesso!';
            }else{
                return 'Task inesistente!';
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
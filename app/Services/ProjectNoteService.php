<?php
/**
 * Created by PhpStorm.
 * User: Comp
 * Date: 12/06/2016
 * Time: 19:06
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;


class ProjectNoteService
{
    protected $repository;
    protected $validator;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
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

    public function show ($id, $noteId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id , 'id' => $noteId]);
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
                return 'Anotação apagada com sucesso!';
            }else{
                return 'Anotação inesistente!';
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
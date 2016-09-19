<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class ProjectController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjectRepository $repository,  ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function store(Request $request)
    {
        return $this->service->store($request->all());
    }

    public function show($id)
    {
        if ($this->checkProjectPermissions($id)== false){
            return response(['error' => 'Access Forbidden']);
        };
        return $this->repository->find($id);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    private function checkProjectOwner($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }

    private function checkProjectMember($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId, $userId);
    }

    private function checkProjectPermissions($projectId)
    {
        if ($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)){
            return true;
        }

        return false;
    }
}

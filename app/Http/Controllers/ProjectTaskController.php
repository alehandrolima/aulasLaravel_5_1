<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Services\ProjectTaskService;
use Illuminate\Http\Request;


class ProjectTaskController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjectTaskRepository $repository,  ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($id)
    {
        return $this->service->index($id);
    }

    public function store(Request $request)
    {
        return $this->service->store($request->all());
    }

    public function show($id, $taskId)
    {
        return $this->service->show($id, $taskId);
    }

    public function delete($id, $taskId)
    {
        return $this->service->delete($taskId);
    }

    public function update(Request $request, $id, $taskId)
    {
        return $this->service->update($request->all(), $taskId);
    }
}

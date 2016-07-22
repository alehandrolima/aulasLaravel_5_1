<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectMembersRepository;
use CodeProject\Services\ProjectMembersService;
use Illuminate\Http\Request;

class ProjectMembersController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjectMembersRepository $repository, ProjectMembersService $service)
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

    public function show($id, $membersId)
    {
        return $this->service->show($id, $membersId);
    }

    public function delete($id, $membersId)
    {
        return $this->service->delete($membersId);
    }
}

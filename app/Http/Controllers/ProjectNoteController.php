<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;
use Illuminate\Http\Request;

class ProjectNoteController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjectNoteRepository $repository,  ProjectNoteService $service)
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

    public function show($id, $noteId)
    {
        return $this->service->show($id, $noteId);
    }

    public function delete($id, $noteId)
    {
        return $this->service->delete($noteId);
    }

    public function update(Request $request, $id, $noteId)
    {
        return $this->service->update($request->all(), $noteId);
    }
}

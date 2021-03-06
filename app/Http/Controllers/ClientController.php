<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ClientRepository $repository,  ClientService $service)
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
        return $this->service->create($request->all());
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }
}

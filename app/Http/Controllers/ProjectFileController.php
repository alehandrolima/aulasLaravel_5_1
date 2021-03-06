<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Services\ProjectFileService;
use CodeProject\Services\ProjectService;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProjectFileController extends Controller
{
    private $repository;
    private $service;
    private $storage;
    private $projectService;

    public function __construct(ProjectFileRepository $repository,
                                ProjectFileService $service,
                                ProjectService $projectService,
                                Factory $storage)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->projectService = $projectService;
        $this->storage = $storage;
    }

    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function store(Request $request, $id)
    {
        try {
            $data = $request->all();
            $data['project_id'] = $id;
            $validator = Validator::make($data, [
                'file' => 'required'
            ]);
            if ($validator->fails()) {
                return [
                    'error' => true,
                    'message' => 'Unselected file'
                ];
            }
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $data['file'] = $file;
            $data['extension'] = $extension;
            $data['name'] = $request->name;
            $data['project_id'] = $request->project_id;
            $data['description'] = $request->description;
            return $this->service->create($data);
        } catch (ModelNotFoundException $ex) {
            return [
                'error' => true,
                'message' => 'Error store file'
            ];
        }
    }

    public function showFile($id, $idFile)
    {
        if ($this->projectService->checkProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }
        $model = $this->repository->skipPresenter()->find($idFile);
        $filePath = $this->service->getFilePath($idFile);
        $fileContent = file_get_contents($filePath);
        $file64 = base64_encode($fileContent);
        return [
            'file' => $file64,
            'size' => filesize($filePath),
            'name' => $this->service->getFileName($idFile),
            'mime_type' => $this->storage->mimeType($model->getFileName())
        ];
    }

    public function show($id, $idFile)
    {
        if ($this->projectService->checkProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }
        $result = $this->repository->findWhere(['project_id' => $id, 'id' => $idFile]);
        if (isset($result['data']) && count($result['data']) == 1) {
            $result = [
                'data' => $result['data'][0]
            ];
        }
        return $result;
    }

    public function update(Request $request, $id, $idFile)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        if ($this->projectService->checkProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }
        return $this->service->update($data, $idFile);
    }

    public function destroy($id, $idFile)
    {
        try {
            if ($this->projectService->checkProjectPermissions($id) == false) {
                return ['error' => 'Access Forbidden'];
            }
            $this->service->delete($idFile);
            return [
                'error' => false,
                'message' => 'Store file deleted'
            ];
        } catch (ModelNotFoundException $ex) {
            return [
                'error' => true,
                'message' => 'Store file error'
            ];
        }
    }


}

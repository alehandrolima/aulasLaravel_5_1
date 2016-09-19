<?php
/**
 * Created by PhpStorm.
 * User: Comp
 * Date: 12/06/2016
 * Time: 19:06
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectFileValidator;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Prettus\Validator\Contracts\ValidatorInterface;


class ProjectFileService
{
    protected $repository;
    protected $projectRepository;
    protected $validator;
    private $filesystem;
    private $storage;
    protected $validatorProjectFile;

    public function __construct(ProjectFileRepository $repository,
                                ProjectRepository $projectRepository,
                                ProjectFileValidator $validator,
                                Filesystem $filesystem,
                                Storage $storage)
    {
        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }


    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $project = $this->projectRepository->skipPresenter()->find($data['project_id']);
            $projectFile = $project->files()->create($data);
            $this->storage->put($projectFile->getFileName(), $this->filesystem->get($data['file']));
            return $projectFile;
        }catch (\Exception  $e){
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            return $this->repository->update($data, $id);
        } catch (\Exception  $e){
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
    public function getFilePath($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $this->getBaseUrl($projectFile);
    }
    public function getFileName($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $projectFile->getFileName();
    }
    private function getBaseUrl($projectFile)
    {
        switch ($this->storage->getDefaultDriver()) {
            case 'local':
                return $this->storage->getDriver()->getAdapter()->getPathPrefix()
                . '/' . $projectFile->getFileName();
                break;
        }
    }
    public function delete($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        if ($this->storage->exists($projectFile->getFileName())) {
            $this->storage->delete($projectFile->getFileName());
            return $projectFile->delete();
        }
    }
}
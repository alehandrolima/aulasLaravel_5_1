<?php

namespace CodeProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Entities\ProjectTask;
use CodeProject\Validators\ProjectTaskValidator;

class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository
{
    public function model()
    {
        return ProjectTask::class;
    }

    public function validator()
    {

        return ProjectTaskValidator::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
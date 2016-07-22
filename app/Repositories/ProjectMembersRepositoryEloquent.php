<?php

namespace CodeProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Repositories\ProjectMembersRepository;
use CodeProject\Entities\ProjectMembers;
use CodeProject\Validators\ProjectMembersValidator;

class ProjectMembersRepositoryEloquent extends BaseRepository implements ProjectMembersRepository
{
    public function model()
    {
        return ProjectMembers::class;
    }

    public function validator()
    {

        return ProjectMembersValidator::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
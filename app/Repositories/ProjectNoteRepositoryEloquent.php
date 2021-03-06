<?php

namespace CodeProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Entities\ProjectNote;
use CodeProject\Validators\ProjectNoteValidator;

class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
    public function model()
    {
        return ProjectNote::class;
    }

    public function validator()
    {

        return ProjectNoteValidator::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

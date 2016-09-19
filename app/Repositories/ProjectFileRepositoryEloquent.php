<?php
/**
 * Created by PhpStorm.
 * User: Comp
 * Date: 12/06/2016
 * Time: 17:31
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\ProjectFile;
use CodeProject\Presenters\ProjectFilePresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{
    public function model()
    {
        return ProjectFile::class;
    }

    public function presenter()
    {
        return ProjectFilePresenter::class;
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: Comp
 * Date: 12/06/2016
 * Time: 17:31
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ProjectPresenter;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    public function model()
    {
        return Project::class;
    }

    public function isOwner($projectId, $userId)
    {
        $result = $this->findWhere(['id' => $projectId, 'owner_id' => $userId]);
        if (count($result)) {
            return true;
        }
        return false;
    }

    public function hasMember($projectId, $memberId)
    {
        $project = $this->find($projectId);
        foreach ($project->members as $member) {
            if ($member->id == $memberId) {
                return true;
            }
        }
        return false;
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }


}
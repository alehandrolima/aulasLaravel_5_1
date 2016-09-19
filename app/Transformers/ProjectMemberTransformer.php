<?php
/**
 * Created by PhpStorm.
 * User: Comp
 * Date: 18/09/2016
 * Time: 22:04
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{

    public function transform(User $member)
    {
        return [
            'member_id' => $member->id,
            'name' => $member->name,
        ];
    }
}
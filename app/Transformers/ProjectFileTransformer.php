<?php
/**
 * Created by PhpStorm.
 * User: Comp
 * Date: 18/09/2016
 * Time: 22:04
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFileTransformer extends TransformerAbstract
{

    public function transform(ProjectFile $projectFile)
    {
        return [
            'id' => $projectFile->id,
            'name' => $projectFile->name,
            'description' => $projectFile->description,
            'extension' => $projectFile->extension,
            //'project_id' => $projectFile->project_id,
            'created_at' => date_format($projectFile->created_at, "Y-m-d h:m:s"),
            'updated_at' => date_format($projectFile->created_at, "Y-m-d h:m:s"),
        ];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Comp
 * Date: 18/09/2016
 * Time: 22:12
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectFileTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectFilePresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new ProjectFileTransformer();
    }
}
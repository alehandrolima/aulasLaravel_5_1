<?php
/**
 * Created by PhpStorm.
 * User: Comp
 * Date: 12/06/2016
 * Time: 19:19
 */

namespace CodeProject\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectValidators extends LaravelValidator
{
    protected $rules = [
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
        'name' => 'required',
        'progress' => 'required|min:0|max:100|integer',
        'status' => 'required|min:0|max:10|integer',
        'due_date' => 'required|date'
    ];
}
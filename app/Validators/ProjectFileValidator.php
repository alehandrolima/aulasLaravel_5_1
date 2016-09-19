<?php
/**
 * Created by PhpStorm.
 * User: Comp
 * Date: 12/06/2016
 * Time: 19:19
 */

namespace CodeProject\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' 			=> 'required|max:255',
            'file'			=> 'required|max:2000|mimes:jpeg,jpg,png,gif,pdf,zip,txt,docx',
            'description' 	=> 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' 			=> 'required|max:255',
            'description' 	=> 'required',
        ]
    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: Comp
 * Date: 12/06/2016
 * Time: 19:19
 */

namespace CodeProject\Validators;

use \Prettus\Validator\LaravelValidator;

class ClientValidators extends LaravelValidator
{
    protected $rules = [
        'name' => 'required|max:255',
        'responsible' => 'required|max:255',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required'
    ];
}
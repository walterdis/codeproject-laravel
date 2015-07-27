<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 25/07/2015
 * Time: 01:02
 */

namespace CodeProject\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;
use Illuminate\Validation\Factory;

class ProjectValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'progress' => 'required|Integer',
            'status' =>'required',
            'due_date' => 'required',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'name' => 'sometimes|required|max:255',
            'description' => 'sometimes|required|max:255',
            'progress' => 'sometimes|required|Integer',
            'status' =>'sometimes|required',
            'due_date' => 'sometimes|required',
        ]
    ];
} 
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

class ProjectTaskValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'project_id' => 'required|max:255',
            'name' => 'required|max:255',
            'start_date' => 'required|date|max:255',
            'due_date' => 'required|date',
            'status' =>'required',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'project_id' => 'required|max:255',
            'name' => 'sometimes|required|max:255',
            'start_date' => 'sometimes|date',
            'due_date' => 'sometimes|required|date',
            'status' =>'sometimes|required',
        ]
    ];
} 
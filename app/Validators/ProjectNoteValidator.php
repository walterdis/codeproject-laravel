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

class ProjectNoteValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'project_id' => 'required|max:255',
            'title' => 'required|max:255',
            'note' => 'required',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'project_id' => 'sometimes|required|max:255',
            'title' => 'sometimes|required|max:255',
            'note' => 'sometimes|required',
        ]
    ];
} 
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

class ClientValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|max:255',
            'responsible' => 'required|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' =>'required',
            'address' => 'required',
        ],

        ValidatorInterface::RULE_UPDATE => [
            'name' => 'sometimes|required|max:255',
            'responsible' => 'sometimes|required|max:255',
            'email' => 'sometimes|required|email|unique:clients,email',
            'phone' =>'sometimes|required',
            'address' => 'sometimes|required',
        ]
    ];
} 
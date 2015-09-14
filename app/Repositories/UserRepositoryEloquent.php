<?php

namespace CodeProject\Repositories;


use CodeProject\Repositories\Contracts\UserRepository;
use CodeProject\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{

    public function model()
    {
        return User::class;
    }



} 
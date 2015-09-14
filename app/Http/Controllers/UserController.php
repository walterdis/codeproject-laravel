<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\Contracts\UserRepository;
use CodeProject\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository) {

        $this->userRepository = $repository;
    }

    /**
     *
     */
    public function authenticated()
    {
        $idUser = Authorizer::getResourceOwnerId();

        return $this->userRepository->find($idUser);
    }
}

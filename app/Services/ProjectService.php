<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 25/07/2015
 * Time: 00:06
 */

namespace CodeProject\Services;


use CodeProject\Repositories\Contracts\ProjectRepository;
use CodeProject\User;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var ProjectValidator
     */
    private $validator;

    /**
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     */
    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            return $this->repository->create($data);
        } catch(ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        try {
            $this->validator->with($data)->setId($id)
                ->passesOrFail(ValidatorInterface::RULE_UPDATE);

            return $this->repository->update($data, $id);
        } catch(ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    /**
     * @param $request
     * @param $id
     * @return json
     */
    public function addMember($request, $id)
    {
        $user_id = $request['user_id'];

        if(!$this->repository->memberExists($user_id, $id)) {
            return ['error' => true, 'message' => 'Não foi possível encontrar o membro especificado.'];
        }

        try {
            $this->repository->addMember($id, $user_id);
            return ['error' => false, 'message' => 'Membro adicionado ao projeto'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Projeto inválido.'];
        }
    }

    /**
     * @param $id
     * @param $user_id
     * @return json
     */
    public function removeMember($id, $user_id)
    {
        try {
            $this->repository->removeMember($id, $user_id);
            return ['error' => false, 'message' => 'Membro removido.'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'message' => 'Projeto inválido.'];
        }
    }
} 

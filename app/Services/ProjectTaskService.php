<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 25/07/2015
 * Time: 00:06
 */

namespace CodeProject\Services;

use CodeProject\Repositories\Contracts\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService
{

    /**
     * @var TaskRepository
     */
    protected $repository;

    /**
     * @var TaskValidator
     */
    private $validator;


    /**
     * @param ProjectTaskRepository $repository
     * @param ProjectTaskValidator $validator
     */
    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @param $project_id
     * @return mixed
     */
    public function create(array $data, $project_id)
    {
        $data['project_id'] = $project_id;
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
    public function update($data, $id, $task_id)
    {
        $data['project_id'] = $id;

        try {
            $this->validator->with($data)->setId($task_id)
                ->passesOrFail(ValidatorInterface::RULE_UPDATE);

            return $this->repository->update($data, $task_id);
        } catch(ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
} 
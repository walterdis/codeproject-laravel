<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 25/07/2015
 * Time: 00:06
 */

namespace CodeProject\Services;

use CodeProject\Repositories\Contracts\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{
    /**
     * @var ProjectNoteRepository
     */
    protected $repository;

    /**
     * @var ProjectNoteValidator
     */
    private $validator;

    /**
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteValidator $validator
     */
    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
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
     * @param $noteId
     * @return mixed
     */
    public function update($data, $id, $noteId)
    {
        $data['project_id'] = $id;

        try {
            $this->validator->with($data)->setId($noteId)
                ->passesOrFail(ValidatorInterface::RULE_UPDATE);

            return $this->repository->update($data, $noteId);
        } catch(ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
} 
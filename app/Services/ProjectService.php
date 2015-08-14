<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 25/07/2015
 * Time: 00:06
 */

namespace CodeProject\Services;


use CodeProject\Repositories\Contracts\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\Flysystem\FileNotFoundException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

Use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;


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
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;

    /**
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     * @param Filesystem $filesystem
     * @param Storage $storage
     */
    public function __construct(ProjectRepository $repository, ProjectValidator $validator, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
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

    /**
     * @param array $data
     * @return array
     */
    public function createFile(array $data)
    {
        $project = $this->repository->skipPresenter()->find($data['project_id']);
        $projectFile = $project->files()->create($data);

        $result = $this->storage->put(
            $projectFile->id.'.'.$data['extension'],
            $this->filesystem->get($data['file'])
        );

        if(!$result) {
            return ['error' => true, 'message' => 'There was an error uploading the file.'];
        }

        return ['error' => false, 'message' => 'File uploaded.'];
    }

    /**
     * @param $projectFile
     * @return array
     */
    public function destroyProjectFile($projectFile)
    {
        try {
            if($projectFile->delete($projectFile->id));

            $this->deleteFile($projectFile->id.'.'.$projectFile->extension);

            return ['success', 'message' => 'Registro excluído'];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Não foi possível encontrar o registro'
            ];
        } catch(FileNotFoundException $e) {
            return ['success', 'message' => 'Registro excluído'];
        }
    }

    /**
     * @param $file
     * @return bool
     */
    public function deleteFile($file)
    {
        if(!$this->storage->delete($file)) {
            return false;
        }

        return true;
    }
} 

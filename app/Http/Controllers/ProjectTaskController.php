<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\Contracts\ProjectTaskRepository;
use CodeProject\Services\ProjectTaskService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    /**
     * @param ProjectTaskRepository $repository
     * @param ProjectTaskService $service
     */
    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $project_id
     * @return Response
     */
    public function index($project_id)
    {
        return $this->repository->findWhere(['project_id' => $project_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @param $project_id
     * @return Response
     */
    public function store(Request $request, $project_id)
    {
        return $this->service->create($request->all(), $project_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param $taskId
     * @return Response
     */
    public function show($id, $taskId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id, 'id' => $taskId]);
        } catch( ModelNotFoundException $e ) {
            return [
                'error' => true,
                'message' => 'Não foi possível encontrar o registro'
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @param $taskId
     * @return Response
     */
    public function update(Request $request, $id, $taskId)
    {
        try {
            return $this->service->update($request->all(), $id, $taskId);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Não foi possível encontrar o registro'
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param $taskId
     * @return Response
     */
    public function destroy($id, $taskId)
    {
        try {
            if($this->repository->delete($taskId)) {
                return ['success', 'message' => 'Registro excluído'];
            }
            return ['error', 'message' => 'Erro desconhecido ao tentar excluir o registro'];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Não foi possível encontrar o registro'
            ];
        }
    }
}

<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\Contracts\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectNoteController extends Controller
{
    /**
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteService $service
     */
    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
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
        if(!$this->checkProjectPermissions($project_id)) {
            return ['error' => 'Access forbidden'];
        }

        return $this->repository->skipPresenter()->findWhere(['project_id' => $project_id]);
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
        if(!$this->checkProjectPermissions($project_id)) {
            return ['error' => 'Access forbidden'];
        }

        return $this->service->create($request->all(), $project_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param $noteId
     * @return Response
     */
    public function show($id, $noteId)
    {
        if(!$this->checkProjectPermissions($id)) {
            return ['error' => 'Access forbidden'];
        }

        try {
            return $this->repository->skipPresenter()->find($noteId);
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
     * @param $noteId
     * @return Response
     */
    public function update(Request $request, $id, $noteId)
    {
        if(!$this->checkProjectPermissions($id)) {
            return ['error' => 'Access forbidden'];
        }

        try {
            return $this->service->update($request->all(), $id, $noteId);
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
     * @param $noteId
     * @return Response
     */
    public function destroy($id, $noteId)
    {
        if(!$this->checkProjectOwner($id)) {
            return ['error' => 'Access forbidden'];
        }

        try {
            if($this->repository->delete($noteId)) {
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

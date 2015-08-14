<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\Contracts\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @param ProjectRepository $repository
     * @param ProjectService $service
     */
    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->repository->with('client')->findWhere(['owner_id' => $this->getAuthorizerId()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if(!$this->checkProjectPermissions($id)) {
            return ['error' => 'Access forbidden'];
        }

        try {
            return $this->repository->with('client')->with('owner')->find($id);
        } catch( ModelNotFoundException $e ) {
            return [
                'error' => true,
                'message' => 'Não foi possível encontrar o registro'
            ];
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function members($id)
    {
        if(!$this->checkProjectPermissions($id)) {
            return ['error' => 'Access forbidden'];
        }

        return $this->repository->findMembers($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function addMember(Request $request, $id)
    {
        if(!$this->checkProjectOwner($id)) {
            return ['error' => 'Access forbidden'];
        }

        return $this->service->addMember($request->all(), $id);
    }

    /**
     * @param $project_id
     * @param $user_id
     * @return array
     */
    public function isMember($project_id, $user_id)
    {
        $isMember = $this->repository->isMember($project_id, $user_id);

        return ['is_member' => $isMember];
    }

    /**
     * @param $id
     * @param $user_id
     * @return array
     */
    public function removeMember($id, $user_id)
    {
        if(!$this->checkProjectOwner($id)) {
            return ['error' => 'Access forbidden'];
        }

        return $this->service->removeMember($id, $user_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if(!$this->checkProjectOwner($id)) {
            return ['error' => 'Access forbidden'];
        }

        try {
            return $this->service->update($request->all(), $id);
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
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if(!$this->checkProjectOwner($id)) {
            return ['error' => 'Access forbidden'];
        }

        try {
            if($this->repository->delete($id)) {
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

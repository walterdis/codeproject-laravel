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
        return $this->repository->with('client')->with('owner')->all();
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
        return $this->repository->findMembers($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function addMember(Request $request, $id)
    {
        return $this->service->addMember($request->all(), $id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function removeMember(Request $request, $id)
    {
        return $this->service->removeMember($request->all(), $id);
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

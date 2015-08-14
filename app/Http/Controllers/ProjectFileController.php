<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\Contracts\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @param $projectId
     * @return Response
     */
    public function store(Request $request, $projectId)
    {
        if(!$this->checkProjectPermissions($projectId)) {
            return ['error' => 'Access forbidden'];
        }

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $data = [
            'file' => $file,
            'extension' => $extension,
            'description' => $request->description,
            'name' => $request->name,
            'project_id' => $projectId
        ];

        return $this->service->createFile($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $projectId
     * @param $fileId
     * @return Response
     */
    public function destroy($projectId, $fileId)
    {
        if(!$this->checkProjectOwner($projectId)) {
            return ['error' => 'Access forbidden'];
        }

        $project = $this->repository->skipPresenter()->find($projectId);
        $projectFile = $project->files()->find($fileId);

        if(!$projectFile) {
            return ['error' => true, 'message' => 'Register not found'];
        }

        return $this->service->destroyProjectFile($projectFile);
    }

}

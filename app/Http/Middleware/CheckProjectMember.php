<?php

namespace CodeProject\Http\Middleware;

use Closure;
use CodeProject\Repositories\Contracts\ProjectRepository;

class CheckProjectMember
{
    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * @param ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        var_dump($request->project);
        $project_id = $request->project;
        $isOwner = $this->repository->isMember($project_id, \Authorizer::getResourceOwnerId());

        if(!$isOwner) {
            return ['error' => 'Access forbidden'];
        }

        return $next($request);
    }
}

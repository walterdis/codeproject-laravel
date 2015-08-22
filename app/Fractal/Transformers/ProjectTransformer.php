<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 08/08/2015
 * Time: 14:39
 */

namespace CodeProject\Fractal\Transformers;

use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['members'];

    /**
     * @param Project $project
     * @return array
     */
    public function transform(Project $project)
    {
        return array(
            'project_id' => $project->id,
            'client' => $project->client_id,
            'project' => $project->name,
            'description' => $project->description,
            'progress' => $project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date
        );
    }

    /**
     * @param Project $project
     * @return mixed
     */
    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }

} 
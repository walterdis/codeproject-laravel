<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 23/07/2015
 * Time: 13:54
 */

namespace CodeProject\Repositories;

use CodeProject\Repositories\Contracts\ProjectRepository;
use CodeProject\Entities\Project;
use CodeProject\User;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{

    public function model()
    {
        return Project::class;
    }

    /**
     * @param $project_id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function findMembers($project_id)
    {
        return Project::with('members')->find($project_id);
    }


    /**
     * @param $member_id
     * @return Boolean
     */
    public function memberExists($member_id)
    {
        return User::where('id', '=', $member_id)->exists();
    }

    /**
     * @param $project_id
     * @param $member_id
     * @return Boolean
     */
    public function isMember($project_id, $member_id)
    {
        return (String) (boolean) Project::with('members')->find($project_id)->count();
    }

    /**
     * @param $project_id
     * @param $member_id
     * @return mixed
     */
    public function addMember($project_id, $member_id)
    {
        $project = Project::findOrFail($project_id);
        $project->members()->detach($member_id);

        return $project->members()->attach($member_id);
    }

    /**
     * @param $project_id
     * @param $member_id
     * @return mixed
     */
    public function removeMember($project_id, $member_id)
    {
        $project = Project::findOrFail($project_id);

        return $project->members()->detach($member_id);
    }
} 
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
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{

    public function model()
    {
        return Project::class;
    }


} 
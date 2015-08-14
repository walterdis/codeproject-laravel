<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 08/08/2015
 * Time: 14:39
 */

namespace CodeProject\Fractal\Transformers;

use CodeProject\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract
{

    /**
     * @param ProjectTask $projectTask
     * @return array
     */
    public function transform(ProjectTask $projectTask)
    {
        return array(
            'name' => $projectTask->name,
            'start_date' => $projectTask->start_date,
            'due_date' => $projectTask->due_date,
            'status' => $projectTask->status,
        );
    }
} 
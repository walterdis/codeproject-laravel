<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 08/08/2015
 * Time: 14:39
 */

namespace CodeProject\Fractal\Transformers;

use CodeProject\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends TransformerAbstract
{

    /**
     * @param ProjectNote $projectNote
     * @return array
     */
    public function transform(ProjectNote $projectNote)
    {
        return array(
            'title' => $projectNote->title,
            'note' => $projectNote->note,
        );
    }



} 
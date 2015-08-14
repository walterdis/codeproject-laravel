<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 08/08/2015
 * Time: 14:39
 */

namespace CodeProject\Fractal\Transformers;

use CodeProject\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{

    /**
     * @param User  $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
        ];
    }

} 
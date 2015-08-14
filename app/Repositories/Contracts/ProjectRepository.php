<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 23/07/2015
 * Time: 17:42
 */

namespace CodeProject\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ProjectRepository  extends RepositoryInterface
{
    public function findMembers($project_id);
    public function memberExists($member_id, $project_id);
    public function addMember($project_id, $member_id);
    public function removeMember($project_id, $member_id);
    public function isMember($project_id, $member_id);
    public function isOwner($project_id, $user_id);
} 
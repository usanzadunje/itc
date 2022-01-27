<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Time;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TimePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param Project $project
     * @return Response|bool
     */
    public function create(User $user, Project $project): Response|bool {
        //return $user->id === $project->user_id;
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Project $project
     * @param Time $time
     * @return Response|bool
     */
    public function update(User $user, Project $project, Time $time): Response|bool {
        //return $user->id === $time->project->user_id;
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Time $time
     * @return Response|bool
     */
    public function delete(User $user, Project $project, Time $time): Response|bool {
        //return $user->id === $time->project->user_id;
        return true;
    }
}

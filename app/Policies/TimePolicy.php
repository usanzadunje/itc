<?php

namespace App\Policies;

use App\Models\Time;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class TimePolicy
{
    use HandlesAuthorization;

    public function __construct(Request $request) {
        $this->project = $request->route('project');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool {
        return $user->id === $this->project->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Time $time
     * @return Response|bool
     */
    public function update(User $user, Time $time): Response|bool {
        // Only letting user update time that belongs to one of his project
        // but also that time needs to belong to project that is provided in route url.
        return $user->id === $time->project->user_id && $this->project->id === $time->project_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Time $time
     * @return Response|bool
     */
    public function delete(User $user, Time $time): Response|bool {
        // Only letting user delete time that belongs to one of his project
        // but also that time needs to belong to project that is provided in route url.
        return $user->id === $time->project->user_id && $this->project->id === $time->project_id;
    }
}

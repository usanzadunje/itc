<?php

namespace App\Policies;

use App\Models\Time;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TimePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Time $time
     * @return Response|bool
     */
    public function view(User $user, Time $time): Response|bool {
        return $user->id === $time->project->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Time $time
     * @return Response|bool
     */
    public function update(User $user, Time $time): Response|bool {
        return $user->id === $time->project->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Time $time
     * @return Response|bool
     */
    public function delete(User $user, Time $time): Response|bool {
        return $user->id === $time->project->user_id;
    }
}

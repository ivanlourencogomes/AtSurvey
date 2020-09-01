<?php

namespace App\Policies;

use App\Experiment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExperimentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any experiments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the experiment.
     *
     * @param  \App\User  $user
     * @param  \App\Experiment  $experiment
     * @return mixed
     */
    public function view(User $user, Experiment $experiment)
    {
        return $user->id == $experiment->user_id_owner || $experiment->is_public;
    }

    /**
     * Determine whether the user can create experiments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the experiment.
     *
     * @param  \App\User  $user
     * @param  \App\Experiment  $experiment
     * @return mixed
     */
    public function update(User $user, Experiment $experiment)
    {
        return $user->id == $experiment->user_id_owner;
    }

    /**
     * Determine whether the user can delete the experiment.
     *
     * @param  \App\User  $user
     * @param  \App\Experiment  $experiment
     * @return mixed
     */
    public function delete(User $user, Experiment $experiment)
    {
        //
    }

    /**
     * Determine whether the user can restore the experiment.
     *
     * @param  \App\User  $user
     * @param  \App\Experiment  $experiment
     * @return mixed
     */
    public function restore(User $user, Experiment $experiment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the experiment.
     *
     * @param  \App\User  $user
     * @param  \App\Experiment  $experiment
     * @return mixed
     */
    public function forceDelete(User $user, Experiment $experiment)
    {
        //
    }
}

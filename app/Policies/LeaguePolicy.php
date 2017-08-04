<?php

namespace App\Policies;

use App\League;
use App\User;
use App\Prediction;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeaguePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the prediction.
     *
     * @param  \App\User  $user
     * @param  \App\Prediction  $prediction
     * @return mixed
     */
    public function view(User $user, League $league)
    {
        //
    }

    /**
     * Determine whether the user can create predictions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the prediction.
     *
     * @param  \App\User $user
     * @param League $league
     * @return mixed
     */
    public function update(User $user, League $league)
    {
        return in_array($league->id, $user->myleagues->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can delete the prediction.
     *
     * @param  \App\User $user
     * @param League $league
     * @return mixed
     */
    public function delete(User $user, League $league)
    {
        return in_array($league->id, $user->myleagues->pluck('id')->toArray());
    }
}

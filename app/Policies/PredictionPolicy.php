<?php

namespace App\Policies;

use App\User;
use App\Prediction;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class PredictionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the prediction.
     *
     * @param  \App\User  $user
     * @param  \App\Prediction  $prediction
     * @return mixed
     */
    public function view(User $user, Prediction $prediction)
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
     * @param  \App\User  $user
     * @param  \App\Prediction  $prediction
     * @return mixed
     */
    public function update(User $user, Prediction $prediction)
    {
        if($prediction->match && ($prediction->match->when < Carbon::now()->addMinutes(10)))
            return false;
        return true;
    }

    /**
     * Determine whether the user can delete the prediction.
     *
     * @param  \App\User  $user
     * @param  \App\Prediction  $prediction
     * @return mixed
     */
    public function delete(User $user, Prediction $prediction)
    {
        //
    }
}

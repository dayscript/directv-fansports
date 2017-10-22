<?php

namespace App\Policies;

use App\League;
use App\Round;
use App\User;
use App\Prediction;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoundPolicy
{
    use HandlesAuthorization;

    public function index()
    {
        return true;
    }
    public function browse()
    {
        return true;
    }
    /**
     * Determine whether the user can update the prediction.
     *
     * @param  \App\User $user
     * @param Round $round
     * @return mixed
     */
    public function applycode(User $user, Round $round)
    {
        $matches = $round->matches;
        foreach ($matches as $match){
            if($match->editable)return true;
        }
        return false;
    }

}

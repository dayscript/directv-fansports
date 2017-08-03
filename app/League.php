<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    /**
     * Users of this league
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Total sum of users points
     * @return mixed
     */
    public function getUserPointsAttribute()
    {
        return $this->users->sum('points');
    }
}

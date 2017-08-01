<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    /**
     * Returns matches for this round
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matches()
    {
        return $this->hasMany(Match::class);
    }
}

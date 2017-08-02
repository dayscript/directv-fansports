<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['match_id','user_id','value','points'];

    /**
     * Match
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function match()
    {
        return $this->belongsTo(Match::class);
    }
}

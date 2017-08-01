<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['localId','visitId'];
    /**
     * Round relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roundId()
    {
        return $this->belongsTo(Round::class,'round_id');
    }
    /**
     * Local team relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function local()
    {
        return $this->localId;
    }
    /**
     * Visit team relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visit()
    {
        return $this->visitId;
    }
    /**
     * Local team relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function localId()
    {
        return $this->belongsTo(Team::class,'local_id');
    }
    /**
     * Visitor team relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitId()
    {
        return $this->belongsTo(Team::class,'visit_id');
    }
}

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','start','end'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start','end'];
    /**
     * Returns matches for this round
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matches()
    {
        return $this->hasMany(Match::class);
    }

    /**
     * Get nearest round
     */
    public static function getNearestRound()
    {
        $rounds = Round::orderBy('name')->get();
        $matches = Match::orderBy('when')->get();
        $selected_round = $rounds->first();
        foreach ($matches as $match){
            if($match->when > Carbon::now()){
                $selected_round = $match->round();
                break;
            }
        }
        return $selected_round;
    }

    /**
     * Format Start date
     * @param $date
     * @return string
     */
    public function getStartAttribute($date)
    {
        return Carbon::parse($date)->toDateString();
    }

    /**
     * Format End date
     * @param $date
     * @return string
     */
    public function getEndAttribute($date)
    {
        return Carbon::parse($date)->toDateString();
    }
}

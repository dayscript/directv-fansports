<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last', 'email', 'password', 'phone', 'gender', 'country', 'city', 'promotions'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Generates full name attribute
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->last;
    }

    /**
     * Returns all predictions for this user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    /**
     * Updates total user points
     * @return int
     */
    public function updatePoints()
    {
        $total = 0;
        foreach ($this->predictions as $prediction){
            $total += $prediction->points;
        }
        $this->points = $total;
        $this->save();
        return $total;
    }
}

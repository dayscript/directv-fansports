<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\ResetPasswordNotification;
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
        'name', 'last', 'email', 'password', 'phone', 'gender', 'country', 'city', 'promotions','identification_type','identification'
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
     * Returns all codes for this user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function codes()
    {
        return $this->hasMany(Code::class);
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

    /**
     * Leagues owned by this user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function myleagues()
    {
        return $this->hasMany(League::class);
    }
    /**
     * Leagues of this user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function leagues()
    {
        return $this->belongsToMany(League::class)->withTimestamps();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['small_image'];
    /**
     * URL for small thumbnail
     * @return mixed
     */
    public function getSmallImageAttribute()
    {
        $url = $this->image;
        $url = str_replace('.png','-small.png',$url);
        $url = str_replace('.jpg','-small.jpg',$url);
        $url = str_replace('.jpeg','-small.jpeg',$url);
        if(Storage::disk('public')->exists($url)) return $url;
        return $this->image;
    }
}

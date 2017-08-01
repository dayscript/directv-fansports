<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
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
        return $url;
    }
}

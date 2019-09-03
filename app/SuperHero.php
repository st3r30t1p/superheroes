<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperHero extends Model
{
    protected $table = 'superheros';

    protected $fillable = [
        'nickname', 'real_name', 'origin_description',
        'superpowers', 'catch_phrase', 'images'
    ];


    //mutators

    public function getImagesAttribute($value) {
        if(is_null($value)) {
            return asset('images/default-hero.jpg');
        }
        return $value;
    }
}

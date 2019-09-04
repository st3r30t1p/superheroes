<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SuperHero extends Model
{
    protected $table = 'superheros';

    protected $fillable = [
        'id','nickname', 'real_name', 'origin_description',
        'superpowers', 'catch_phrase', 'images'
    ];


    //mutators

    public function getImagesAttribute($value) {
        if(is_null($value)) {
            $arrayWithDefaultImageUrl = [asset('images/default-hero.jpg')];
            return $arrayWithDefaultImageUrl;
        }

        $arrayWithDBImagesUrl = array_map(function($value) {
            return Storage::disk('public')->url($value);
        }, explode(',', $value));

        return $arrayWithDBImagesUrl;
    }

    public function setImagesAttribute($value) {

        if(!$value) {
          $imagesInArray = array_map(function($value) {
                return substr(strrchr($value, "/"), 1);
            }, $this->images);
            return implode(',', $imagesInArray);
        }
        $this->attributes['images'] = $value;
    }
}

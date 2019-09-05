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


    //accessors & mutators

    public function getImagesAttribute($value)
    {
        if (is_null($value)) {
            $arrayWithDefaultImageUrl = [asset('images/default-hero.jpg')];
            return $arrayWithDefaultImageUrl;
        }
        $arrayWithDBImagesUrl = array_map(function ($value) {
            return Storage::disk('public')->url($value);
        }, explode(',', $value));

        return $arrayWithDBImagesUrl;
    }

    public function setImagesAttribute($value)
    {
        if (!$value) {
            $imagesInArray = array_map(function ($value) {
                return substr(strrchr($value, "/"), 1);
            }, $this->images);
            return implode(',', $imagesInArray);
        }
        if (array_key_exists("images", $this->attributes) && $this->attributes['images'] != '') {
            array_map(function ($value) {
                return Storage::disk('public')->delete($value);
            }, explode(',', $this->attributes['images']));
        }
        $this->attributes['images'] = $value;
    }
}

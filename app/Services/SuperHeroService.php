<?php

namespace App\Services;

use App\SuperHero;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SuperHeroService {

    /*private $user;

    public function __construct($user = null)
    {
        $this->user = $user ?: Auth::user();
    }*/

    static public function getHero($id)
    {
        $hero = SuperHero::find($id);
        return $hero;
    }

    static public function getHeroes()
    {
        $heroes = SuperHero::paginate(3);
        return $heroes;
    }


    static public function setHeroData($request)
    {
        $hero = new SuperHero([
            'nickname' => $request->nickname,
            'real_name' => $request->real_name,
            'origin_description' => $request->origin_description,
            'superpowers' => $request->superpowers,
            'catch_phrase' => $request->catch_phrase,
            'images' => implode(",", (new SuperHeroService())->bindImages($request))
        ]);
        return $hero->save();
    }

    static public function updateHeroData($request, $id)
    {
        $hero = SuperHero::find($id);
        $hero->nickname = $request->nickname;
        $hero->real_name = $request->real_name;
        $hero->origin_description = $request->origin_description;
        $hero->superpowers = $request->superpowers;
        $hero->catch_phrase = $request->catch_phrase;
        $hero->images = implode(",", (new SuperHeroService())->bindImages($request));
        return $hero->save();
    }

    static public function deleteHeroData($id)
    {
        $hero = SuperHero::find($id);
        foreach ($hero->images as $image) {
            Storage::disk('public')->delete(substr(strrchr($image, "/"), 1));
        }
        return $hero->delete();
    }

    private function bindImages($request)
    {
        $images = [];
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalExtension();
                $filename = md5($image->getClientOriginalName() . time()) . '.' . $ext;
                array_push($images, $filename);
                Storage::disk('public')->put($filename, File::get($image));
            }
        }
        return $images;
    }

}




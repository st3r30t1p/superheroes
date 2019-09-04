<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeroRequest;
use App\SuperHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SuperHeroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heros = SuperHero::paginate(2);

        return view('index', compact('heros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hero.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HeroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HeroRequest $request)
    {
        $images = [];
        if($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalExtension();
                $filename = md5($image->getClientOriginalName() . time()) . '.' . $ext;
                array_push($images, $filename);
                Storage::disk('public')->put($filename, File::get($image));
            }
        }
        $hero = new SuperHero([
           'nickname' => $request->nickname,
           'real_name' => $request->real_name,
            'origin_description' => $request->origin_description,
            'superpowers' => $request->superpowers,
            'catch_phrase' => $request->catch_phrase,
            'images' => implode(",", $images)
        ]);
        $hero->save();

       return redirect('/')->with('success', 'Hero added successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hero = SuperHero::find($id);

        return view('hero.show', compact('hero'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hero = SuperHero::find($id);
        return view('hero.edit', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $images = [];
        if($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalExtension();
                $filename = md5($image->getClientOriginalName() . time()) . '.' . $ext;
                array_push($images, $filename);
                Storage::disk('public')->put($filename, File::get($image));
            }
        }

        $hero = SuperHero::find($id);
        $hero->nickname = $request->nickname;
        $hero->real_name = $request->real_name;
        $hero->origin_description = $request->origin_description;
        $hero->superpowers = $request->superpowers;
        $hero->catch_phrase = $request->catch_phrase;
        $hero->images = implode(",", $images);
        $hero->save();

        return redirect()->back()->with('success', 'Hero edited successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hero = SuperHero::find($id);
        foreach($hero->images as $image) {
            Storage::disk('public')->delete(substr(strrchr($image, "/"), 1));
        }
        $hero->delete();
        return redirect('/')->with('success', 'Hero deleted successfuly!');
    }
}

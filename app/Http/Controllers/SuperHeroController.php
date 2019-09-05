<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeroRequest;
use App\Services\SuperHeroService;

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
        $heroes = SuperHeroService::getHeroes();
        return view('index', compact('heroes'));
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
        SuperHeroService::setHeroData($request);
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
        $hero = SuperHeroService::getHero($id);
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
        $hero = SuperHeroService::getHero($id);
        return view('hero.edit', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\HeroRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HeroRequest $request, $id)
    {
        try {
            SuperHeroService::updateHeroData($request, $id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
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
        try {
            SuperHeroService::deleteHeroData($id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return redirect('/')->with('success', 'Hero deleted successfuly!');
    }
}

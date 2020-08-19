<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\People;
use App\Planet;
use App\Species;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //Check if the people is empty
        $people = People::count();

        //Check if the people is empty
        $species = Species::count();

        //Check if the people is empty
        $planets = Planet::count();

        return view('home', array(
            'people' => $people,
            'species' => $species,
            'planets' => $planets
        ));
    }
}

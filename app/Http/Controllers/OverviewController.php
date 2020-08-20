<?php

namespace App\Http\Controllers;

use App\People;

/**
 * Class OverviewController
 * @package App\Http\Controllers
 */
class OverviewController extends Controller
{
    /**
     * Return all the data to the overview page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Get all the data, starting point is persons.
        $person = People::all();
        return view('layouts.overview.index')->with('overview', $person);
    }
}

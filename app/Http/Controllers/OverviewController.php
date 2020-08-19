<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\People;


class OverviewController extends Controller
{
    public function index()
    {
        // Get all the data, starting point is persons.
        $person = People::all();
        return view('layouts.overview.index')->with('overview', $person);
    }
}

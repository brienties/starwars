<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchPeopleController extends Controller
{
    public function searchPerson(Request $request)
    {

//        https://swapi.dev/api/people/?search=r2

        $result  = Http::get(env('API_URL') . 'people/?search=r2');

        print_r($result);
        die;

    }
}

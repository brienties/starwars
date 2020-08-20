<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchPeopleController extends Controller
{
    public function searchPerson(Request $request)
    {
        $result  = Http::get(env('API_URL') . 'people/?search='. $request->name);

        return $result->json();
    }
}

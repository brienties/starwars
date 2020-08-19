<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImportApiDataController extends Controller
{
    /**
     * Pull all the data in the request
     *
     * @param $endpoint
     * @param $page
     *
     * @return array|mixed
     */
    public function pullSummary($endpoint, $page)
    {
        //Function makes the http request and returns the response from the swapi per page
        $request  = Http::get(env('API_URL') . $endpoint . '/?page=' . $page);
        $response = $request->json();

        return $response;
    }

}

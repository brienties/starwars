<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

/**
 * Class ImportApiDataController
 * @package App\Http\Controllers
 */
class ImportApiDataController extends Controller
{
    /**
     * Pull all the data in the request and send it to the search api endpoint
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

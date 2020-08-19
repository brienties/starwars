<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImportApiDataController extends Controller
{
    /**
     * Pull all the data in the request
     *
     * @param $page
     *
     * @return array|mixed
     */
    protected function pullSummary($page)
    {
        //Function makes the http request and returns the response from the swapi per page
        $request  = Http::get(env('API_URL') . 'planets/?page=' . $page);
        $response = $request->json();

        return $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSpecies()
    {
        $response = $this->pullSummary(1);
        if(!empty($response))
        {
            $numPages = ceil($response['count'] / count($response['results']));
            $this->storeSpeciesData($response);

            for ($i = 2; $i <= $numPages; $i++)
            {            //start on 2, cause we already have fetched page 1
                $response = $this->pullSummary($i);   //other pages
                $this->storeSpeciesData($response);
            }
        }

        return redirect()->route('home');
    }
}

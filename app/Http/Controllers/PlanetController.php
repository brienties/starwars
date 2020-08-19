<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Planet;

class PlanetController extends Controller
{

//    /**
//     * @var \Illuminate\Http\Client\Response
//     */
//    private $response;
//
//    public function __construct()
//    {
//        $this->response = Http::get(env('API_URL') . 'planets');
//    }

    /**
     * Pull all the data in the request
     *
     * @param $page
     *
     * @return array|mixed
     */
    protected function pullPlanetSummary($page)
    {
        //Function makes the http request and returns the response from the swapi per page
        $request  = Http::get(env('API_URL') . 'planets/?page=' . $page);
        $response = $request->json();

        return $response;
    }

    /***
     * Stores the planet data in the database with the given pagenumber
     *
     * @param $response
     */
    public function storePlanetData($response)
    {
        collect($response['results'])->each(function ($currData) {


            $planet_id = (int) filter_var($currData['url'], FILTER_SANITIZE_NUMBER_INT);

            $data                  = Planet::query()->firstOrCreate(['planet_id' => $planet_id]);
            $data->planet_id       = $planet_id;
            $data->name            = $currData['name'];
            $data->diameter        = $currData['diameter'];
            $data->rotation_period = $currData['rotation_period'];
            $data->orbital_period  = $currData['orbital_period'];
            $data->gravity         = $currData['gravity'];
            $data->population      = $currData['population'];
            $data->climate         = $currData['climate'];
            $data->terrain         = $currData['terrain'];
            $data->url             = $currData['url'];

            $data->save();

        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePlanets()
    {
        $response = $this->pullPlanetSummary(1);

        if(!empty($response))
        {
            $numPages = ceil($response['count'] / count($response['results']));
            $this->storePlanetData($response);

            for ($i = 2; $i <= $numPages; $i++)
            {            //start on 2, cause we already have fetched page 1
                $response = $this->pullPlanetSummary($i);   //other pages
                $this->storePlanetData($response);
            }
        }

        return redirect()->route('home');
    }
}

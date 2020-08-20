<?php

namespace App\Http\Controllers;

use App\Planet;

class PlanetController extends Controller
{
    /**
     * @var \App\Http\Controllers\ImportApiDataController
     */
    public $importapidata;

    public function __construct()
    {
        $this->importapidata = new ImportApiDataController;
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
     * Activate the data pull and loop trough the pages
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePlanets()
    {
        $response = $this->importapidata->pullSummary('planets', 1);

        if ( ! empty($response))
        {
            $numPages = ceil($response['count'] / count($response['results']));
            $this->storePlanetData($response);

            for ($i = 2; $i <= $numPages; $i++)
            {            //start on 2, cause we already have fetched page 1
                $response = $response = $this->importapidata->pullSummary('planets', $i);   //other pages
                $this->storePlanetData($response);
            }
        }

        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Species;

class SpeciesController extends Controller
{
    /**
     * @var \App\Http\Controllers\ImportApiDataController
     */
    public $importapidata;

    public function __construct()
    {
        $this->importapidata = new ImportApiDataController();
    }

    /***
     * Stores the planet data in the database with the given pagenumber
     *
     * @param $response
     */
    public function storeSpeciesData($response)
    {

        collect($response['results'])->each(function ($currData) {

            $species_id = (int) filter_var($currData['url'], FILTER_SANITIZE_NUMBER_INT);
            $homeworld  = (int) filter_var(isset($currData['homeworld']) ? $currData['homeworld'] : null, FILTER_SANITIZE_NUMBER_INT);

            $data                   = Species::query()->firstOrCreate(['species_id' => $species_id]);
            $data->species_id       = $species_id;
            $data->name             = $currData['name'];
            $data->classification   = $currData['classification'];
            $data->designation      = $currData['designation'];
            $data->average_height   = $currData['average_height'];
            $data->average_lifespan = $currData['average_lifespan'];
            $data->eye_colors       = $currData['eye_colors'];
            $data->hair_colors      = $currData['hair_colors'];
            $data->skin_color       = $currData['skin_colors'];
            $data->language         = $currData['language'];
            $data->homeworld        = $homeworld;
            $data->url              = $currData['url'];

            $data->save();
        });
    }

    /**
     * Activate the data pull and loop trough the pages
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSpecies()
    {
        $response = $this->importapidata->pullSummary('species', 1);

        if ( ! empty($response))
        {
            $numPages = ceil($response['count'] / count($response['results']));
            $this->storeSpeciesData($response);

            for ($i = 2; $i <= $numPages; $i++)
            {            //start on 2, cause we already have fetched page 1
                $response = $response = $this->importapidata->pullSummary('species', $i);   //other pages
                $this->storeSpeciesData($response);
            }
        }

        return redirect()->route('home');
    }
}

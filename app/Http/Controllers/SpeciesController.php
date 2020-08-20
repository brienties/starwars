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
            $homeworld  = (int) filter_var($currData['homeworld'], FILTER_SANITIZE_NUMBER_INT);

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSpecies()
    {
        $response = $this->importapidata->pullSummary('species', 1);

        return redirect()->route('home');
    }
}

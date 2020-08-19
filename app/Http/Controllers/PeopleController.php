<?php

namespace App\Http\Controllers;

use App\People;

class PeopleController extends Controller
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
    public function storePeopleData($response)
    {
        collect($response['results'])->each(function ($currData) {


            $people_id = (int) filter_var($currData['url'], FILTER_SANITIZE_NUMBER_INT);
            $homeworld = (int) filter_var($currData['homeworld'], FILTER_SANITIZE_NUMBER_INT);

            $species_check = isset($currData['species'][0]) ? $currData['species'][0] : null;
            $species       = (int) filter_var($species_check, FILTER_SANITIZE_NUMBER_INT);

            $data             = People::query()->firstOrCreate(['people_id' => $people_id]);
            $data->people_id  = $people_id;
            $data->name       = $currData['name'];
            $data->birth_year = $currData['birth_year'];
            $data->eye_color  = $currData['eye_color'];
            $data->gender     = $currData['gender'];
            $data->hair_color = $currData['hair_color'];
            $data->height     = $currData['height'];
            $data->mass       = $currData['mass'];
            $data->skin_color = $currData['skin_color'];
            $data->homeworld  = $homeworld;
            $data->species    = $species;
            $data->url        = $currData['url'];

            $data->save();
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePeople()
    {
        $response = $this->importapidata->pullSummary('people', 1);
        if ( ! empty($response))
        {
            $numPages = ceil($response['count'] / count($response['results']));
            $this->storePeopleData($response);

            for ($i = 2; $i <= $numPages; $i++)
            {            //start on 2, cause we already have fetched page 1
                $response = $this->importapidata->pullSummary('people', $i);   //other pages
                $this->storePeopleData($response);
            }
        }

        return redirect()->route('home');
    }

}

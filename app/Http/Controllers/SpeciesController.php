<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Species;

class SpeciesController extends Controller
{

    /**
     * Pull all the data in the request
     *
     * @param $page
     *
     * @return array|mixed
     */
    protected function pullSpeciesSummary($page)
    {
        //Function makes the http request and returns the response from the swapi per page
        $request  = Http::get(env('API_URL') . 'species/?page=' . $page);
        $response = $request->json();

        return $response;
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
        $response = $this->pullSpeciesSummary(1);
        if(!empty($response))
        {
            $numPages = ceil($response['count'] / count($response['results']));
            $this->storeSpeciesData($response);

            for ($i = 2; $i <= $numPages; $i++)
            {            //start on 2, cause we already have fetched page 1
                $response = $this->pullSpeciesSummary($i);   //other pages
                $this->storeSpeciesData($response);
            }
        }

        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\People;

class PeopleController extends Controller
{
//    /**
//     * @var \Illuminate\Http\Client\PendingRequest
//     */
//    private $response;
//
//    public function __construct()
//    {
//        $this->response = Http::withOptions([
//            'base_uri' => env('API_URL'),
//        ]);
//    }

    /**
     * Pull all the data in the request
     *
     * @param $page
     *
     * @return array|mixed
     */
    protected function pullPeopleSummary($page)
    {
        //Function makes the http request and returns the response from the swapi per page
        $request  = Http::get(env('API_URL') . 'people/?page=' . $page);
        $response = $request->json();

        return $response;
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
        $response = $this->pullPeopleSummary(1);
        if(!empty($response))
        {
            $numPages = ceil($response['count'] / count($response['results']));
            $this->storePeopleData($response);

            for ($i = 2; $i <= $numPages; $i++)
            {            //start on 2, cause we already have fetched page 1
                $response = $this->pullPeopleSummary($i);   //other pages
                $this->storePeopleData($response);
            }
        }

        return redirect()->route('home');
    }

}

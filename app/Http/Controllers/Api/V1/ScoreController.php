<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Game;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\GameResource;
use App\Http\Resources\V1\GamesCollection;
use App\Http\Requests\V1\BulkStoreGameRequest;
use Illuminate\Http\Request;
use App\Http\Filters\V1\GamesFilter;
use Illuminate\Support\Arr;
use GuzzleHttp\Client;

class ScoreController extends Controller
{

   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new GamesFilter();
        $filterItems = $filter->transform($request);

        $games = Game::where($filterItems);

        return view('api.index', [
            'games' => $games->paginate()->appends($request->query())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function buildDatasFromSource(Request $request)
    {
        // Replace 'YOUR_API_KEY' with your OpenWeather API key
        $apiKey = '249139d0853c426db15d43f684e9089e';

        // Create a new Guzzle client instance
        $client = new Client();

        $date = $request->date ?? \Carbon\Carbon::now()->format('d.m.Y');
        // API endpoint URL with your desired date
        $apiUrl = "https://api.sportsdata.io/v3/nba/scores/json/ScoresBasic/{$date}?key={$apiKey}";

        try {
            // Make a GET request to the external API
            $response = $client->get($apiUrl);

            // Get the response body as an array

            $filter = new GamesFilter();
            $filterItems = $filter->transform($request);

            $games = Game::where($filterItems);
            
            if($games->count() == 0){
                $data = $this->bulkStore(json_decode($response->getBody(), true));
            }
            else{
                $data = $games->get();
            }
            
            // Handle the retrieved weather data as needed (e.g., pass it to a view)
            return view('api/scores', ['nbaDatas' => $data, 'selectedDate' => $date]);
        } catch (\Exception $e) {
            // Handle any errors that occur during the API request
            return view('api_error', ['error' => $e->getMessage()]);
        }
    
    }

    public function bulkStore($request)
    {
        $bulk = collect($request)->map(function ($arr, $key) {
            return Arr::only($arr, [
                'GameId',
                'Season',
                'Status',
                'DateTime',
                'AwayTeam',
                'HomeTeam',
                'AwayTeamID',
                'HomeTeamID',
                'AwayTeamScore',
                'HomeTeamScore',
                'Updated',
                'GameEndDateTime']);
        });

        Game::insert($bulk->toArray());
        return $bulk;
    }

}

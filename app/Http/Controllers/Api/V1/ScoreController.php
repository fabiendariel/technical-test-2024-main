<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Game;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\GameResource;
use App\Http\Resources\V1\GamesCollection;
use App\Http\Requests\V1\BulkStoreGameRequest;
use App\Providers\DataProviders\NbaDatasProvider;
use Illuminate\Http\Request;
use App\Http\Filters\V1\GamesFilter;
use App\Providers\DataProviders\Classes\NbaDatas;
use DateTime;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{

   public function __construct(protected NbaDatasProvider $nbaDatasProvider) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $games = Game::where('DateTime', new DateTime());

        return view('api.index', [
            'games' => $games->paginate()->appends($request->query())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function buildDatasFromSource(Request $request)
    {
        $date = $request->date ?? \Carbon\Carbon::now()->format('Y-m-d');
/*
        // Replace 'YOUR_API_KEY' with your OpenWeather API key
        $apiKey = '249139d0853c426db15d43f684e9089e';
        // API endpoint URL with your desired date
        $apiUrl = "https://api.sportsdata.io/v3/nba/scores/json/ScoresBasic/{$date}?key={$apiKey}";
*/
        try {
/*
            // Make a GET request to the external API
            $response = Http::get($apiUrl);
            if (!$response->successful()) {
                return Collection::make();
            }
            $data = $response->json();
*/
            // Check if datas already in database
            $games_db = Game::where('DateTime', date($date));
            
            if($games_db->count() === 0){
                //$games = $this->bulkStore($data);
                //If nothing we call the api to fill the DB
                $api_datas = $this->nbaDatasProvider->getNbaDatas($date);
                $this->bulkStore($api_datas);
                $games = $games_db->get(); 
            }
            else{
                //Elsewhere we get datas from the DB 
                $games = $games_db->get();                
            }           

            return view('api/scores', ['nbaDatas' => $games, 'selectedDate' => $date]);
        } catch (\Exception $e) {
            // Handle any errors that occur during the API request
            return view('api_error', ['error' => $e->getMessage()]);
        }
    
    }

    private function bulkStore($api_datas): void
    {
        DB::transaction(function () use ($api_datas) {
            $api_datas->each(function (NbaDatas $game) {
                try {
                    Game::upsert([
                        'GameID' => $game->GameID,
                        'Season' => $game->Season,
                        'Status' => $game->Status,
                        'DateTime' => $game->DateTime->format('Y-m-d'),
                        'AwayTeam' => $game->AwayTeam,
                        'HomeTeam' => $game->HomeTeam,
                        'AwayTeamID' => $game->AwayTeamID,
                        'HomeTeamID' => $game->HomeTeamID,
                        'AwayTeamScore' => $game->AwayTeamScore,
                        'HomeTeamScore' => $game->HomeTeamScore,
                        'Updated' => $game->Updated,
                        'GameEndDateTime' => $game->GameEndDateTime,
                    ], uniqueBy: ['GameID'], update: ['Status', 'HomeTeamScore', 'AwayTeamScore']);
                } catch (\Exception $e) {
                    // Handle any errors that occur during the API request                    
                    return view('api_error', ['error' => $e->getMessage()]);
                }
            });
        });
        /*$bulk = collect($data)->map(function ($arr, $key) {
            
            $dateTime = new DateTime($arr['DateTime']);
            $arr['DateTime'] = $dateTime->format('Y-m-d');
            
            return Arr::only($arr, [
                'GameID',
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
        $list = $data->toArray();
        Game::upsert($list,['GameID']);
        return $list;*/
    }

}

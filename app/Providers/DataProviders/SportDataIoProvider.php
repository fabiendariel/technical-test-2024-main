<?php

namespace App\Providers\DataProviders;

use App\Providers\DataProviders\Classes\NbaDatas;
use App\Models\Provider;
use DateTime;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SportDataIoProvider implements NbaDatasProvider
{
    public function getNbaDatas($dateofdays): Collection
    {
        $url = config('external-api.sportdataio.base_url') . 'nba/scores/json/ScoresBasic/';
        $url .= "$dateofdays?key=249139d0853c426db15d43f684e9089e";
        
        return $this->doRequest($url);
    }
  
    public function doRequest(string $url): Collection
    {
        try {
            $response = Http::get($url);
            if (!$response->successful()) {
                return Collection::make();
            }
            $data = $response->json();

            return collect($data)
                ->map(function ($game) {
                    $game['GameEndDateTime'] = new DateTime($game['GameEndDateTime']);
                    $game['DateTime'] = new DateTime($game['DateTime']);
                    $game['Updated'] = new DateTime($game['Updated']);
                    return new NbaDatas(
                      GameEndDateTime: $game['GameEndDateTime'],
                      GameID: intval(
                        $game['GameID']),
                      Season: intval(
                        $game['Season']),
                      Status: $game['Status'],
                      DateTime: $game['DateTime'],
                      AwayTeam: $game['AwayTeam'],
                      HomeTeam: $game['HomeTeam'],
                      AwayTeamID: intval(
                        $game['AwayTeamID']),
                      HomeTeamID: intval(
                        $game['HomeTeamID']),
                      AwayTeamScore: intval($game['AwayTeamScore']),
                      HomeTeamScore: intval(
                        $game['HomeTeamScore']),
                      Updated: $game['Updated'],
                    );
                });
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return Collection::make();
        }
    }
}
<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'GameId' => $this->id,
            'Season' => $this->season,
            'Status' => $this->status,
            'DateTime' => $this->datetime,
            'AwayTeam' => $this->away_team,
            'HomeTeam' => $this->home_team,
            'AwayTeamID' => $this->away_team_id,
            'HomeTeamID' => $this->home_team_id,
            'AwayTeamScore' => $this->away_team_score,
            'HomeTeamScore' => $this->home_team_score,
            'Updated' => $this->updated_at,
            'GameEndDateTime' => $this->game_end_datetime,
        ];
    }
}

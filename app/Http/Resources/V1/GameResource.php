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
            'GameId' => $this->GameId,
            'Season' => $this->Season,
            'Status' => $this->Status,
            'DateTime' => $this->DateTime->format('Y-m-d'),
            'AwayTeam' => $this->AwayTeam,
            'HomeTeam' => $this->HomeTeam,
            'AwayTeamID' => $this->AwayTeamID,
            'HomeTeamID' => $this->HomeTeamID,
            'AwayTeamScore' => $this->AwayTeamScore,
            'HomeTeamScore' => $this->HomeTeamScore,
            'Updated' => $this->Updated,
            'GameEndDateTime' => $this->GameEndDateTime,
        ];
    }
}

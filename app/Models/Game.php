<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'GameEndDateTime',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    protected $fillable = [
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
        'GameEndDateTime',
    ];
}

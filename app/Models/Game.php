<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'season',
        'status',
        'datetime',
        'away_team',
        'home_team',
        'away_team_id',
        'home_team_id',
        'away_team_score',
        'home_team_score',
        'updated_at',
        'game_end_datetime',
    ];
}

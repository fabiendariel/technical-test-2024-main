<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->dateTime('game_end_datetime');
            $table->integer('season');
            $table->string('status');
            $table->string('away_team');
            $table->string('home_team');
            $table->integer('away_team_id ');
            $table->integer('home_team_id');
            $table->integer('away_team_score ');
            $table->integer('home_team_score');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};

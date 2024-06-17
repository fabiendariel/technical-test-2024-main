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
            $table->id('GameId');
            $table->dateTime('GameEndDateTime');
            $table->dateTime('DateTime');
            $table->integer('Season');
            $table->string('Status');
            $table->string('AwayTeam');
            $table->string('HomeTeam');
            $table->integer('AwayTeamID');
            $table->integer('HomeTeamID');
            $table->integer('AwayTeamScore');
            $table->integer('HomeTeamScore');
            $table->dateTime('Updated');
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

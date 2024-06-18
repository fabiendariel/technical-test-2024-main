<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('GameID');
            $table->dateTime('GameEndDateTime');
            $table->date('DateTime');
            $table->integer('Season');
            $table->string('Status');
            $table->string('AwayTeam');
            $table->string('HomeTeam');
            $table->integer('AwayTeamID');
            $table->integer('HomeTeamID');
            $table->integer('AwayTeamScore');
            $table->integer('HomeTeamScore');
            $table->dateTime('Updated');
            $table->unique('GameID');
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

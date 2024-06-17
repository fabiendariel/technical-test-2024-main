<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Game;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\GameResource;
use App\Http\Resources\V1\GamesCollection;
use App\Http\Requests\V1\BulkStoreGameRequest;
use Illuminate\Http\Request;
use App\Http\Filters\V1\GamesFilter;
use Illuminate\Support\Arr;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new GamesFilter();
        $filterItems = $filter->transform($request);

        $games = Game::where($filterItems);

        return new GamesCollection(
            $games->paginate()->appends($request->query())
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return new GameResource($game);
    }

    public function bulkStore(BulkStoreGameRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, [
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
                'GameEndDateTime']);
        });

        Game::insert($bulk->toArray());
    }

}

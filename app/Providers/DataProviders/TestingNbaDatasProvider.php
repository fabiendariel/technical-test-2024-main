<?php

namespace App\Providers\DataProviders;

use App\Providers\DataProviders\Classes\NbaDatas;
use DateTime;
use Illuminate\Support\Collection;

class TestingNbaDatasProvider implements NbaDatasProvider
{
  public function getNbaDatas($dateofday): Collection
  {
    $games = Collection::make();
    $games->add(new NbaDatas(
      GameEndDateTime: new DateTime('2024-05-02T00:27:34'),
      GameID: 20880,
      Season: 2024,
      Status: "Final ",
      DateTime: new DateTime('2024-05-01T22:00:00'),
      AwayTeam: "DAL",
      HomeTeam: "LAC",
      AwayTeamID: 25,
      HomeTeamID: 28,
      AwayTeamScore: 123,
      HomeTeamScore: 93,
      Updated: new DateTime('2024-05-02T00:43:33'),
    ));

    return $games;
  }

}

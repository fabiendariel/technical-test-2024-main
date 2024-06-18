<?php

namespace App\Providers\DataProviders\Classes;

use DateTime;

class NbaDatas
{
  public function __construct(
    public DateTime $GameEndDateTime,
    public int $GameID,
    public int $Season,
    public string $Status,
    public DateTime $DateTime,
    public string $AwayTeam,
    public string $HomeTeam,
    public int $AwayTeamID,
    public int $HomeTeamID,
    public int $AwayTeamScore,
    public int $HomeTeamScore,
    public DateTime $Updated,
  ) {
  }
}

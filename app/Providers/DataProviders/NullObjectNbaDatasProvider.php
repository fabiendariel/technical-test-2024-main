<?php

namespace App\Providers\DataProviders;

use Illuminate\Support\Collection;

class NullObjectNbaDatasProvider implements NbaDatasProvider
{
  public function getNbaDatas($dateofday): Collection
  {
    return Collection::make();
  }
}

<?php

namespace App\Providers\DataProviders;

use Illuminate\Support\Collection;

interface NbaDatasProvider
{
  public function getNbaDatas($dateofday): Collection;
}

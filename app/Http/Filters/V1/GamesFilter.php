<?php

namespace App\Http\Filters\V1;

use Illuminate\Http\Request;
use App\Http\Filters\ApiFilter;

class GamesFilter extends ApiFilter
{

  protected $allowedParams = [
    'GameEndDateTime' => ['eq'],
  ];

  protected $columnMap = [
    'GameEndDateTime' => 'game_end_datetime'
  ];

  protected $operatorMap = [
    'eq' => '=',
    'lt' => '<',
    'lte' => '<=',
    'gt' => '>',
    'gte' => '>='
  ];
}

<?php

namespace App\Http\Filters\V1;

use Illuminate\Http\Request;
use App\Http\Filters\ApiFilter;

class GamesFilter extends ApiFilter
{

  protected $allowedParams = [
    'date' => ['eq'],
  ];

  protected $columnMap = [
    'date' => 'DateTime'
  ];

  protected $operatorMap = [
    'eq' => '=',
    'lt' => '<',
    'lte' => '<=',
    'gt' => '>',
    'gte' => '>='
  ];
}

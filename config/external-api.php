<?php

return [
  'nbaDatasProvider' => env('NBA_DATAS_PROVIDER', 'sportdataio'), // 'sportdataio', 'testing'
  'sportdataio' => [
    'base_url' => 'https://api.sportsdata.io/v3/',
  ],
];

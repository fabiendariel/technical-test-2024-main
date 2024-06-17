<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ScoreController;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/api_error', function () {
  return view('api_error');
})->name('api_error');

Route::get('/scores', [ScoreController::class, 'buildDatasFromSource'])->name('scores');
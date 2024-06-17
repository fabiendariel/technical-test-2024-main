@extends('base')

@section('title','Game List')

@section('content')

  <h1>Game List for {{ $selectedDate }}</h1>
  @foreach ($nbaDatas as $game)
    <div>
      <h2>{{ $game->GameEndDateTime }}</h2>
      
      <div class="d-flex flex-row bd-highlight mb-3 fw-bold">
        <div class="p-2 bd-highlight">{{ $game['HomeTeam'] }}</div>
        <div class="p-2 bd-highlight">{{ $game['HomeTeamScore'] }}</div>
        <div class="p-2 bd-highlight">{{ $game['Status'] }}</div>
      </div>
      <div class="d-flex flex-row bd-highlight mb-3">
        <div class="p-2 bd-highlight">{{ $game['AwayTeam'] }}</div>
        <div class="p-2 bd-highlight">{{ $game['AwayTeamScore'] }}</div>
        <div class="p-2 bd-highlight"></div>
      </div>
    </div>    
  @endforeach

  
@endsection
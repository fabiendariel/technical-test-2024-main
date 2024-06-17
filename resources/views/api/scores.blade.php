@extends('base')

@section('title','Game List')

@section('content')

  <div class="container">
    
      @foreach ($nbaDatas as $game)
      <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
        <h3>{{ date_format(new DateTime($game['GameEndDateTime']),'D, F d') }}</h3>
        @php
          $bold_home = $bold_away = '';
          if($game['HomeTeamScore'] > $game['AwayTeamScore']){
            $bold_home = 'fw-bold';
          }
          else {
            $bold_away = 'fw-bold';
          }
        @endphp
        
        <div class="d-flex flex-row bd-highlight mb-3 {{ $bold_home }}">
          <div class="p-2 bd-highlight">{{ $game['HomeTeam'] }}</div>
          <div class="p-2 bd-highlight">{{ $game['HomeTeamScore'] }}</div>
          <div class="p-2 bd-highlight">{{ $game['Status'] }}</div>
        </div>
        <div class="d-flex flex-row bd-highlight mb-3 {{ $bold_away }}">
          <div class="p-2 bd-highlight">{{ $game['AwayTeam'] }}</div>
          <div class="p-2 bd-highlight">{{ $game['AwayTeamScore'] }}</div>
          <div class="p-2 bd-highlight"></div>
        </div>
          </div>
      @endforeach
    
  </div>   
  
@endsection
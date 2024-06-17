<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity= <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
    @layer: demo {
      button {
        all:unset;
      }
    }
  </style>
</head> 
<body>
  @php
    $route = request()->route()->getName();
    $startDT = new DateTime($selectedDate);
    $startDT->sub(new DateInterval('P5D'));
    
    $period = new DatePeriod(
      $startDT,
      new DateInterval('P1D'),
      10
    );
    
  @endphp
  <div class="container">
    <header class="py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          
        </div>
        <div class="col-4 text-center">
          <h1>NBA Score History</h1>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          
        </div>
      </div>
    </header>
    <nav aria-label="...">
      <ul class="pagination pagination-lg">
        @foreach($period as $key => $value)
          <li class="page-item" aria-current="page">
            <a class="page-link" href="{{ route('scores', ['date' => $value->format('Y-m-d')]) }}">{{ $value->format('F d Y') }}</a>
          </li>
        @endforeach
      </ul>
    </nav>
  </div>
                      
                   
  
  <div class="container">
    @if (@session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>    
    @endif
    @yield('content')
  </div>
</body>
</html>
@extends('base')

@section('title','Game List')

@section('content')

  <h1>Game List for {{ $weatherData['name'] }}</h1>
      <p>Description: {{ $weatherData['weather'][0]['description'] }}</p>
      <p>Temperature: {{ $weatherData['main']['temp'] }} &#8451;</p>
      <!-- Additional weather data can be displayed as per the API response -->
  </body>
  </html>
  @foreach ($posts as  $post)
    <article>
      <h2>{{ $post->title }}</h2>
      <p class="small">
      @if ($post->category)        
        <span class="badge bg-info">{{ $post->category?->name }}</span>
      @endif 
      @if (!$post->tags->isEmpty())        
        @foreach ($post->tags as $tag)
        <span class="badge bg-secondary">{{ $tag->name }}</span>          
        @endforeach        
      @endif           
      </p>
      <p>{{ $post->content }}</p>
      <p class="small">
          
      </p>
      <p>
        <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post]) }}" class="btn btn-primary">Lire la suite</a>
      </p>
    </article>
    
  @endforeach

  {{ $posts->links() }}
  
@endsection
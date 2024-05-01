<!-- resources/views/components/breadcrumb.blade.php -->
@props(['breads'])
<div class="pagetitle">
  <h1>{{ $breads[0]['title'] }}</h1>
  <nav>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Home</a></li>
          @foreach ($breads as $bread)
             @if ($loop->first)
                  {{-- This is the first iteration --}}
                  @continue
              @endif
              @if ($loop->last)
                  <li class="breadcrumb-item active">{{ $bread['text'] }}</li>
              @else
                  <li class="breadcrumb-item"><a href="{{ $bread['url'] }}">{{ $bread['text'] }}</a></li>
              @endif
          @endforeach
      </ol>
  </nav>
</div>

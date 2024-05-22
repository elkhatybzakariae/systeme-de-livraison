<!-- resources/views/components/breadcrumb.blade.php -->
@props(['breads'])

<nav>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        @foreach ($breads as $bread)
            @if (!$loop->first)
                @if ($loop->last)
                    <li class="breadcrumb-item active">{{ $bread['text'] }}</li>
                @else
                    <li class="breadcrumb-item">{{ $bread['text'] }}</li>
                @endif
            @endif
        @endforeach
    </ul>
</nav>

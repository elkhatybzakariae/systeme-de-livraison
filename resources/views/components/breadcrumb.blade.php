<!-- resources/views/components/breadcrumb.blade.php -->
@props(['breads'])

<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ $breads[0]['title'] }}</h1>
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
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!-- Add your other actions/buttons here -->
        </div>
    </div>
</div>

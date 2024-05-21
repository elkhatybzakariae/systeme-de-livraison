@extends('layouts.admin.admin')
@section('breads')
<x-breadcrumb :breads="$breads" />

@endsection
@section('content')
<style>
  table{
    color: #14a1f3
  }
</style>
<div class="container">
  <div class="row">
    @foreach ($colisStatus as $item )
      
    <div class="col-md-3 mb-4">
      <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
        <div class="card-body d-flex justify-content-between align-items">
            <span class="svg-icon fs-1">
              <svg xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                  <path fill="#87b6fc"
                      d="M50.7 58.5L0 160H208V32H93.7C75.5 32 58.9 42.3 50.7 58.5zM240 160H448L397.3 58.5C389.1 42.3 372.5 32 354.3 32H240V160zm208 32H0V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192z" />
              </svg>
            </span>
    
            <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                <div class="d-flex flex-column">
                  <span class="me-2">{{ $item->status }}</span>
                  <span class="me-2 text-end">{{ $item->total }}</span>
                </div>
            </span>
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>


@endsection


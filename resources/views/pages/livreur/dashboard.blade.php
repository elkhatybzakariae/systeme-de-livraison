@extends('layouts.livreur.admin')
@section('breads')
<x-breadcrumb :breads="$breads" />
@foreach ($remarques as $remarque )
  
  <div class="alert @if ($remarque->type=='Urgence')
    alert-danger
    @elseif ($remarque->type=='Important')
      alert-warning
    @elseif ($remarque->type=='Information')
      alert-primary
    @endif  
    alert-dismissible fade show" role="alert">
    <strong>{{ $remarque->type }}</strong> {{ $remarque->remarque }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endforeach
@endsection
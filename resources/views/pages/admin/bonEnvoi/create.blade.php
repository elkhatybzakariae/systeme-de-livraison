@extends('layouts.client.admin')
@section('breads')
<x-breadcrumb :breads="$breads" />

@endsection
@section('content')
<div class="card">
  <div class="card-header">
      <h5>Ajouter Bon de livraison<!--5-->
  </h5></div>

  <div class="card-body">

  </div>

  <div class="card-footer">
      
<a class="btn btn-primary" style="display:block;margin:0px auto" href="{{ route('bon.livraison.index') }}"><i class="fa fa-plus"></i> Creer bon de livraison</a>
    
  </div>

</div>
@endsection
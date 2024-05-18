@extends('layouts.admin.admin')
@section('breads')
    <x-breadcrumb :breads="$breads" />
@endsection
@section('content')
    <form action="{{ route('bon.distribution.index') }}">
        <div class="card">
            <div class="card-header">
                <h5>Ajouter Bon de distribution </h5>
            </div>

            <div class="card-body">
                <select name="zone" id="zone_select" class="form-select">
                    <option value="" selected disabled>Choisir une zone</option>
                    @foreach ($clients as $item)
                        @if ($item->colis_count >= 1)
                            <option value="{{ $item->id_Cl }}">{{ $item->nomcomplet }} ({{ $item->colis_count }} Colis Recu)
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card" id="cardLiv" style="display: none">

           
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" style="display:block;margin:0px auto"><i
                        class="fa fa-plus"></i> Creer bon de distribution</button>
            </div>


        </div>
    </form>
  
@endsection

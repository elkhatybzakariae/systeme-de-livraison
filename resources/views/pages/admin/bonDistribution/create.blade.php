@extends('layouts.admin.admin')
@section('breads')
<x-breadcrumb :breads="$breads" />

@endsection
@section('content')
<form action="{{ route('bon.envoi.index') }}">
  <div class="card">
    <div class="card-header">
      <h5>Ajouter Bon d'envoi </h5>
    </div>
    
    <div class="card-body">
        <select name="zone" id="zone_select" class="form-select" >
          <option value="" selected disabled>Choisir une zone</option>
          @foreach ($zones as $item )
            <option value="{{ $item->id_Z }}">{{ $item->zonename }} ({{ $item->colis_count }} Colis Recu)</option>
          @endforeach
        </select>
    </div>
  </div>
  <div class="card" style="display: none">
    <div class="card-header">
      <h5>Ajouter Bon d'envoi </h5>
    </div>
    <div class="card-body">
        <select name="id_Liv" id="id_Liv" class="form-select" >
          @foreach ($zones as $item )
            <option value="{{ $item->id_Z }}">{{ $item->zonename }} ({{ $item->colis_count }})</option>
          @endforeach
        </select>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary" style="display:block;margin:0px auto"><i class="fa fa-plus"></i> Creer bon de'envoi</button>
    </div>
    
    
  </div>
</form>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      const zoneSelect = document.getElementById('zone_select');
      const liv = document.getElementById('id_Liv');
      var zones = @json($zones);
      zoneSelect.addEventListener('change', function() {
          // Get the selected zone ID
          const selectedZoneId = this.value;
          let data= zones.find(ele=>ele.id_Z==selectedZoneId).livreurs
          console.log(data);
          
          liv.innerHTML = '';
                  data.forEach(city => {
                      const option = document.createElement('option');
                      option.value = city.id_Liv;
                      option.textContent = city.nomComplet;
                      liv.appendChild(option);
                  });
  });
  });
</script>
@endsection
@extends('layouts.client.admin')
@section('content')
 
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5><b>Date de creation:</b> {{ $bonLivraison->created_at }}</h5>
                </div>
            </div>
        </div>
    </div>
  </div>

<div class="container-fluid mt-4">
  <div class="card">
    <div class="card-header">
        <h5><b>List des nouveaux colis</b></h5>
    </div>
    <div class="card-body">
      <table  class="table table-striped    dataTable " >
        <thead>
          <tr role="row">
            <th >
              <input type="checkbox" >
            </th>
            <th >Code d envoi</th>
            <th >Destinataire</th>
            <th >Date de creation</th>
            <th >Prix</th>
            <th >Ville</th>
            <th >Actions</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($colis as $item )
          <tr id="new-parcel-Autedelenitidelect" role="row" class="odd">
            <td><input class="table-add-checkbox" type="checkbox" ></td>
            <td><b>{{ $item->code_d_envoi }}</b></td>
            <td>{{ $item->destinataire }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->prix }}</td>
            <td>{{ $item->ville->villename }}</td>
            <td>
              <a href="" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
    <div class="card-footer">  
      <div class="text-right float-end">
      <a class="btn btn-primary" ><i class="fa fa-plus"></i> Ajouter</a>
        </div>
    </div>
  </div>
</div>

<div class="container-fluid mt-4">
  <div class="card">
    <div class="card-header">
      <h5><b>List des colis ajoutes</b></h5>
    </div>
    <div class="card-body">
      <table class="table table-striped dataTable" >
        <thead>
          <tr role="row">
            <th >Code d envoi</th>
            <th>Destinataire</th>
            <th>Date de creation</th>
            <th >Prix</th>
            <th >Ville</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($colis as $item )
            {{-- <tr id="new-parcel-Autedelenitidelect" role="row" class="odd">
              <td><b>{{ $item->code_d_envoi }}</b></td>
              <td>{{ $item->destinataire }}</td>
              <td>{{ $item->created_at }}</td>
              <td>{{ $item->prix }}</td>
              <td>{{ $item->ville->villename }}</td>
              <td>
                <a href="" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
              </td>
            </tr> --}}
          @endforeach
        </tbody>
      </table>
    </div>
   </div>
</div>

<div class="container-fluid mt-4">
  <div class="card">
    <div class="card-header">
      <h5><b>Tickets Et Bon De Livraison</b></h5>
    </div>
    <div class="card-body">
      <h4 class="text-center">Obtenir en pdf</h4>
      <div class="row ">
        <div class="col-6 mb-2">
          <a class="btn btn-block btn-primary w-100" target="_blank" href=""><i class="fa fa-ticket"></i></a>
        </div>

        <div class="col-6">
          <a class="btn btn-block btn-primary w-100" target="_blank" href=""><i class="fa fa-ticket"></i> Etiqueteuse</a>

        </div>
        <div class="col-6">
          <a class="btn btn-block btn-secondary w-100" target="_blank" href="pdf-delivery-note?dn-ref=BL-030524-016160-25-264"><i class="fa fa-clipboard"></i></a>
        </div>
      </div>

    </div>

  </div>
</div> 
</div>
@endsection
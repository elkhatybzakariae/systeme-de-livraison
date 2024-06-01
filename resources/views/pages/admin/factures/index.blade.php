@extends('layouts.admin.admin')
@section('breads')
<x-breadcrumb :breads="$breads" />

@endsection
@section('content')
 
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><b>Date de creation:</b> {{ $bonLivraison->created_at }}</h5>
                </div>
            </div>
        </div>
    </div>
  </div>

<div class="container-fluid mt-4">
  <form action="{{ route('factures.update.all',$bonLivraison->id_F) }}" method="POST">
  @csrf
  <div class="card">
    <div class="card-header">
      <h5 class="card-title"><b>List des nouveaux colis</b></h5>
    </div>
    <div class="card-body">
      
      <table  class="table table-striped    dataTable " >
        <thead>
          <tr role="row">
            <th >
              <input type="checkbox" id="checkAll">
            </th>
            <th >Code d'envoi</th>
            <th >Destinataire</th>
            <th >Date de creation</th>
            <th >Prix</th>
            <th >Ville</th>
            <th >Actions</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($colis as $i=>$item )
          <tr id="new-parcel-Autedelenitidelect" role="row" class="odd">
            <td><input class="table-add-checkbox" name="colis[{{ $i }}]" value="{{ $item->id }}" type="checkbox" ></td>
            <td><b>{{ $item->code_d_envoi }}</b></td>
            <td>{{ $item->destinataire }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->prix }}</td>
            <td>{{ $item->villename }}</td>
            <td>
              
              <a href="{{ route('factures.update',['id'=>$item->id,'id_F'=>$bonLivraison->id_F]) }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
    <<div class="card-footer row">  
      <div class="search-bar col-8">
       
          <input type="text" id="query" class="form-control"   name="query" placeholder="Click Ici avant de scanner le barcode " 
          title="Enter search keyword" autocomplete="off">
       
      </div>
      <div class="col-4 ">
        <div class="text-right float-end">

          <button type="submit" id="btnSubmit
          " class="btn btn-primary" ><i class="fa fa-plus"></i> Ajouter</button>
        </div>
      </div>
    </div>
  </div>
</form>
</div>

<div class="container-fluid mt-4">
  <form action="{{ route('factures.updateDelete.all',$bonLivraison->id_F) }}" method="POST">
  @csrf
  <div class="card">
    <div class="card-header">
      <h5 class="card-title"><b>List des colis ajoutes</b></h5>
    </div>
    <div class="card-body">
      <table class="table table-striped dataTable" >
        <thead>
          <tr role="row">
            <td>

              <input type="checkbox" id="checkDeleteAll">
            </td>
            
            <th >Code d envoi</th>
            <th>Destinataire</th>
            <th>Date de creation</th>
            <th >Prix</th>
            <th >Ville</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          {{-- @dd($bonLivraison->colis) --}}
          @foreach ($colisBon as $i=>$item )
            <tr id="new-parcel-Autedelenitidelect" role="row" class="odd">
            <td><input class="table-delete-checkbox" name="colisDelete[{{ $i }}]" value="{{ $item->id }}" type="checkbox" ></td>

              <td><b>{{ $item->code_d_envoi }}</b></td>
              <td>{{ $item->destinataire }}</td>
              <td>{{ $item->created_at }}</td>
              <td>{{ $item->prix }}</td>
              <td>{{ $item->villename }}</td>
              <td>
                <a href="{{ route('factures.updateDelete',['id'=>$item->id,'id_F'=>$bonLivraison->id_F]) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer row"> 
      <div class="search-bar col-8">
       
        <input type="text" id="query" class="form-control"   name="query" placeholder="Click Ici avant de scanner le barcode " 
        title="Enter search keyword" autocomplete="off">
      
      </div>
      <div class="col-4 ">
        <div class="text-right float-end">

          <button type="submit" id="btnSubmit
          " class="btn btn-danger" ><i class="fa fa-times"></i> annuler</button>
        </div>
      </div>
    </div>
  </div>
</form>
</div>
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h5><b>Autres frais</b><!--5-->
              </h5></div>

              <div class="card-body">
                  
                <div class="text-right">
                <a class="btn btn-info" id="invoice-add-extra" href="javascript:;"><i class="fa fa-plus"></i> Ajouter</a>
                </div>
                <br>
    

      <div class="row"><div class="col-xs-12 col-sm-12">
        <table id="inv_extra_fees_table" data-ref="FCT-170524-07430-81-236" class="table table-striped table-bordered table-sm mb-0 dataTable no-footer" role="grid" aria-describedby="inv_extra_fees_table_info">
          <thead>
            <tr role="row"><th class="sorting" tabindex="0" aria-controls="inv_extra_fees_table" rowspan="1" colspan="1" aria-label="Designation: activate to sort column ascending" style="width: 205.859px;">Designation</th><th class="sorting" tabindex="0" aria-controls="inv_extra_fees_table" rowspan="1" colspan="1" aria-label="Quantite: activate to sort column ascending" style="width: 163.469px;">Quantite</th><th class="sorting" tabindex="0" aria-controls="inv_extra_fees_table" rowspan="1" colspan="1" aria-label="Prix unitaire: activate to sort column ascending" style="width: 213.156px;">Prix unitaire</th><th class="sorting" tabindex="0" aria-controls="inv_extra_fees_table" rowspan="1" colspan="1" aria-label="Total: activate to sort column ascending" style="width: 108.625px;">Total</th><th class="sorting" tabindex="0" aria-controls="inv_extra_fees_table" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 140.906px;">Actions</th></tr>
          </thead>
          <tbody>


<tr id="extra-fees-113" role="row" class="odd">
  <td>gggggg</td>
  <td>1</td>
  <td>22 Dhs</td>
  <td>22 Dhs</td>
  <td><a href="javascript:ajaxLink('invoices?action=remove-extra&amp;inv-ref=FCT-170524-07430-81-236&amp;extra-id=113')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>
</tr><tr role="row" id="extra-fees-114" class="even"><td>jlksf</td><td>1</td><td>4 Dhs</td><td>4 Dhs</td><td><a href="javascript:ajaxLink('invoices?action=remove-extra&amp;inv-ref=FCT-170524-07430-81-236&amp;extra-id=114')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td></tr></tbody>
</table></div>
</div>
<div class="row"><div class="col-xs-12 col-sm-12 col-md-5">
  <div class="dataTables_info" id="inv_extra_fees_table_info" role="status" aria-live="polite">Affichage 1 a 2 de 2 entrees
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="inv_extra_fees_table_paginate">
    <ul class="pagination">
      <li class="paginate_button page-item previous disabled" id="inv_extra_fees_table_previous">
      <a href="#" aria-controls="inv_extra_fees_table" data-dt-idx="0" tabindex="0" class="page-link">Precedent</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="inv_extra_fees_table" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="inv_extra_fees_table_next"><a href="#" aria-controls="inv_extra_fees_table" data-dt-idx="2" tabindex="0" class="page-link">Suivant</a></li></ul></div></div></div></div>

              </div>

          </div>
      </div>
  </div>
</div>

<script>
  // JavaScript code to handle checkbox click event
  document.addEventListener('DOMContentLoaded', function () {
      const checkAll = document.getElementById('checkAll');
      const checkboxes = document.querySelectorAll('.table-add-checkbox');

      checkAll.addEventListener('change', function () {
          checkboxes.forEach(checkbox => {
              checkbox.checked = checkAll.checked;
          });
      });

      const btnSubmit = document.getElementById('btnSubmit');
      btnSubmit.addEventListener('click', function () {
          const checkedIds = [];
          checkboxes.forEach(checkbox => {
              if (checkbox.checked) {
                  checkedIds.push(checkbox.value);
              }
          });

      });
  });
  document.addEventListener('DOMContentLoaded', function () {
      const checkAll = document.getElementById('checkDeleteAll');
      const checkboxes = document.querySelectorAll('.table-delete-checkbox');

      checkAll.addEventListener('change', function () {
          checkboxes.forEach(checkbox => {
              checkbox.checked = checkAll.checked;
          });
      });

      const btnSubmit = document.getElementById('btnSubmit');
      btnSubmit.addEventListener('click', function () {
          const checkedIds = [];
          checkboxes.forEach(checkbox => {
              if (checkbox.checked) {
                  checkedIds.push(checkbox.value);
              }
          });

      });
  });
</script>
@endsection
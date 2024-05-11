@extends('layouts.admin.admin')
@section('breads')
<x-breadcrumb :breads="$breads" />

@endsection
@section('content')

<!-- Modal -->
<div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
  <!-- Modal content -->
</div>

<div class="card card-flush">
  <div class="card-header align-items-center py-5 gap-2 gap-md-5">
    <div class="card-title">
      <!-- Search and filter options -->
      <div class="d-flex align-items-center position-relative my-1">
        <span class="svg-icon svg-icon-1 position-absolute ms-4">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
          </svg>
        </span>
        <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Product" />
      </div>
    </div>
    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
      <div class="w-100 mw-150px">
        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-product-filter="status">
          <option></option>
          <option value="all">All</option>
          <option value="1">Active</option>
          <option value="0">Inactive</option>
        </select>
      </div>
      <a href="{{ route('bon.payment.livreur.create') }}" class="btn btn-primary" >Ajouter  Bon Payment</a>
    </div>
  </div>

  <div class="card-body pt-0">
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
      <thead>
        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
          
          <th class="min-w-200px">reference</th>
          <th class="min-w-70px">Zone</th>
          <th class="min-w-100px">Livreurs</th>
          <th class="min-w-100px">Date de creation</th>
          <th class="min-w-100px">statut</th>
          <th class="min-w-100px">colis</th>
          <th class="min-w-70px">Actions</th>
        </tr>
      </thead>
      <tbody class="fw-semibold text-gray-600">
        @foreach ($bons as $index=>$item)
          <tr>
            <td>
              <div class="">
                <div class="ms-5">
                  <a href="" class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $item->reference }}</a>
                </div>
              </div>
            </td>
            <td class="pe-0">
              <span class="fw-bold" data-kt-ecommerce-product-filter="prix">{{ $item->zone }}</span>
            </td>
            <td class="pe-0">
              <span class="fw-bold" data-kt-ecommerce-product-filter="code">{{ $item->liv_nomcomplet }}</span>
            </td>
            <td class="pe-0">
              <span class="fw-bold" data-kt-ecommerce-product-filter="date">{{ $item->created_at }}</span>
            </td>
            
            <td class="pe-0">
              <span class="fw-bold" data-kt-ecommerce-product-filter="status">{{ $item->status }}</span>
            </td>
            <td class="pe-0">
              <span class="fw-bold" data-kt-ecommerce-product-filter="ville">{{ $item->colis_count}}</span>
            </td>
           
            <td>
              <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                <span class="svg-icon svg-icon-5 m-0">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                  </svg>
                </span>
              </a>
              <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-250px py-4" data-kt-menu="true">
                <div class="menu-item px-3">
                  <a  class="btn"><i class="fa fa-eye"></i>Details du bon</a>
                </div>
                <div class="menu-item px-3">
                  <a  class="btn"><i class="far fa-file-excel"></i>Exporter les colis</a>
                </div>
                <div class="menu-item px-3">
                  <a  class="btn"><i class="fa fa-check"></i>bon bien recu</a>
                </div>
                <div class="menu-item px-3">
                  <a  class="btn"><i class="far fa-file-pdf"></i>Voir en Pdf</a>
                </div>
                <div class="menu-item px-3">
                  <a  class="btn"><<i class="fas fa-ticket-alt"></i>Voir les etiqutte</a>
                </div>
                <div class="menu-item px-3">
                  <a  class="btn"><i class="fas fa-ticket-alt"></i> etiquetteuse</a>
                </div>
                
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
  // Filter by search input
  $('[data-kt-ecommerce-product-filter="search"]').on('input', function() {
    var searchText = $(this).val().toLowerCase();
    filterTable(searchText);
  });

  // Filter by status select
  $('[data-kt-ecommerce-product-filter="status"]').on('change', function() {
    var status = $(this).val();
    filterTableByStatus(status);
  });

  // Function to filter table by search text
  function filterTable(searchText) {
    // Filter table logic
  }

  // Function to filter table by status
  function filterTableByStatus(status) {
    // Filter table by status logic
  }
});

function openModal() {
  // Set the default values or update them based on the clicked item
  document.getElementById('villename').value = villename;
  document.getElementById('ref').value = ref;
  var zoneSelect = document.getElementById('id_Z');
  for (var i = 0; i < zoneSelect.options.length; i++) {
    if (zoneSelect.options[i].text === zonename) {
      zoneSelect.selectedIndex = i;
      break;
    }
  }
  // Set the form action URL
  document.getElementById('kt_modal_new_target_form').action = actionUrl;
}
</script>
@endsection

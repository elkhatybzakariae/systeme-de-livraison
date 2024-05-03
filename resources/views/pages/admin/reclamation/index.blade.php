@extends('layouts.client.admin')
@section('content')
    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form id="kt_modal_new_tarif_form" method="POST" class="form" action="{{ route('reclamation.store') }}">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Nouvelle reclamation</h1>
                        </div>
                        <div class="row">
                            <div class=" col-md-12 col mb-8 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Objet</span>
                                </label>
                                <input type="text" class="form-control form-control-solid"
                                    placeholder="Objet" id="objet" name="objet" />
                            </div>
                            <div class=" col-md-12 col mb-8 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Message</span>
                                </label>
                                <input type="text" class="form-control form-control-solid"
                                    placeholder="Message" id="message" name="message" />
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Enregister</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <input type="text" data-kt-ecommerce-product-filter="search"
                        class="form-control form-control-solid w-250px ps-14" placeholder="Search Product" />
                </div>
            </div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <div class="w-100 mw-150px">
                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                        data-placeholder="Status" data-kt-ecommerce-product-filter="status">
                        <option></option>
                        <option value="all">All</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5  dataTable" id="kt_ecommerce_products_table">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th>CLient</th>
                        <th>OBJET</th>
                        <th>COLI</th>
                        <th>ETAT</th>
                        <th>DATE D AJOUT</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @foreach ($reclamations as $item)
                        <tr id="{{ $item->id_Rec }}" role="row" class="odd">
                            <td>
                                <div class="">
                                    <div class="ms-5">
                                        <a href=""
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $item->client->nomcomplet }}</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <div class="ms-5">
                                        <a href=""
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $item->objet }}</a>
                                    </div>
                                </div>
                            </td>

                            <td class="pe-0">
                                <span class="fw-bold"
                                    data-kt-ecommerce-product-filter="villename">{{ $item->id_C ? $item->id_C : 'General' }}
                                </span>
                            </td>
                            <td class="pe-0">
                                <span class="fw-bold"
                                    data-kt-ecommerce-product-filter="villename">{{ $item->etat === 0 ? 'Reponse de client en attente' : 'Reclamation traite' }}</span>
                            </td>
                            <td class="pe-0">
                                <span class="fw-bold"
                                    data-kt-ecommerce-product-filter="objet">{{ $item->created_at }}</span>
                            </td>
                            <!--begin::Action=-->
                            <td class="">
                                {{-- <div class="menu-item px-3">
                                    <a onclick="openModal('{{ $tarif->villeRamassage }}','{{ $tarif->ville }}','{{ $tarif->objet }}','{{ $tarif->message }}','{{ $tarif->prixref }}','{{ $tarif->delailiv }}','{{ route('tarif.update', $tarif->id_Tar) }}')"
                                        data-bs-toggle="modal" data-bs-target="#kt_modal_new_target"
                                        class="menu-link px-3">Edit</a>
                                </div> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

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
                $('#kt_ecommerce_products_table tbody tr').each(function() {
                    var villename = $(this).find('[data-kt-ecommerce-product-filter="villename"]').text()
                        .toLowerCase();
                    if (villename.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            // Function to filter table by status
            function filterTableByStatus(status) {
                if (status === 'all') {
                    $('#kt_ecommerce_products_table tbody tr').show();
                } else {
                    $('#kt_ecommerce_products_table tbody tr').each(function() {
                        var zoneStatus = $(this).find('td:eq(3)').text().trim().toLowerCase();
                        if (zoneStatus === status) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }
            }
        });

        function openModal(villeRamassage = '', ville = '', objet = '', message = '', prixref = '', delailiv = '',
            actionUrl = "{{ route('tarif.store') }}") {
            console.log(ville);
            document.getElementById('villeRamassage').value = villeRamassage;
            document.getElementById('ville').value = ville;
            document.getElementById('objet').value = objet;
            document.getElementById('message').value = message;
            document.getElementById('prixref').value = prixref;
            document.getElementById('delailiv').value = delailiv;

            document.getElementById('kt_modal_new_tarif_form').action = actionUrl;

        }
    </script>
@endsection

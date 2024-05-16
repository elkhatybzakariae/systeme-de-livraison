@extends('layouts.admin.admin')
@section('breads')
    <x-breadcrumb :breads="$breads" />
@endsection
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
                <div class="modal-body scroll-y px-10 px-lg-5 pt-0 pb-5">
                    <div class="card-body" id="kt_drawer_chat_messenger_body">
                        <div class="scroll-y " id="show" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Toolbar-->
            <div class="d-flex flex-wrap flex-stack pb-7">
                <!--begin::Title-->
                <div class="d-flex flex-wrap align-items-center my-1">
                    <h3 class="fw-bold me-5 my-1">Clients ({{ $users->count() }})</h3>
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-3 position-absolute ms-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                    transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" id="kt_filter_search"
                            class="form-control form-control-sm border-body bg-body w-150px ps-10" placeholder="Search">
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Title-->
                <!--begin::Controls-->
                <div class="d-flex flex-wrap my-1">
                    <!--begin::Tab nav-->
                    <ul class="nav nav-pills me-6 mb-2 mb-sm-0" role="tablist">
                        <li class="nav-item m-0" role="presentation">
                            <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary me-3 "
                                data-bs-toggle="tab" href="#kt_project_users_card_pane" aria-selected="true" role="tab">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="5" y="5" width="5" height="5" rx="1"
                                                fill="currentColor"></rect>
                                            <rect x="14" y="5" width="5" height="5" rx="1"
                                                fill="currentColor" opacity="0.3"></rect>
                                            <rect x="5" y="14" width="5" height="5" rx="1"
                                                fill="currentColor" opacity="0.3"></rect>
                                            <rect x="14" y="14" width="5" height="5" rx="1"
                                                fill="currentColor" opacity="0.3"></rect>
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </li>
                        <li class="nav-item m-0" role="presentation">
                            <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary active" data-bs-toggle="tab"
                                href="#kt_project_users_table_pane" aria-selected="false" tabindex="-1" role="tab">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </li>
                    </ul>
                    <!--end::Tab nav-->
                </div>
                <!--end::Controls-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Tab Content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div id="kt_project_users_card_pane" class="tab-pane fade  " role="tabpanel">
                    <!--begin::Row-->
                    <div class="row g-6 g-xl-9">
                        @foreach ($users as $item)
                            <div class="col-md-6 col-xxl-4">
                                <!--begin::Card-->
                                <div class="card">
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-65px symbol-circle mb-5">
                                            <img src="{{ $item->img?'':asset('storage/images/profile.jpg') }}" alt="image">
                                            <div
                                                class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3">
                                            </div>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">{{ $item->nomcomplet }}</a>
                                        <!--end::Name-->
                                        <!--begin::Position-->
                                        <div class="fw-semibold text-gray-400 mb-6">{{ $item->nommagasin }}.</div>
                                        <!--end::Position-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-center flex-wrap">
                                            <button onclick="openModal('{{ $item->id_Cl }}')" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_new_target" class="btn"><i
                                                    class="fa fa-eye"></i></button>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                        @endforeach
                    </div>
                </div>
                <!--end::Tab pane-->
                <!--begin::Tab pane-->
                <div id="kt_project_users_table_pane" class="tab-pane  show active " role="tabpanel">
                    <!--begin::Card-->
                    <div class="card card-flush">
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <div id="kt_project_users_table_wrapper"
                                    class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="table-responsive">
                                        <table id="kt_project_users_table"
                                            class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
                                            <!--begin::Head-->
                                            <thead class="fs-7 text-gray-400 text-uppercase">
                                                <tr>
                                                    <th class="min-w-250px sorting" tabindex="0"
                                                        aria-controls="kt_project_users_table" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Client: activate to sort column ascending"
                                                        style="width: 0px;">Client</th>
                                                    <th class="min-w-150px sorting" tabindex="0"
                                                        aria-controls="kt_project_users_table" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Date: activate to sort column ascending"
                                                        style="width: 0px;">Nom Magasine</th>
                                                    <th class="min-w-50px text-end sorting_disabled" rowspan="1"
                                                        colspan="1" aria-label="Details" style="width: 0px;">Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <!--end::Head-->
                                            <!--begin::Body-->
                                            <tbody class="fs-6">
                                                @foreach ($users as $item)
                                                    <tr class="odd">
                                                        <td>
                                                            <!--begin::User-->
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-5 position-relative">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-35px symbol-circle">
                                                                        <img src="{{ $item->img?'':asset('storage/images/profile.jpg') }}" alt="image">

                                                                    </div>
                                                                    <!--end::Avatar-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Info-->
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <div class="mb-1 text-gray-800 text-hover-primary">
                                                                        {{ $item->nomcomplet }}
                                                                    </div>
                                                                </div>
                                                                <!--end::Info-->
                                                            </div>
                                                            <!--end::User-->
                                                        </td>
                                                        <td>
                                                            <div class="fw-semibold fs-6 text-gray-400">
                                                                {{ $item->nommagasin }}
                                                            </div>
                                                        </td>
                                                        <td class="text-end">
                                                            <button onclick="openModal('{{ $item->id_Cl }}')" data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_new_target" class="btn"><i
                                                                    class="fa fa-eye"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <!--end::Body-->
                                        </table>
                                    </div>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Tab pane-->
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <script>
    $(document).ready(function() {
    $('#kt_filter_search').on('input', function() {
        filterClients();
    });

    $('#kt_filter_status').on('change', function() {
        filterClients();
    });

    function filterClients() {
        var searchText = $('#kt_filter_search').val().toLowerCase();
        var status = $('#kt_filter_status').val().toLowerCase();

        // Filter card view
        $('#kt_project_users_card_pane .card').each(function() {
            var cardText = $(this).text().toLowerCase();
            var cardStatus = $(this).data('status').toLowerCase(); // Assuming you have data-status attribute in cards
            if ((cardText.includes(searchText) || searchText === '') &&
                (cardStatus === status || status === 'all')) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // Filter table view
        $('#kt_project_users_table tbody tr').each(function() {
            var rowText = $(this).text().toLowerCase();
            var rowStatus = $(this).data('status').toLowerCase(); // Assuming you have data-status attribute in rows
            if ((rowText.includes(searchText) || searchText === '') &&
                (rowStatus === status || status === 'all')) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
});

        function openModal(id) {
            var users = @json($users);
            let bb = '';
            let item =users.find(ele=>ele.id_Cl==id)
            console.log(item);
            bb += `
                <div class="">
                    <div class="d-flex flex-column ">
                        <div class="d-flex justify-content-center align-items-center  mb-2">
                            <div class="symbol symbol-35px symbol-circle">
                                <img src="{{ $item->img?'':asset('storage/images/profile.jpg') }}" alt="image">

                            </div>
                            <div class="ms-3">
                                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                            </div>
                        </div>
                        <div class=" rounded text-dark fw-semibold text-start row" data-kt-element="message-text">
                            <div class="form-group mb-3 col col-md-6">
                                <label class="fw-bold" for="nom_livreur">Nom Client:</label>
                                <input type="text" id="nom_livreur" class="form-control" value="${item.nomcomplet}" readonly>
                            </div>
                            <div class="form-group mb-3 col col-md-6">
                                <label class="fw-bold" for="cin">CIN:</label>
                                <input type="text" id="cin" class="form-control" value="${item.cin}" readonly>
                            </div>
                            <div class="form-group mb-3 col col-md-6">
                                <label class="fw-bold" for="bank">Bank:</label>
                                <input type="text" id="bank" class="form-control" value="${item.nombanque}" readonly>
                            </div>
                            <div class="form-group mb-3 col col-md-6">
                                <label class="fw-bold" for="email">Adresse electronique:</label>
                                <input type="text" id="email" class="form-control" value="${item.email}" readonly>
                            </div>
                            <div class="form-group mb-3 col col-md-6">
                                <label class="fw-bold" for="phone">Numero de telephone:</label>
                                <input type="text" id="phone" class="form-control" value="${item.Phone}" readonly>
                            </div>
                            <div class="form-group mb-3 col col-md-6">
                                <label class="fw-bold" for="ville">Ville:</label>
                                <input type="text" id="ville" class="form-control" value="${item.ville}" readonly>
                            </div>
                            <div class="form-group mb-3 col col-md-12">
                                <label class="fw-bold" for="adresse">Adresse:</label>
                                <textarea  id="adresse" class="form-control"  readonly> ${item.adress}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('show').innerHTML = bb;
        }

    </script>
@endsection

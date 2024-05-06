{{-- @extends('layouts.admin.admin')
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

                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form id="kt_modal_new_user_form" method="POST" class="form" action="{{ route('newuser.store') }}">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Nouvelle Utilisateur</h1>
                        </div>
                        <div class="row">
                            <div class=" col-md-12 col mb-8 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Nom complet</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Nom complet"
                                    id="nomcomplet" name="nomcomplet" />
                            </div>
                            <div class=" col-md-12 col mb-8 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Email</span>
                                </label>
                                <input type="email" class="form-control form-control-solid" placeholder="Email"
                                    id="email" name="email" />
                            </div>
                            <div class=" col-md-12 col mb-8 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Mot de passe</span>
                                </label>
                                <input type="password" class="form-control form-control-solid" placeholder="Mot de passe"
                                    id="password" name="password" />
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
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div id="customers_table_json_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <table id="customers_table_json"
                                            class="table table-striped table-bordered table-sm mb-0 no-footer dataTable"
                                            role="grid" aria-describedby="customers_table_json_info"
                                            style="width: 864px;">
                                            <thead>
                                                <tr role="row">
                                                    <th>Utilisateur</th>
                                                    <th>Informations</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $item)
                                                    <tr id="{{ $item->id_Cl }}" role="row" class="odd">
                                                        <td>
                                                            <b>Nom Client : </b>{{ $item->nomcomplet }}<br>
                                                            <b>CIN : </b>{{ $item->cin }}<br>
                                                        </td>
                                                        <td><b>Adresse electronique : </b>{{ $item->email }}<br>

                                                            <b>Numero de telephone : </b>?{{ $item->Phone }}?<br>

                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <div class="btn-group" role="group">
                                                                <a onclick="openModal('{{ $item }}')"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#kt_modal_new_target"
                                                                    class="menu-link px-3"><i class="fa fa-edit"></i></a>
                                                                
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <div id="customers_table_json_processing"
                                            class="dataTables_processing panel panel-default" style="display: none;">
                                            Processing...</div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script>
            $(function() {
                tableNewCstmrs('customers_table_json');
            });

            function openModal(nomcomplet, email, actionUrl = "{{ route('newuser.store') }}") {
                // Set the zone name input value
                document.getElementById('nomcomplet').value = nomcomplet;
                document.getElementById('nomcomplet').readOnly = true;
                document.getElementById('email').readOnly = true;
                document.getElementById('email').value = email;
                document.getElementById('kt_modal_new_target_cancel').style.display = 'none';


                document.getElementById('kt_modal_new_user_form').action = actionUrl;
                // document.getElementById('kt_modal_new_user_form').method = 'put';


            }
        </script>
    </div>
@endsection --}}

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
                            <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary me-3 active"
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
                            <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary" data-bs-toggle="tab"
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
                <div id="kt_project_users_card_pane" class="tab-pane fade show active" role="tabpanel">
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
                                            <img src="" alt="image">
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
                                            <a onclick="openModal('{{ $item->id_Cl }}')" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_new_target" class="menu-link px-3"><i
                                                    class="fa fa-eye"></i></a>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                        @endforeach
                    </div>
                    <!--end::Row-->
                    <!--begin::Pagination-->
                    <div class="d-flex flex-stack flex-wrap pt-10">
                        <div class="fs-6 fw-semibold text-gray-700">Showing 1 to 10 of 50 entries</div>
                        <!--begin::Pages-->
                        <ul class="pagination">
                            <li class="page-item previous">
                                <a href="#" class="page-link">
                                    <i class="previous"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">3</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">4</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">5</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">6</a>
                            </li>
                            <li class="page-item next">
                                <a href="#" class="page-link">
                                    <i class="next"></i>
                                </a>
                            </li>
                        </ul>
                        <!--end::Pages-->
                    </div>
                    <!--end::Pagination-->
                </div>
                <!--end::Tab pane-->
                <!--begin::Tab pane-->
                <div id="kt_project_users_table_pane" class="tab-pane fade" role="tabpanel">
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
                                                                        <img alt="Pic"
                                                                            src="assets/media/avatars/300-6.jpg">
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
                                                            <a onclick="openModal('{{ $item->id_Cl }}')" data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_new_target" class="menu-link px-3"><i
                                                                    class="fa fa-eye"></i></a>
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
        function openModal(item) {
            let bb = '';
            bb += `<div class="d-flex justify-content-center mb-10">
                        <div class="d-flex flex-column align-items-center">
                            <div class="d-flex align-items-center mb-2">
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="assets/media/avatars/300-25.jpg">
                                        </div>
                                        <div class="ms-3">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                                        </div>
                                    </div>
                            <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start"
                                                                data-kt-element="message-text">
                                                                
                                                            <b>Nom Livreur : </b>{{ $item->nomcomplet }}<br>
                                                            <b>CIN : </b>{{ $item->cin }}<br>
                                                            <b>Bank : </b>{{ $item->nombanque }}<br>
                                                       <b>Adresse electronique : </b>{{ $item->email }}<br>
                                                            <b>Numero de telephone : </b>?{{ $item->Phone }}?<br>
                                                            <b>Ville : </b>{{ $item->ville }}<br>
                                                            <b>Adresse : </b>{{ $item->adress }}
                                                        
                                                                </div>
                                                               </div>
                    </div> `;

            document.getElementById('show').innerHTML = bb;


        }
    </script>
@endsection

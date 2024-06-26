@extends('layouts.admin.admin')
@section('breads')
    <x-breadcrumb :breads="$breads" />
@endsection
@section('content')
    <div class="modal fade" id="kt_modal_new_option" tabindex="-1" aria-hidden="true">
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


                    <form id="kt_modal_new_target_form" action="{{ route('option.store') }}" method="post">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Ajouter une option</h1>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Code</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Code *"
                                id="code" name="code" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Nom</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nom *" id="nom"
                                name="nom" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Couleur</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="color" class="form-control form-control-solid" placeholder="Couleur *"
                                id="couleur" name="couleur" />
                        </div>

                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kt_modal_new_etat" tabindex="-1" aria-hidden="true">
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


                    <form id="kt_modal_new_target_form" action="{{ route('etat.store') }}" method="post">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Ajouter Etat</h1>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Code</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Code *"
                                id="code" name="code" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Nom</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nom *"
                                id="nom" name="nom" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Couleur</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="color" class="form-control form-control-solid" placeholder="Couleur *"
                                id="couleur" name="couleur" />
                        </div>

                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kt_modal_new_typeclient" tabindex="-1" aria-hidden="true">
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
                    <form id="kt_modal_new_target_form" method="POST" class="form"
                        action="{{ route('typeclient.store') }}">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Ajouter type</h1>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Nom</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nom *"
                                id="nom" name="nom" />
                        </div>

                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kt_modal_new_bank" tabindex="-1" aria-hidden="true">
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
                    <form id="kt_modal_new_target_form" method="POST" class="form"
                        action="{{ route('bank.store') }}">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Ajouter Bank</h1>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Nom</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nom *"
                                id="nom" name="nom" />
                        </div>

                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Status Colis
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div id="settings_statut_table_wrapper"
                                                class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <div id="settings_statut_table_filter" class="dataTables_filter">
                                                            <label>Rechercher :<input type="search"
                                                                    class="form-control input-sm" placeholder=""
                                                                    aria-controls="settings_statut_table"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <div id="settings_statut_table_filter" class="dataTables_filter">
                                                            <a class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_new_option">Ajouter une
                                                                option</a>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12">
                                                        <table id="settings_statut_table"
                                                            class="table table-striped table-bordered table-sm mb-0 table_data_input_hidden dataTable no-footer"
                                                            role="grid" aria-describedby="settings_statut_table_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_statut_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Code: activate to sort column ascending"
                                                                        style="width: 107.135px;">Code</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_statut_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Nom: activate to sort column ascending"
                                                                        style="width: 138.125px;">Nom</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_statut_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Couleur: activate to sort column ascending"
                                                                        style="width: 54.8958px;">Couleur</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_statut_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Actions: activate to sort column ascending"
                                                                        style="width: 52.0417px;">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($Options as $item)
                                                                    <tr id="{{ $item->id_Op }}" role="row"
                                                                        class="odd">
                                                                        <form
                                                                            action="{{ route('option.update', $item->id_Op) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <td>{{ $item->code }}</td>
                                                                            <td><input name="nom" type="text"
                                                                                    value="{{ $item->nom }}"></td>
                                                                            <td><input name="couleur" type="color"
                                                                                    value="{{ $item->couleur }}"></td>
                                                                            <td>
                                                                                <button type="submit"
                                                                                    class="btn btn-sm btn-primary"><i
                                                                                        class="far fa-save"></i></button>
                                                                        </form>
                                                                        <form
                                                                            action="{{ route('option.delete', $item->id_Op) }}"
                                                                            method="post">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="btn btn-sm btn-danger"><i
                                                                                    class="fa fa-trash"></i></button>
                                                                        </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Etat Colis
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div id="settings_statut_table_wrapper"
                                                class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <div id="settings_statut_table_filter" class="dataTables_filter">
                                                            <label>Rechercher :<input type="search"
                                                                    class="form-control input-sm" placeholder=""
                                                                    aria-controls="settings_statut_table"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <div id="settings_statut_table_filter" class="dataTables_filter">
                                                            <a class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_new_etat">Ajouter etat</a>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12">
                                                        <table id="settings_statut_table"
                                                            class="table table-striped table-bordered table-sm mb-0 table_data_input_hidden dataTable no-footer"
                                                            role="grid" aria-describedby="settings_statut_table_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_statut_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Code: activate to sort column ascending"
                                                                        style="width: 107.135px;">Code</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_statut_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Nom: activate to sort column ascending"
                                                                        style="width: 138.125px;">Nom</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_statut_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Couleur: activate to sort column ascending"
                                                                        style="width: 54.8958px;">Couleur</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_statut_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Actions: activate to sort column ascending"
                                                                        style="width: 52.0417px;">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($etat as $item)
                                                                    <tr id="{{ $item->id_Et }}" role="row"
                                                                        class="odd">
                                                                        <form
                                                                            action="{{ route('etat.update', $item->id_Et) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <td>{{ $item->code }}</td>
                                                                            <td><input name="nom" type="text"
                                                                                    value="{{ $item->nom }}"></td>
                                                                            <td><input name="couleur" type="color"
                                                                                    value="{{ $item->couleur }}"></td>
                                                                            <td>
                                                                                <button type="submit"
                                                                                    class="btn btn-sm btn-primary"><i
                                                                                        class="far fa-save"></i></button>
                                                                        </form>
                                                                        <form
                                                                            action="{{ route('etat.delete', $item->id_Et) }}"
                                                                            method="post">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="btn btn-sm btn-danger"><i
                                                                                    class="fa fa-trash"></i></button>
                                                                        </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        {{-- <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Types de client<!--5-->
                                            </h5>
                                        </div>

                                        <div class="card-body">
                                            <div id="settings_types_table_wrapper"
                                                class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <div id="settings_statut_table_filter" class="dataTables_filter">
                                                            <label>Rechercher :<input type="search"
                                                                    class="form-control input-sm" placeholder=""
                                                                    aria-controls="settings_statut_table"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <div id="settings_statut_table_filter" class="dataTables_filter">
                                                            <a class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_new_typeclient">Ajouter type</a>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12">
                                                        <table id="settings_types_table"
                                                            class="table table-striped table-bordered table-sm mb-0 table_data_input_hidden dataTable no-footer"
                                                            role="grid" aria-describedby="settings_types_table_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_types_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Nom: activate to sort column ascending"
                                                                        style="width: 168.865px;">Nom</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_types_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Clients: activate to sort column ascending"
                                                                        style="width: 62.75px;">Clients</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_types_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Actions: activate to sort column ascending"
                                                                        style="width: 72.5104px;">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr id="user-type-673" role="row" class="odd">
                                                                    <td><input name="type_name" type="text"
                                                                            value="CHOMOR"></td>
                                                                    <td>17</td>
                                                                    <td><a href="javascript:editCompanyType('673');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>

                                                                    </td>
                                                                </tr>
                                                                <tr id="user-type-17" role="row" class="even">
                                                                    <td><input name="type_name" type="text"
                                                                            value="SARL"></td>
                                                                    <td>2</td>
                                                                    <td><a href="javascript:editCompanyType('17');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>

                                                                    </td>
                                                                </tr>
                                                                <tr id="user-type-16" role="row" class="odd">
                                                                    <td><input name="type_name" type="text"
                                                                            value="Auto entrepreneur"></td>
                                                                    <td>0</td>
                                                                    <td><a href="javascript:editCompanyType('16');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>
                                                                        <a href="javascript:ajaxLink('s_options?action=delete-user-type&amp;config-id=16');"
                                                                            class="btn btn-sm btn-danger"><i
                                                                                class="fa fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <tr id="user-type-2865" role="row" class="even">
                                                                    <td><input name="type_name" type="text"
                                                                            value="socite de livraison"></td>
                                                                    <td>4</td>
                                                                    <td><a href="javascript:editCompanyType('2865');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Types bank<!--5-->
                                            </h5>
                                        </div>

                                        <div class="card-body">
                                            <div id="settings_banks_table_wrapper"
                                                class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                {{-- <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <div id="settings_statut_table_filter" class="dataTables_filter">
                                                            <label>Rechercher :<input type="search"
                                                                    class="form-control input-sm" placeholder=""
                                                                    aria-controls="settings_statut_table"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <div id="settings_statut_table_filter" class="dataTables_filter">
                                                            <a class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_new_bank">Ajouter bank</a>
                                                        </div>
                                                    </div>

                                                </div> --}}
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12">
                                                        <table id="settings_banks_table"
                                                            class="table table-striped table-bordered table-sm mb-0 table_data_input_hidden dataTable no-footer"
                                                            role="grid" aria-describedby="settings_banks_table_info">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_banks_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Nom: activate to sort column ascending"
                                                                        style="width: 138.125px;">Nom</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_banks_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Utilisateurs: activate to sort column ascending"
                                                                        style="width: 81.7604px;">Clients</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_banks_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Clients: activate to sort column ascending"
                                                                        style="width: 47.9792px;">Livreurs</th>
                                                                    {{-- <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_banks_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Actions: activate to sort column ascending"
                                                                        style="width: 56.3542px;">Actions</th> --}}
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($typeBank as $item)
                                                                    <tr id="banks-15" role="row" class="odd">
                                                                        <td><input name="bank_name" type="text"
                                                                                value="{{ $item->nom }}" readonly></td>
                                                                        <td>
                                                                            @foreach ($nbclient as $nbitem)
                                                                                @if ($nbitem->nombanque === $item->nom)
                                                                                    {{ $nbitem->client_count }}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($nbliv as $nbitem)
                                                                                @if ($nbitem->nombanque === $item->nom)
                                                                                    {{ $nbitem->liv_count }}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                        {{-- <td><a href="javascript:editBank('15');"
                                                                                class="btn btn-sm btn-primary"><i
                                                                                    class="far fa-save"></i></a>

                                                                        </td> --}}
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

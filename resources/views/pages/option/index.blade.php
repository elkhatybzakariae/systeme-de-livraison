@extends('layouts.admin.admin')
@section('breads')
    <x-breadcrumb :breads="$breads" />
@endsection
@section('content')
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
                                            <h5>Status Colis<!--5-->
                                            </h5>
                                        </div>

                                        <div class="card-body">

                                            <form action="{{ route('option.store') }}" method="post">
                                                @csrf
                                                <table class="add-statut-table">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width:25%">
                                                                <div class="col-md-12 m-auto">
                                                                    <div class="form-group">
                                                                        <label>Code *</label>
                                                                        <input type="text" class="form-control"
                                                                            name="code" value=""
                                                                            placeholder="Code *">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="width:40%">
                                                                <div class="col-md-12 m-auto">
                                                                    <div class="form-group">
                                                                        <label>Nom *</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nom" value=""
                                                                            placeholder="Nom *">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="width:25%">
                                                                <div class="col-md-12 m-auto">
                                                                    <div class="form-group">
                                                                        <label>Couleur *</label>
                                                                        <input type="color" class="form-control"
                                                                            name="couleur" value=""
                                                                            placeholder="Couleur *">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="width:10%"><button type="submit"
                                                                    class="btn btn-sm btn-primary"><i
                                                                        class="fas fa-plus"></i></button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </form>

                                            <div id="settings_statut_table_wrapper"
                                                class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                                        <div class="dataTables_length" id="settings_statut_table_length">
                                                            <label>Afficher <select name="settings_statut_table_length"
                                                                    aria-controls="settings_statut_table"
                                                                    class="form-control input-sm">
                                                                    <option value="10">10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="50">50</option>
                                                                    <option value="100">100</option>
                                                                </select> entrees par page</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <div id="settings_statut_table_filter" class="dataTables_filter">
                                                            <label>Rechercher :<input type="search"
                                                                    class="form-control input-sm" placeholder=""
                                                                    aria-controls="settings_statut_table"></label>
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
                                                                        aria-controls="settings_statut_table" rowspan="1"
                                                                        colspan="1"
                                                                        aria-label="Code: activate to sort column ascending"
                                                                        style="width: 107.135px;">Code</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_statut_table" rowspan="1"
                                                                        colspan="1"
                                                                        aria-label="Nom: activate to sort column ascending"
                                                                        style="width: 138.125px;">Nom</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_statut_table" rowspan="1"
                                                                        colspan="1"
                                                                        aria-label="Couleur: activate to sort column ascending"
                                                                        style="width: 54.8958px;">Couleur</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_statut_table" rowspan="1"
                                                                        colspan="1"
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

                                                                            </td>
                                                                        </form>
                                                                    </tr>
                                                                @endforeach

                                                                {{-- <tr id="PAID" role="row" class="even">
                                                                    <td>PAID</td>
                                                                    <td><input name="statut_name" type="text"
                                                                            value="Payé"></td>
                                                                    <td><input name="statut_color" type="color"
                                                                            value="#865679"></td>
                                                                    <td><a href="javascript:editStatut('PAID');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a></td>
                                                                </tr> --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-5">
                                                        <div class="dataTables_info" id="settings_statut_table_info"
                                                            role="status" aria-live="polite">Affichage 1 a 10 de 27
                                                            entrees</div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-7">
                                                        <div class="dataTables_paginate paging_simple_numbers"
                                                            id="settings_statut_table_paginate">
                                                            <ul class="pagination">
                                                                <li class="paginate_button page-item previous disabled"
                                                                    id="settings_statut_table_previous"><a href="#"
                                                                        aria-controls="settings_statut_table"
                                                                        data-dt-idx="0" tabindex="0"
                                                                        class="page-link">Precedent</a></li>
                                                                <li class="paginate_button page-item active"><a
                                                                        href="#"
                                                                        aria-controls="settings_statut_table"
                                                                        data-dt-idx="1" tabindex="0"
                                                                        class="page-link">1</a></li>
                                                                <li class="paginate_button page-item "><a href="#"
                                                                        aria-controls="settings_statut_table"
                                                                        data-dt-idx="2" tabindex="0"
                                                                        class="page-link">2</a></li>
                                                                <li class="paginate_button page-item "><a href="#"
                                                                        aria-controls="settings_statut_table"
                                                                        data-dt-idx="3" tabindex="0"
                                                                        class="page-link">3</a></li>
                                                                <li class="paginate_button page-item next"
                                                                    id="settings_statut_table_next"><a href="#"
                                                                        aria-controls="settings_statut_table"
                                                                        data-dt-idx="4" tabindex="0"
                                                                        class="page-link">Suivant</a></li>
                                                            </ul>
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
                    <div class="col-lg-12">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Types de client<!--5-->
                                            </h5>
                                        </div>

                                        <div class="card-body">

                                            <a href="javascript:addOptionsForm('#settings_types_table','user-type','Type de client','Ajouter')"
                                                class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter</a><br>


                                            <div id="settings_types_table_wrapper"
                                                class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                                        <div class="dataTables_length" id="settings_types_table_length">
                                                            <label>Afficher <select name="settings_types_table_length"
                                                                    aria-controls="settings_types_table"
                                                                    class="form-control input-sm">
                                                                    <option value="10">10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="50">50</option>
                                                                    <option value="100">100</option>
                                                                </select> entrees par page</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <div id="settings_types_table_filter" class="dataTables_filter">
                                                            <label>Rechercher :<input type="search"
                                                                    class="form-control input-sm" placeholder=""
                                                                    aria-controls="settings_types_table"></label>
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
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-5">
                                                        <div class="dataTables_info" id="settings_types_table_info"
                                                            role="status" aria-live="polite">Affichage 1 a 4 de 4 entrees
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-7">
                                                        <div class="dataTables_paginate paging_simple_numbers"
                                                            id="settings_types_table_paginate">
                                                            <ul class="pagination">
                                                                <li class="paginate_button page-item previous disabled"
                                                                    id="settings_types_table_previous"><a href="#"
                                                                        aria-controls="settings_types_table"
                                                                        data-dt-idx="0" tabindex="0"
                                                                        class="page-link">Precedent</a></li>
                                                                <li class="paginate_button page-item active"><a
                                                                        href="#"
                                                                        aria-controls="settings_types_table"
                                                                        data-dt-idx="1" tabindex="0"
                                                                        class="page-link">1</a></li>
                                                                <li class="paginate_button page-item next disabled"
                                                                    id="settings_types_table_next"><a href="#"
                                                                        aria-controls="settings_types_table"
                                                                        data-dt-idx="2" tabindex="0"
                                                                        class="page-link">Suivant</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Types de client<!--5-->
                                            </h5>
                                        </div>

                                        <div class="card-body">

                                            <a href="javascript:addOptionsForm('#settings_banks_table','bank','Nom du banque','Ajouter')"
                                                class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter</a><br>
                                            <div id="settings_banks_table_wrapper"
                                                class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                                        <div class="dataTables_length" id="settings_banks_table_length">
                                                            <label>Afficher <select name="settings_banks_table_length"
                                                                    aria-controls="settings_banks_table"
                                                                    class="form-control input-sm">
                                                                    <option value="10">10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="50">50</option>
                                                                    <option value="100">100</option>
                                                                </select> entrees par page</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <div id="settings_banks_table_filter" class="dataTables_filter">
                                                            <label>Rechercher :<input type="search"
                                                                    class="form-control input-sm" placeholder=""
                                                                    aria-controls="settings_banks_table"></label>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                                        style="width: 81.7604px;">Utilisateurs</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_banks_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Clients: activate to sort column ascending"
                                                                        style="width: 47.9792px;">Clients</th>
                                                                    <th class="sorting" tabindex="0"
                                                                        aria-controls="settings_banks_table"
                                                                        rowspan="1" colspan="1"
                                                                        aria-label="Actions: activate to sort column ascending"
                                                                        style="width: 56.3542px;">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>






























                                                                <tr id="banks-15" role="row" class="odd">
                                                                    <td><input name="bank_name" type="text"
                                                                            value="BANQUE POPULAIRE"></td>
                                                                    <td>12</td>
                                                                    <td>3</td>
                                                                    <td><a href="javascript:editBank('15');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>

                                                                    </td>
                                                                </tr>
                                                                <tr id="banks-14" role="row" class="even">
                                                                    <td><input name="bank_name" type="text"
                                                                            value="ATTIJARIWAFA BANK"></td>
                                                                    <td>1</td>
                                                                    <td>2</td>
                                                                    <td><a href="javascript:editBank('14');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>

                                                                    </td>
                                                                </tr>
                                                                <tr id="banks-12" role="row" class="odd">
                                                                    <td><input name="bank_name" type="text"
                                                                            value="BMCE BANK"></td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                    <td><a href="javascript:editBank('12');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>

                                                                    </td>
                                                                </tr>
                                                                <tr id="banks-11" role="row" class="even">
                                                                    <td><input name="bank_name" type="text"
                                                                            value="CIH BANK"></td>
                                                                    <td>35</td>
                                                                    <td>14</td>
                                                                    <td><a href="javascript:editBank('11');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>

                                                                    </td>
                                                                </tr>
                                                                <tr id="banks-2854" role="row" class="odd">
                                                                    <td><input name="bank_name" type="text"
                                                                            value="BARID BANK"></td>
                                                                    <td>0</td>
                                                                    <td>0</td>
                                                                    <td><a href="javascript:editBank('2854');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>
                                                                        <a href="javascript:ajaxLink('s_options?action=delete-bank&amp;config-id=2854');"
                                                                            class="btn btn-sm btn-danger"><i
                                                                                class="fa fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <tr id="banks-2855" role="row" class="even">
                                                                    <td><input name="bank_name" type="text"
                                                                            value="CREDIT AGRICOLE"></td>
                                                                    <td>4</td>
                                                                    <td>2</td>
                                                                    <td><a href="javascript:editBank('2855');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>

                                                                    </td>
                                                                </tr>
                                                                <tr id="banks-2856" role="row" class="odd">
                                                                    <td><input name="bank_name" type="text"
                                                                            value="CREDIT DU MAROC"></td>
                                                                    <td>0</td>
                                                                    <td>0</td>
                                                                    <td><a href="javascript:editBank('2856');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>
                                                                        <a href="javascript:ajaxLink('s_options?action=delete-bank&amp;config-id=2856');"
                                                                            class="btn btn-sm btn-danger"><i
                                                                                class="fa fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <tr id="banks-2857" role="row" class="even">
                                                                    <td><input name="bank_name" type="text"
                                                                            value="UMNIA BANK"></td>
                                                                    <td>0</td>
                                                                    <td>0</td>
                                                                    <td><a href="javascript:editBank('2857');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>
                                                                        <a href="javascript:ajaxLink('s_options?action=delete-bank&amp;config-id=2857');"
                                                                            class="btn btn-sm btn-danger"><i
                                                                                class="fa fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <tr id="banks-2858" role="row" class="odd">
                                                                    <td><input name="bank_name" type="text"
                                                                            value="BANK AL YOUSR"></td>
                                                                    <td>0</td>
                                                                    <td>0</td>
                                                                    <td><a href="javascript:editBank('2858');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>
                                                                        <a href="javascript:ajaxLink('s_options?action=delete-bank&amp;config-id=2858');"
                                                                            class="btn btn-sm btn-danger"><i
                                                                                class="fa fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <tr id="banks-2859" role="row" class="even">
                                                                    <td><input name="bank_name" type="text"
                                                                            value="SOCIETE GENERALE"></td>
                                                                    <td>0</td>
                                                                    <td>0</td>
                                                                    <td><a href="javascript:editBank('2859');"
                                                                            class="btn btn-sm btn-primary"><i
                                                                                class="far fa-save"></i></a>
                                                                        <a href="javascript:ajaxLink('s_options?action=delete-bank&amp;config-id=2859');"
                                                                            class="btn btn-sm btn-danger"><i
                                                                                class="fa fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-5">
                                                        <div class="dataTables_info" id="settings_banks_table_info"
                                                            role="status" aria-live="polite">Affichage 1 a 10 de 15
                                                            entrees</div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-7">
                                                        <div class="dataTables_paginate paging_simple_numbers"
                                                            id="settings_banks_table_paginate">
                                                            <ul class="pagination">
                                                                <li class="paginate_button page-item previous disabled"
                                                                    id="settings_banks_table_previous"><a href="#"
                                                                        aria-controls="settings_banks_table"
                                                                        data-dt-idx="0" tabindex="0"
                                                                        class="page-link">Precedent</a></li>
                                                                <li class="paginate_button page-item active"><a
                                                                        href="#"
                                                                        aria-controls="settings_banks_table"
                                                                        data-dt-idx="1" tabindex="0"
                                                                        class="page-link">1</a></li>
                                                                <li class="paginate_button page-item "><a href="#"
                                                                        aria-controls="settings_banks_table"
                                                                        data-dt-idx="2" tabindex="0"
                                                                        class="page-link">2</a></li>
                                                                <li class="paginate_button page-item next"
                                                                    id="settings_banks_table_next"><a href="#"
                                                                        aria-controls="settings_banks_table"
                                                                        data-dt-idx="3" tabindex="0"
                                                                        class="page-link">Suivant</a></li>
                                                            </ul>
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
    </div>
@endsection

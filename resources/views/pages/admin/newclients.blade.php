@extends('layouts.admin.admin')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div id="customers_table_json_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="customers_table_json_length"><label>Afficher
                                                <select name="customers_table_json_length"
                                                    aria-controls="customers_table_json" class="form-control input-sm">
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                    <option value="200">200</option>
                                                    <option value="500">500</option>
                                                    <option value="-1">All</option>
                                                </select> entrees par page</label></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div id="customers_table_json_filter" class="dataTables_filter"><label>Rechercher
                                                :<input type="search" class="form-control input-sm" placeholder=""
                                                    aria-controls="customers_table_json"></label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <table id="customers_table_json"
                                            class="table table-striped table-bordered table-sm mb-0 no-footer dataTable"
                                            role="grid" aria-describedby="customers_table_json_info"
                                            style="width: 864px;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="customers_table_json"
                                                        rowspan="1" colspan="1" style="width: 306.2px;"
                                                        aria-label="Vendeur: activate to sort column ascending">Vendeur</th>
                                                    <th class="sorting" tabindex="0" aria-controls="customers_table_json"
                                                        rowspan="1" colspan="1" style="width: 377.2px;"
                                                        aria-label="Informations: activate to sort column ascending">
                                                        Informations</th>
                                                    <th class="sorting" tabindex="0" aria-controls="customers_table_json"
                                                        rowspan="1" colspan="1" style="width: 74.2px;"
                                                        aria-label="Actions: activate to sort column ascending">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list as $item)
                                                    <tr id="{{$item->id_Cl}}" role="row" class="odd">
                                                        <td><b>Nom du magasin : </b>{{$item->nommagasin}}<br>
                                                            <b>Nom complet : </b>{{$item->nomcomplet}}<br>
                                                            <b>Type d entereprise : </b>{{$item->typeentreprise}}<br>
                                                            <b>CIN : </b>{{$item->cin}}<br>
                                                            <b>Site web : </b>{{$item->siteweb}}<br>
                                                            <b>Registre de commerce : {{$item->siteweb}}</b>
                                                        </td>
                                                        <td><b>Adresse electronique : </b>{{$item->email}}<br>
                                                            <b>Mot de passe : </b>{{$item->password}}<br>
                                                            <b>Numero de telephone : </b>?{{$item->Phone}}?<br>
                                                            <b>Ville : </b>{{$item->ville}}<br>
                                                            <b>Adresse : </b>{{$item->adress}}
                                                        </td>
                                                        <td class="dns_tbl_td_statut">
                                                            <div class="btn-group btn-group-sm" role="group"><a
                                                                    target="_blank"
                                                                    href="customers?action=add&amp;customers_storename=Dripwave&amp;customers_fullname=Aicha laoulidi&amp;customers_company_type=16&amp;customers_brand=Bj452558&amp;customers_website=&amp;customers_rc=&amp;customers_email=aishalaoulidi@gmail.com&amp;customers_password=aicha199700.&amp;customers_phone=?+212&nbsp;649?575961?&amp;customers_city=Casablanca&amp;customers_address=Ainsebaa el wifaq"
                                                                    class="btn btn-sm btn-primary"><i
                                                                        class="fa fa-plus"></i></a>
                                                                <a href="javascript:ajaxLink('new-customer?action=delete&amp;customer-id=399');"
                                                                    class="btn btn-sm btn-danger"><i
                                                                        class="fa fa-times"></i></a>
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
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="customers_table_json_info" role="status"
                                            aria-live="polite">Affichage 1 a 1 de 1 entrees</div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                            id="customers_table_json_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="customers_table_json_previous"><a href="#"
                                                        aria-controls="customers_table_json" data-dt-idx="0" tabindex="0"
                                                        class="page-link">Precedent</a></li>
                                                <li class="paginate_button page-item active"><a href="#"
                                                        aria-controls="customers_table_json" data-dt-idx="1" tabindex="0"
                                                        class="page-link">1</a></li>
                                                <li class="paginate_button page-item next disabled"
                                                    id="customers_table_json_next"><a href="#"
                                                        aria-controls="customers_table_json" data-dt-idx="2" tabindex="0"
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
        <script>
            $(function() {
                tableNewCstmrs('customers_table_json');
            });
        </script>
    </div>
@endsection

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
                                    <div class="col-xs-12 col-sm-12">
                                        <table id="customers_table_json"
                                            class="table table-striped table-bordered table-sm mb-0 no-footer dataTable"
                                            role="grid" aria-describedby="customers_table_json_info"
                                            style="width: 864px;">
                                            <thead>
                                                <tr role="row">
                                                    <th>Vendeur</th>
                                                    <th>Informations</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list as $item)
                                                    <tr id="{{ $item->id_Cl }}" role="row" class="odd">
                                                        <td><b>Nom du magasin : </b>{{ $item->nommagasin }}<br>
                                                            <b>Nom complet : </b>{{ $item->nomcomplet }}<br>
                                                            <b>Type d entereprise : </b>{{ $item->typeentreprise }}<br>
                                                            <b>CIN : </b>{{ $item->cin }}<br>
                                                            <b>Site web : </b>{{ $item->siteweb }}<br>
                                                            <b>Registre de commerce : {{ $item->siteweb }}</b>
                                                        </td>
                                                        <td><b>Adresse electronique : </b>{{ $item->email }}<br>
                                                            <b>Mot de passe : </b>{{ $item->password }}<br>
                                                            <b>Numero de telephone : </b>?{{ $item->Phone }}?<br>
                                                            <b>Ville : </b>{{ $item->ville }}<br>
                                                            <b>Adresse : </b>{{ $item->adress }}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <div class="btn-group" role="group">
                                                                <a href="{{ route('accept.profile', $item->id_Cl) }}"  class="btn btn-primary">
                                                                        <i class="fa fa-plus"></i>
                                                                </a>
                                                                <form action="{{ route('deleteclient', $item->id_Cl) }}" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
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
                                                        aria-controls="customers_table_json" data-dt-idx="2"
                                                        tabindex="0" class="page-link">Suivant</a></li>
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

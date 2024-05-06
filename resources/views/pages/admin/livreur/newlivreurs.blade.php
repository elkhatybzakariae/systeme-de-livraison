@extends('layouts.admin.admin')
@section('breads')
<x-breadcrumb :breads="$breads" />

@endsection
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
                                                    <th >Utilisateur</th>
                                                    <th >Informations</th>
                                                    <th >Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list as $item)
                                                    <tr id="{{ $item->id_Cl }}" role="row" class="odd">
                                                        <td>
                                                            <b>Nom Livreur : </b>{{ $item->nomcomplet }}<br>
                                                            <b>CIN : </b>{{ $item->cin }}<br>
                                                            <b>Bank : </b>{{ $item->nombanque }}<br>
                                                        </td>
                                                        <td><b>Adresse electronique : </b>{{ $item->email }}<br>
                                                            <b>Mot de passe : </b>{{ $item->password }}<br>
                                                            <b>Numero de telephone : </b>?{{ $item->Phone }}?<br>
                                                            <b>Ville : </b>{{ $item->ville }}<br>
                                                            <b>Adresse : </b>{{ $item->adress }}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <div class="btn-group" role="group">
                                                                <a href="{{ route('accept.profile.livreur', $item->id_Liv) }}"  class="btn btn-primary">
                                                                        <i class="fa fa-plus"></i>
                                                                </a>
                                                                <form action="{{ route('deletelivreur', $item->id_Liv) }}" method="POST">
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

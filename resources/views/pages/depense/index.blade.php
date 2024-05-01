@extends('layouts.admin.admin')
@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Ajouter<!--5-->
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('depense.store') }}" method="POST" id="">
                                        @csrf
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                <span class="required">Depense ( Titre )</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Specify a target name for future usage and reference"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Depense ( Titre )" value="{{old('depense')}}" id="depense" name="depense" />
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                <span class="required">Description du depense</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Specify a target name for future usage and reference"></i>
                                            </label>
                                            <textarea class="form-control form-control-solid" name="description" rows="1"
                                                placeholder="Description du depense" >{{old('description')}}</textarea>
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                <span class="required">Montant depense</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Specify a target name for future usage and reference"></i>
                                            </label>
                                            <input type="number" min="0" class="form-control form-control-solid"
                                                name="montant" value="{{old('montant')}}" placeholder="Montant depense">
                                        </div>
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                <span class="required">Date de depense</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                    title="Specify a target name for future usage and reference"></i>
                                            </label>
                                            <input type="date" class="form-control form-control-solid" name="datedep"
                                                value="{{old('datedep')}}" placeholder="Date de depense">

                                        </div>
                                        <div class="form-actions">
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-info">Ajouter</button>
                                                <button type="reset" class="btn btn-dark">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Les depenses<!--5-->
                                    </h5>
                                </div>

                                <div class="card-body">

                                    <div id="spents_table_json_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                                <div class="dataTables_length" id="spents_table_json_length"><label>Afficher
                                                        <select name="spents_table_json_length"
                                                            aria-controls="spents_table_json" class="form-control input-sm">
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                            <option value="200">200</option>
                                                            <option value="500">500</option>
                                                            <option value="-1">All</option>
                                                        </select> entrees par page</label></div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <div id="spents_table_json_filter" class="dataTables_filter">
                                                    <label>Rechercher :<input type="search" class="form-control input-sm"
                                                            placeholder="" aria-controls="spents_table_json"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <table id="spents_table_json"
                                                    class="table table-striped table-bordered table-sm mb-0 no-footer dataTable"
                                                    role="grid" aria-describedby="spents_table_json_info"
                                                    style="width: 726px;">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="spents_table_json" rowspan="1"
                                                                colspan="1" style="width: 33.5333px;"
                                                                aria-label="Titre: activate to sort column ascending">Titre
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="spents_table_json" rowspan="1"
                                                                colspan="1" style="width: 80.5333px;"
                                                                aria-label="Description: activate to sort column ascending">
                                                                Description</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="spents_table_json" rowspan="1"
                                                                colspan="1" style="width: 61.5333px;"
                                                                aria-label="Montant: activate to sort column ascending">
                                                                Montant</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="spents_table_json" rowspan="1"
                                                                colspan="1" style="width: 116.533px;"
                                                                aria-label="Date de depense: activate to sort column ascending">
                                                                Date de depense</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="spents_table_json" rowspan="1"
                                                                colspan="1" style="width: 86.5333px;"
                                                                aria-label="Date d ajout: activate to sort column ascending">
                                                                Date d ajout</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="spents_table_json" rowspan="1"
                                                                colspan="1" style="width: 72.5333px;"
                                                                aria-label="Action par: activate to sort column ascending">
                                                                Action par</th>
                                                            <th class="no-sort sorting_disabled" tabindex="0"
                                                                aria-controls="spents_table_json" rowspan="1"
                                                                colspan="1" style="width: 52.4px;"
                                                                aria-label="Actions">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($depenses as $depense)
                                                            <tr id="spent-157" role="row" class="odd">
                                                                <td>{{ $depense->depense }}</td>
                                                                <td>{{ $depense->description }}</td>
                                                                <td>{{ $depense->montant }}</td>
                                                                <td>{{ $depense->datedep }}</td>
                                                                <td>{{ $depense->created_at->format('Y-m-d') }}</td>
                                                                {{-- <td>{{$depense->user->email}}</td> --}}
                                                                <td><a href="javascript:ajaxLink('spent?action=delete-spent&amp;spent-id=157');"
                                                                        data-tooltip="Supprimer"
                                                                        class="btn btn-sm btn-danger"><i
                                                                            class="fa fa-trash"></i></a></td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                <div id="spents_table_json_processing"
                                                    class="dataTables_processing panel panel-default"
                                                    style="display: none;">Processing...</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-5">
                                                <div class="dataTables_info" id="spents_table_json_info" role="status"
                                                    aria-live="polite">Affichage 1 a 1 de 1 entrees</div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-7">
                                                <div class="dataTables_paginate paging_simple_numbers"
                                                    id="spents_table_json_paginate">
                                                    <ul class="pagination">
                                                        <li class="paginate_button page-item previous disabled"
                                                            id="spents_table_json_previous"><a href="#"
                                                                aria-controls="spents_table_json" data-dt-idx="0"
                                                                tabindex="0" class="page-link">Precedent</a></li>
                                                        <li class="paginate_button page-item active"><a href="#"
                                                                aria-controls="spents_table_json" data-dt-idx="1"
                                                                tabindex="0" class="page-link">1</a></li>
                                                        <li class="paginate_button page-item next disabled"
                                                            id="spents_table_json_next"><a href="#"
                                                                aria-controls="spents_table_json" data-dt-idx="2"
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
            </div>
        </div>

        {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"> --}}
        {{-- <script>
            $(document).ready(function() {

                var start = moment("20200621");
                var end = moment();

                var NstartDate = moment().startOf('month');
                var NendDate = moment().endOf('month');


                $('#data_from').daterangepicker({
                    startDate: moment().startOf('month'),
                    endDate: moment().endOf('month'),
                    ranges: {
                        'Depuis le lancement': [start, end],
                        "Aujourd hui": [moment(), moment()],
                        'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '7 derniers jours': [moment().subtract(6, 'days'), moment()],
                        '30 derniers jours': [moment().subtract(29, 'days'), moment()],
                        'Ce mois': [moment().startOf('month'), moment().endOf('month')],
                        'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    }
                }, function(NstartDate, NendDate) {
                    tableDataJson_Spents('spents_table_json', NstartDate.format('YYYY-MM-DD'), NendDate.format(
                        'YYYY-MM-DD'));
                });
                $("#data_from span").html(NstartDate.format('YYYY-MM-DD') + ' - ' + NendDate.format('YYYY-MM-DD'));
                tableDataJson_Spents('spents_table_json', NstartDate.format('YYYY-MM-DD'), NendDate.format(
                    'YYYY-MM-DD'));



            });
        </script> --}}
    </div>
@endsection

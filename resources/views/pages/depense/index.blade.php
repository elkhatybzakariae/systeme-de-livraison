@extends('layouts.admin.admin')
@section('style')
    <style>
        .card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            flex-wrap: wrap;
            min-height: 1px;
            padding: 0 2.25rem;
            color: var(--bs-card-cap-color);
            background-color: var(--bs-card-cap-bg);
            border-bottom: var(--bs-border-width) solid var(--bs-card-border-color);
        }
    </style>
@endsection
@section('content')
{{-- @dd(session('user'));  --}}
    <div class="page-body">
        <div class="row">
<<<<<<< HEAD
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
=======
            <div class="col-4">
                    <div class="card">
                        <div class="card-header mt-4 ">
                            <h5>Ajouter </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('depense.store') }}" method="POST" id="editForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 m-auto">
                                        <div class="form-group">
                                            <label>Depense ( Titre )</label>
                                            <input type="text" class="form-control" name="depense" id="depense" value=""
                                                placeholder="Depense ( Titre )">
>>>>>>> b106ab8084597955a7b2b8c9289148e6eea500bc
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label>Description du depense</label>
                                            <textarea class="form-control" name="description" id="description" rows="1" placeholder="Description du depense"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-12 m-auto">
                                        <div class="form-group">
                                            <label>Montant depense</label>
                                            <input type="number" min="0" class="form-control" id="montant" name="montant"
                                                value="" placeholder="Montant depense">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-12 m-auto">
                                        <div class="form-group">
                                            <label>Date de depense</label>
                                            <input type="date" class="form-control" id="datedep" name="datedep" value=""
                                                placeholder="Date de depense">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="text-right">
                                        <button type="submit" id="btn" class="btn btn-info">Ajouter</button>
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
            </div>
            <div class="col-8">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header mt-4">
                                    <h5>Les depenses<!--5-->
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div  class=" dt-bootstrap4 no-footer">
                                        <table class="table table-striped    dataTable"
                                            role="grid" aria-describedby="spents_table_json_info"
                                            style="width: 726px;">
                                            <thead>
                                                <tr role="row">
                                                    <th >Titre</th>
                                                    <th >Description</th>
                                                    <th >Montant</th>
                                                    <th >Date de depense</th>
                                                    <th >Date d ajout</th>
                                                    {{-- <th >Action par</th> --}}
                                                    <th >Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($depenses as $depense)
                                                    <tr id="spent-157" role="row" class="odd">
                                                    <td>{{$depense->depense}}</td>
                                                    <td>{{$depense->description}}</td>
                                                    <td>{{$depense->montant}}</td>
                                                    <td>{{$depense->datedep}}</td>
                                                    <td>{{$depense->created_at->format('Y-m-d') }}</td>
                                                    {{-- <td>{{$depense->user->email}}</td> --}}
                                                    <td> <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                <path fill="#8d98af"
                                                                    d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z" />
                                                            </svg>
                                                        </span>
                                                        {{-- <span class="svg-icon svg-icon-5 m-0">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                            </svg>
                                                        </span> --}}
                                                        </a>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3" onclick="editExpense('{{ $depense->depense }}', '{{ $depense->description }}', {{ $depense->montant }}, '{{ $depense->datedep }}','{{ route('depense.update',$depense->id_Dep) }}')">Edit</a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            <form action="{{ route('depense.destroy',$depense->id_Dep) }}" 
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <input type="submit" class="menu-link px-3 btn text-danger" data-kt-ecommerce-product-filter="delete_row" value="delete">
                                                            </form>
                                                        </div>
                                                        </div></td>
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
    <script>
        function editExpense( depense, description, montant, datedep ,route) {
            document.getElementById('depense').value = depense;
            document.getElementById('description').value = description;
            document.getElementById('montant').value = montant;
            document.getElementById('datedep').value = datedep;
            document.getElementById('btn').innerHTML = 'Modifier';
            // Optionally, you can set the form action to the update route with the expense ID
            document.getElementById('editForm').action = route;
        }
        function reset(){
            document.getElementById('btn').innerHTML = 'Modifier';
            // Optionally, you can set the form action to the update route with the expense ID
            document.getElementById('editForm').action = "{{ route('depense.store') }}";

        }
    </script>

    
@endsection

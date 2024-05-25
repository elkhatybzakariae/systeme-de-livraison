@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mb-5 justify-content-center text-center">
            <div class="col-md-7">
                <div class="block-heading-1 aos-init aos-animate" data-aos="fade-up" data-aos-delay="">
                    <h2>Zones De Livraison Et Tarifs</h2>
                </div>
            </div>
        </div>

        <div class="table-responsive">

            <div id="example_wrapper" class="dataTables_wrapper no-footer">
                <div class="dataTables_length" id="example_length"><label>Show <select name="example_length"
                            aria-controls="example" class="" style="display: none;">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <div class="nice-select" tabindex="0"><span class="current">50</span>
                            <ul class="list">
                                <li data-value="10" class="option">10</li>
                                <li data-value="25" class="option">25</li>
                                <li data-value="50" class="option selected">50</li>
                                <li data-value="100" class="option">100</li>
                            </ul>
                        </div> entries
                    </label></div>
                <div id="example_filter" class="dataTables_filter"><label>Search:<input type="search" class=""
                            placeholder="" aria-controls="example"></label></div>
                <table id="example" class="table table-bordered text-nowrap key-buttons dataTable no-footer"
                    aria-describedby="example_info">
                    <thead>
                        <tr>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="example" rowspan="1"
                                colspan="1" aria-label="Ville Ramassage: activate to sort column ascending"
                                style="width: 234.667px;">
                                Ville Ramassage</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="example" rowspan="1"
                                colspan="1" aria-label="Villes: activate to sort column ascending"
                                style="width: 234.667px;">
                                Villes</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="example" rowspan="1"
                                colspan="1" aria-label="Frais De Livraison: activate to sort column ascending"
                                style="width: 183.667px;">Frais De Livraison</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="example" rowspan="1"
                                colspan="1" aria-label="Frais De Retour: activate to sort column ascending"
                                style="width: 158.667px;">Frais De Retour</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="example" rowspan="1"
                                colspan="1" aria-label="Délai Livraison: activate to sort column ascending"
                                style="width: 158.667px;">Délai Livraison</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tarifs as $item)
                            <tr id="{{ $item->id_Tar }}" class="odd">
                                <td>{{$item->villleRamassage->villename}}</td>
                                <td>{{$item->villle->villename}}</td>
                                <td>{{$item->prixliv}}</td>
                                <td>{{$item->prixret}}</td>
                                <td>{{$item->delailiv}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table><br><br>
            </div>
        </div>

    </div>
@endsection

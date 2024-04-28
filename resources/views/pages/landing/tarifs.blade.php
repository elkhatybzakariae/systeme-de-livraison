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
                <div id="example_filter" class="dataTables_filter"><label>Search:<input type="search"
                            class="" placeholder="" aria-controls="example"></label></div>
                <table id="example" class="table table-bordered text-nowrap key-buttons dataTable no-footer"
                    aria-describedby="example_info">
                    <thead>
                        <tr>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="example"
                                rowspan="1" colspan="1"
                                aria-label="Villes: activate to sort column ascending" style="width: 234.667px;">
                                Villes</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="example"
                                rowspan="1" colspan="1"
                                aria-label="Frais De Livraison: activate to sort column ascending"
                                style="width: 183.667px;">Frais De Livraison</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="example"
                                rowspan="1" colspan="1"
                                aria-label="Frais De Retour: activate to sort column ascending"
                                style="width: 158.667px;">Frais De Retour</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="city-MKR" class="odd">
                            <td>Marrakech</td>
                            <td> 25 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-CAS" class="even">
                            <td>casablanca</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-SET" class="odd">
                            <td>SETTAT</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-MHD" class="even">
                            <td>Mohammedia</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-RAB" class="odd">
                            <td>Rabat</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-SAL" class="even">
                            <td>Sale</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-KEN" class="odd">
                            <td>Kenitra</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-DAK" class="even">
                            <td>Dakhla</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-LAAY" class="odd">
                            <td>Laayoune</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-SAF" class="even">
                            <td>Safi</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-BOU" class="odd">
                            <td>Boujdour</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-DAR" class="even">
                            <td>Dar Bouazza</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-ELJ" class="odd">
                            <td>El Jadida</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-OUA" class="even">
                            <td>Oualidia</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-ESS" class="odd">
                            <td>Essaouira</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-AMZ" class="even">
                            <td>Amzmiz</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-AGD" class="odd">
                            <td>Agadir</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-AIM" class="even">
                            <td>Ait Melloul</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-BOI" class="odd">
                            <td>Bouizakarne</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-MIR" class="even">
                            <td>Mirleft</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-SIF" class="odd">
                            <td>Sidi Ifni</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-GUE" class="even">
                            <td>Guelmim</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-TAN" class="odd">
                            <td>TanTan</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-LAA" class="even">
                            <td>Laattaouia</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-TER" class="odd">
                            <td>Terfaya</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-AIN" class="even">
                            <td>AinAouda</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-ALH" class="odd">
                            <td>Al Hoceima</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-BEN" class="even">
                            <td>Beni Mellal</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-FES" class="odd">
                            <td>Fes</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-FNI" class="even">
                            <td>Fnideq</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-FBS" class="odd">
                            <td>Fquih Ben Salah</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-INZ" class="even">
                            <td>Inzegane</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-KAS" class="odd">
                            <td>Kasba Tadla</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-KHO" class="even">
                            <td>Khouribga</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-KSA" class="odd">
                            <td>Ksar El Kebir</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-LAR" class="even">
                            <td>Larache</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-MDI" class="odd">
                            <td>MDiq</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-MAR" class="even">
                            <td>Martil</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-MEK" class="odd">
                            <td>Meknes</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-NAD" class="even">
                            <td>Nador</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-OUA" class="odd">
                            <td>Ouarzazat</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-AIN" class="even">
                            <td>Ain Harouda</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-SAL" class="odd">
                            <td>Sale El Jadida</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-SKI" class="even">
                            <td>Skhirat</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-CAB" class="odd">
                            <td>Cabo Negro</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-TAM" class="even">
                            <td>Tamesna</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-TAN" class="odd">
                            <td>Tanger</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-TAZ" class="even">
                            <td>Taza</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-TEM" class="odd">
                            <td>Temara</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                        <tr id="city-TET" class="even">
                            <td>Tetouan</td>
                            <td> 35 DH</td>

                            <td> Gratuit</td>

                        </tr>
                    </tbody>
                </table>
                {{-- <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 1 to 50
                    of 261 entries</div>
                <div class="dataTables_paginate paging_simple_numbers" id="example_paginate"><a
                        class="paginate_button previous disabled" aria-controls="example" data-dt-idx="0"
                        tabindex="-1" id="example_previous">Previous</a><span><a class="paginate_button current"
                            aria-controls="example" data-dt-idx="1" tabindex="0">1</a><a
                            class="paginate_button " aria-controls="example" data-dt-idx="2"
                            tabindex="0">2</a><a class="paginate_button " aria-controls="example"
                            data-dt-idx="3" tabindex="0">3</a><a class="paginate_button "
                            aria-controls="example" data-dt-idx="4" tabindex="0">4</a><a
                            class="paginate_button " aria-controls="example" data-dt-idx="5"
                            tabindex="0">5</a><a class="paginate_button " aria-controls="example"
                            data-dt-idx="6" tabindex="0">6</a></span><a class="paginate_button next"
                        aria-controls="example" data-dt-idx="7" tabindex="0" id="example_next">Next</a>
                </div> --}}
            </div>
        </div>

    </div>

@endsection

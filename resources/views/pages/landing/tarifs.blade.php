@extends('layouts.app')
@section('breads')
@endsection
@section('content')
    <div class="container" style="margin-top: 14.2rem">
        <div class="row mb-5 justify-content-center text-center">
            <div class="col-md-7">
                <div class="block-heading-1 aos-init aos-animate" data-aos="fade-up" data-aos-delay="">
                    <h2>Zones De Livraison Et Tarifs</h2>
                </div>
            </div>
        </div>
        <form id="filterForm" class="form w-100 row gx-2 gy-2">
            <div class="col-auto">
                <label class="form-label" for="filterVilleRamassage">Filter Ville Ramassage:</label>
                <input type="text" name="filterVilleRamassage" id="filterVilleRamassage" placeholder="Search Ville Ramassage" class="form-control" />
            </div>
            <div class="col-auto">
                <label class="form-label" for="filterVilles">Filter Villes:</label>
                <input type="text" name="filterVilles" id="filterVilles" placeholder="Search Villes" class="form-control" />
            </div>
            <div class="col-auto d-flex align-items-end">
                <input type="button" id="click" value="Rechercher" class="btn btn-primary">
            </div>
        </form>
        <br><br><br>

        <div class="table-responsive">

            <div id="example_wrapper" class="dataTables_wrapper no-footer">



                {{-- <div id="example_filter" class="dataTables_filter"><label>Search:<input type="search" class=""
                            placeholder="" aria-controls="example"></label>
                        </div> --}}
                {{-- <div id="filters">
                            <label for="filterVilleRamassage">Filter Ville Ramassage:</label>
                            <input type="text" id="filterVilleRamassage" placeholder="Search Ville Ramassage">
                            
                            <label for="filterVilles">Filter Villes:</label>
                            <input type="text" id="filterVilles" placeholder="Search Villes">
                        </div>
                         --}}


            </div>
            <table id="table" class="table table-bordered text-nowrap key-buttons dataTable no-footer"
                aria-describedby="example_info">

            </table><br><br>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the form and the button
            var form = document.getElementById('filterForm');
            var button = document.getElementById('click');
            var table = document.getElementById('table');

            // Add event listener to the button
            button.addEventListener('click', function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Collect the form data
                var formData = new FormData(form);

                // Convert FormData to a query string
                var queryString = new URLSearchParams(formData).toString();

                // Send the AJAX request
                fetch('{{ route('tarifs.all') }}?' + queryString, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        let tableHTML = `
                    <thead>
                        <tr>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="example" rowspan="1"
                                colspan="1" aria-label="Ville Ramassage: activate to sort column ascending"
                                style="width: 234.667px;">Ville Ramassage</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="example" rowspan="1"
                                colspan="1" aria-label="Villes: activate to sort column ascending"
                                style="width: 234.667px;">Villes</th>
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
                    <tbody>`;

                        // Loop through the data and build the table rows
                        data.forEach(item => {
                            tableHTML += `
                        <tr id="${item.id_Tar}" class="odd">
                            <td>${item.villle_ramassage.villename}</td>
                            <td>${item.villle.villename}</td>
                            <td>${item.prixliv}</td>
                            <td>${item.prixret}</td>
                            <td>${item.delailiv}</td>
                        </tr>`;
                        });

                        tableHTML += '</tbody>';

                        // Update the table's innerHTML
                        table.innerHTML = tableHTML;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection

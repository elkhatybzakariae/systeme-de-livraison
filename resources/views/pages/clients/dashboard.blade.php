@extends('layouts.client.admin')
@section('breads')
    <x-breadcrumb :breads="$breads" />
@endsection
@section('content')
    <style>
        table {
            color: #14a1f3
        }
    </style>
     @foreach ($remarques as $remarque )
       
       <div class="alert @if ($remarque->type=='Urgence')
         alert-danger
         @elseif ($remarque->type=='Important')
           alert-warning
         @elseif ($remarque->type=='Information')
           alert-primary
         @endif  
         alert-dismissible fade show" role="alert">
         <strong>{{ $remarque->type }}</strong> {{ $remarque->remarque }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endforeach
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                    <div class="card-body d-flex justify-content-between align-items">
                        <span class="svg-icon fs-1">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#87b6fc"
                                    d="M50.7 58.5L0 160H208V32H93.7C75.5 32 58.9 42.3 50.7 58.5zM240 160H448L397.3 58.5C389.1 42.3 372.5 32 354.3 32H240V160zm208 32H0V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192z" />
                            </svg>
                        </span>

                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                            <div class="d-flex flex-column">
                                <span class="me-2">Colis</span>
                                <span class="me-2 text-end">{{ $colis }}</span>
                            </div>
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                    <div class="card-body d-flex justify-content-between align-items">
                        <span class="svg-icon fs-1">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#0b0d8a"
                                    d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H288V368c0-26.5 21.5-48 48-48H448V96c0-35.3-28.7-64-64-64H64zM448 352H402.7 336c-8.8 0-16 7.2-16 16v66.7V480l32-32 64-64 32-32z" />
                            </svg>
                        </span>

                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                            <div class="d-flex flex-column">
                                <span class="me-2">Bon Livraison</span>
                                <span class="me-2 text-end">{{ $liv }}</span>
                            </div>
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                    <div class="card-body d-flex justify-content-between align-items">
                        <span class="svg-icon fs-1">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#e69e4c"
                                    d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V288H216c-13.3 0-24 10.7-24 24s10.7 24 24 24H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zM384 336V288H494.1l-39-39c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l80 80c9.4 9.4 9.4 24.6 0 33.9l-80 80c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l39-39H384zm0-208H256V0L384 128z" />
                            </svg>
                        </span>

                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                            <div class="d-flex flex-column">
                                <span class="me-2">Bon Reteur</span>
                                <span class="me-2 text-end">{{ $retourC }}</span>
                            </div>
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                    <div class="card-body d-flex justify-content-between align-items">
                        <span class="svg-icon fs-1">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#e69e4c"
                                    d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5 .1 0 0 0 0c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16V422.2c-11.2-2.1-21.7-5.7-30.9-8.9l0 0 0 0c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5 .8 4.8 1.6 7.1 2.4l0 0 0 0 0 0c13.6 4.6 24.6 8.4 36.3 8.7c9.1 .3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5 0 0c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z" />
                            </svg>
                        </span>

                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                            <div class="d-flex flex-column">
                                <span class="me-2">Factures</span>
                                <span class="me-2 text-end">{{ $fact }}</span>
                            </div>
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                    <div class="card-body d-flex justify-content-between align-items">
                        <span class="svg-icon fs-1">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#18cc54"
                                    d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                            </svg>
                        </span>

                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                            <div class="d-flex flex-column">
                                <span class="me-2">Reclamations</span>
                                <span class="me-2 text-end">{{ $rec }}</span>
                            </div>
                        </span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                    <div class="card-body d-flex justify-content-between align-items">
                        <span class="svg-icon fs-1">
                           <i class="fa fa-pen text-success"></i>
                        </span>

                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                            <div class="d-flex flex-column">
                                <span class="me-2">Modification Colis</span>
                                <span class="me-2 text-end">{{ $rec }}</span>
                            </div>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row  gap-5">

        <div class="card col-md-12 mt-5">
          <div class="card-header">
            <span class="svg-icon fs-1">
              <svg xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                  <path fill="#87b6fc"
                      d="M50.7 58.5L0 160H208V32H93.7C75.5 32 58.9 42.3 50.7 58.5zM240 160H448L397.3 58.5C389.1 42.3 372.5 32 354.3 32H240V160zm208 32H0V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192z" />
              </svg>
            </span>
            
            <h4 class="card-title">Colis Statistics ( {{ $colis }} )</h4></div>
          <div class="card-body">
            <canvas id="colisChart" width="400" height="200"></canvas>
            
          </div>
        </div>
        <div class="card col-md-5 mt-5 mx-5">
          <div class="card-header d-flex justify-content-center align-items-center">
            
            <span class="svg-icon">
              <svg xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                  <path fill="#0b0d8a"
                      d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H288V368c0-26.5 21.5-48 48-48H448V96c0-35.3-28.7-64-64-64H64zM448 352H402.7 336c-8.8 0-16 7.2-16 16v66.7V480l32-32 64-64 32-32z" />
              </svg>
            </span>
            <h4 class="card-title">Bon Livraisons( {{ $liv }} ) </h4></div>
      
          <div class="card-body">
            @if (count($countsBL)==0)
              <div class="d-flex justify-content-center align-items-center w-100 h-100" style="width:200px;height:400px">
                <h4 class="text-center text-secondary">Aucun bon de Livraison</h4>
              </div>
            @else
            <canvas id="bonLivraisonsChart" width="400" height="200"></canvas>
            @endif
          </div>
        </div>
        <div class="card col-md-5 mt-5 mx-5">
          <div class="card-header d-flex justify-content-center align-items-center">
            
            <span class="svg-icon">
              <svg xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                  <path fill="#0b0d8a"
                      d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H288V368c0-26.5 21.5-48 48-48H448V96c0-35.3-28.7-64-64-64H64zM448 352H402.7 336c-8.8 0-16 7.2-16 16v66.7V480l32-32 64-64 32-32z" />
              </svg>
            </span>
            <h4 class="card-title">Bon Retour Client( {{ $liv }} ) </h4></div>
      
          <div class="card-body">
            @if (count($countsBRC)==0)
              <div class="d-flex justify-content-center align-items-center w-100 h-100" style="width:200px;height:400px">
                <h4 class="text-center text-secondary">Aucun bon de Retour</h4>
              </div>
            @else
            <canvas id="bonRChart" width="400" height="200"></canvas>
            @endif
          </div>
        </div>
        <div class="card col-md-5 mt-5 mx-5">
          <div class="card-header d-flex justify-content-center align-items-center">
            
            <span class="svg-icon">
              <svg xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                  <path fill="#0b0d8a"
                      d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H288V368c0-26.5 21.5-48 48-48H448V96c0-35.3-28.7-64-64-64H64zM448 352H402.7 336c-8.8 0-16 7.2-16 16v66.7V480l32-32 64-64 32-32z" />
              </svg>
            </span>
            <h4 class="card-title">Reclamation( {{ $liv }} ) </h4></div>
      
          <div class="card-body">
            @if (count($countsR)==0)
              <div class="d-flex justify-content-center align-items-center w-100 h-100" style="width:200px;height:400px" >
                <h4 class="text-center text-secondary">Aucun Reclamation</h4>
              </div>
            @else
            <canvas id="reclamation" width="400" height="200"></canvas>
            @endif
          </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('colisChart').getContext('2d');
            var colisChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($statuses),
                    datasets: [{
                        label: 'Colis Count',
                        data: @json($counts),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('bonLivraisonsChart').getContext('2d');
            var bonLivraisonsChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($statusesBL),
                    datasets: [{
                        label: 'Bon Livraisons Count',
                        data: @json($countsBL),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
        // document.addEventListener('DOMContentLoaded', function () {
        //     var ctx = document.getElementById('bonRChart').getContext('2d');
        //     var bonLivraisonsChart = new Chart(ctx, {
        //         type: 'doughnut',
        //         data: {
        //             labels: @json($statusesBRC),
        //             datasets: [{
        //                 label: 'Bon Retour Count',
        //                 data: @json($countsBRC),
        //                 backgroundColor: [
        //                     'rgba(255, 99, 132, 0.2)',
        //                     'rgba(54, 162, 235, 0.2)',
        //                     'rgba(255, 206, 86, 0.2)',
        //                     'rgba(75, 192, 192, 0.2)',
        //                     'rgba(153, 102, 255, 0.2)',
        //                     'rgba(255, 159, 64, 0.2)'
        //                 ],
        //                 borderColor: [
        //                     'rgba(255, 99, 132, 1)',
        //                     'rgba(54, 162, 235, 1)',
        //                     'rgba(255, 206, 86, 1)',
        //                     'rgba(75, 192, 192, 1)',
        //                     'rgba(153, 102, 255, 1)',
        //                     'rgba(255, 159, 64, 1)'
        //                 ],
        //                 borderWidth: 1
        //             }]
        //         },
        //         options: {
        //             responsive: true
        //         }
        //     });
        // });
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('reclamation').getContext('2d');
            var bonLivraisonsChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($statusesR),
                    datasets: [{
                        label: 'Reclamations Count',
                        data: @json($countsR),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
    </script>
@endsection

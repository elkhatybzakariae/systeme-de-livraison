@extends('layouts.livreur.admin')
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
           
            @foreach ($colisStatus as $item )
      
            <div class="col-md-3 mb-4">
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
                        <span class="me-2">{{ $item->status }}</span>
                        <span class="me-2 text-end">{{ $item->total }}</span>
                        </div>
                    </span>
                </div>
            </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row  gap-5">

        <div class="card col-md-12 mt-5">
          <div class="card-header">
            <h4 class="card-title "  > 
                <div class="d-flex justify-content-between align-items-center">
                    <span class="svg-icon fs-1">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#87b6fc"
                                d="M50.7 58.5L0 160H208V32H93.7C75.5 32 58.9 42.3 50.7 58.5zM240 160H448L397.3 58.5C389.1 42.3 372.5 32 354.3 32H240V160zm208 32H0V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192z" />
                        </svg>
                    </span>
                    <div>
                        Colis Statistics (  )
                    </div>
                </div>
                
            </h4></div>
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
            <h4 class="card-title">Bon Distribution(  ) </h4></div>
      
          <div class="card-body">
            @if (count($countsBD)==0)
              <div class="d-flex justify-content-center align-items-center w-100 h-100" style="width:200px;height:400px">
                <h4 class="text-center text-secondary">Aucun bon de Livraison</h4>
              </div>
            @else
            <canvas id="bd" width="400" height="200"></canvas>
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
            <h4 class="card-title">Bon Retour Client(  ) </h4></div>
      
          <div class="card-body">
            @if (count($countsBRL)==0)
              <div class="d-flex justify-content-center align-items-center w-100 h-100" style="width:200px;height:400px">
                <h4 class="text-center text-secondary">Aucun bon de Retour</h4>
              </div>
            @else
            <canvas id="brl" width="400" height="200"></canvas>
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
            <h4 class="card-title">Bon Payment Livreur(  ) </h4></div>
      
          <div class="card-body">
            @if (count($countsBPL)==0)
              <div class="d-flex justify-content-center align-items-center w-100 h-100" style="width:200px;height:400px" >
                <h4 class="text-center text-secondary">Aucun Bon</h4>
              </div>
            @else
            <canvas id="bpl" width="400" height="200"></canvas>
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
            var ctx = document.getElementById('bd').getContext('2d');
            var bonLivraisonsChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($statusesBD),
                    datasets: [{
                        label: 'Bon Distribution Count',
                        data: @json($countsBD),
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
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('brl').getContext('2d');
            var bonLivraisonsChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($statusesBRL),
                    datasets: [{
                        label: 'Bon Distribution Count',
                        data: @json($countsBRL),
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
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('bpl').getContext('2d');
            var bonLivraisonsChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($statusesBPL),
                    datasets: [{
                        label: 'Bon Distribution Count',
                        data: @json($countsBPL),
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

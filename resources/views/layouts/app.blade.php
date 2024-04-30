<!DOCTYPE html>
<html dir="ws_config_dir" lang="ws_config_lang">

<head>
    <style>
        :root {
            /* --main-color: #2e7d32; */
            --main-color: #202b46;
            /* Main green color */
            --second-color: #388e3c;
            /* Lighter shade of green */
            --third-color: #43a047;
            /* Lightest shade of green */
            --fourth-color: #1b5e20;
            /* Darker shade of green */
            --fifth-color: #1b5e20;
            /* Another darker shade of green */
            --hover-color: #388e3c;
            /* Hover color, lighter shade of green */
            --focus-color: #2e7d32;
            /* Focus color, main green color */
        }
    </style>
    <title>Accueil - livraison </title>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description"
        content="livraison est la nouvelle solution d'expédition pour gérer vos livraisons en ligne. Donnez à votre entreprise en ligne un avantage concurrentiel grâce aux solutions de livraison sur mesure de commerce électronique de livraison." />
    <meta name="keywords" content="" />
    <link rel="icon" href="https://cdn.vitex.ma/images/company/1702590775-780-1651191227-530-icone siteweb.jpeg"
        sizes="16x16" type="image/png">
    <link rel="icon" href="https://cdn.vitex.ma/images/company/1702590775-780-1651191227-530-icone siteweb.jpeg"
        sizes="16x16 32x32" type="image/png">



    <meta name="author" content="Digixel.ma" />

    <!-- keywords -->
    <meta name="keywords"
        content="livraison à domicile maroc,livraison à domicile,livraison Maroc,livraison Agadir,For livraison,ForLivraison, livraison, amana livraison, Oubratra , Livraison,coursier,coursier maroc casa,coursier rapide,service coursier,livraison,tournee programee,courises expresse,delivery maroc,Service Livraison et Ramassage">
    <!-- favicon -->
    <meta name="title" content="livraison est la nouvelle solution d'expédition pour gérer vos livraisons en ligne" />
    <meta property="og:title"
        content="livraison est la nouvelle solution d'expédition pour gérer vos livraisons en ligne" />
    <meta property="og:description"
        content="livraison œuvre avec rapidité et agilité et assure une distribution transparente de bout en bout avec passion et engagement." />
    <meta property="og:image" content="https://cdn.vitex.ma/images/logo.png" />
    <meta property="og:url" content="https://cdn.vitex.ma/" />
    <meta property="og:type" content="page" />
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/bootstrap.min.css') }}">
    <!-- Owl Theme Default CSS -->

    <link rel="stylesheet" href="https://cdn.vitex.ma/assets/home-page/css/boxicons.min.css"> 
    <!-- Flaticon CSS -->
     <link rel="stylesheet" href="https://cdn.vitex.ma/assets/home-page/css/flaticon.css">
     <link href="{{ asset('storage/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('storage/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
   

    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/owl.theme.default.min.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/owl.carousel.min.css') }}">
    <!-- Owl Magnific CSS -->
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/magnific-popup.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/animate.css') }}">
    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/boxicons.min.css') }}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/flaticon.css') }}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/meanmenu.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/nice-select.css') }}">
    <!-- Odometer CSS-->
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/odometer.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/responsive.css') }}">
    <link href="{{ asset('storage/styles/styles-ws.css') }}" rel="stylesheet" />
    <!-- Favicon -->
    <link rel="stylesheet" href="{{ asset('storage/assets/main-page/css/aos.css') }}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('storage/assets/main-page/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/floatingapp.css') }}">
    <style>


    </style>
    
    @yield('style')
</head>




<body>
    <div id="bg-res"></div>
    <div id="result-ajax"></div>
    <div id="result"></div>

    <div id="page-iframe-box">
        <div id="page-iframe-in">
            <div id="page-iframe-header">
                <div id="page-iframe-header-btns">
                    <a href="javascript:closeIframeBox();"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div id="page-iframe-content"></div>
        </div>
    </div>
    <div class="modal fade" id="ajaxResultModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><!----></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <!-- Start Preloader Area -->
    <div class="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- End Preloader Area -->

    <!-- Start Preloader Area -->
    <div id="loading" class="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- End Preloader Area -->

    @include('components.includes.header')



    <!-- Start Sidebar Modal -->
    @include('pages.landing.includes.modal')
    <!-- End Sidebar Modal -->

    @yield('content')






    <div id="myButton"></div>

    @include('components.includes.footer')
    <!-- Start Go Top Area -->
    <div class="go-top">
        <i class='bx bx-chevrons-up bx-fade-up'></i>
        <i class='bx bx-chevrons-up bx-fade-up'></i>
    </div>
    <!-- End Go Top Area -->

    </div>
    <!-- Jquery Slim JS -->
    <script src="{{ asset('storage/assets/home-page/js/jquery.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('storage/assets/home-page/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('storage/assets/home-page/js/bootstrap.min.js') }}"></script>
    <!-- Meanmenu JS -->
    <script src="{{ asset('storage/assets/home-page/js/jquery.meanmenu.js') }}"></script>
    <!-- Wow JS -->
    <script src="{{ asset('storage/assets/home-page/js/wow.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('storage/assets/home-page/js/owl.carousel.js') }}"></script>
    <!-- Owl Magnific JS -->
    <script src="{{ asset('storage/assets/home-page/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('storage/assets/home-page/js/jquery.nice-select.min.js') }}"></script>
    <!-- Appear JS -->
    <script src="{{ asset('storage/assets/home-page/js/jquery.appear.js') }}"></script>
    <!-- Odometer JS -->
    <script src="{{ asset('storage/assets/home-page/js/odometer.min.js') }}"></script>
    <!-- Parallax JS -->
    <script src="{{ asset('storage/assets/home-page/js/parallax.min.js') }}"></script>
    <!-- Form Ajaxchimp JS -->
    <script src="{{ asset('storage/assets/home-page/js/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Form Validator JS -->
    <script src="{{ asset('storage/assets/home-page/js/form-validator.min.js') }}"></script>
    <!-- Contact JS -->
    <script src="{{ asset('storage/assets/home-page/js/contact-form-script.js') }}"></script>
    <!-- Map JS FILE -->
    <script src="{{ asset('storage/assets/home-page/js/map.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('storage/assets/home-page/js/custom.js') }}"></script>

    <script type="text/javascript" src="{{ asset('storage/javascript/jquery-form.js') }}"></script>

    <script src="{{ asset('storage/javascript/bootstrap-select.js') }}"></script>
    <script src="{{ asset('storage/assets/main-page/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('storage/assets/main-page/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('storage/assets/main-page/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('storage/assets/main-page/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('storage/assets/main-page/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('storage/assets/main-page/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('storage/assets/main-page/js/aos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('storage/javascript/javascript-ws.js') }}"></script>
    <script type="text/javascript" src="{{ asset('storage/assets/home-page/js/floatingapp.js') }}"></script>
    <script>
        $("#myButton").floatingWhatsApp({
            phone: "+212600000000",
            popupMessage: "Bienvenue sur livraison, comment puis-je vous aider ?",
            message: "Salut livraison",
            showPopup: true,
            showOnIE: true,
            headerTitle: "Salut",
            headerColor: "green",
            backgroundColor: "crimson",

        });
    </script>
    <script src={{ asset('storage/assets/js/main.js') }}></script>

    @yield('script')
</body>

</html>

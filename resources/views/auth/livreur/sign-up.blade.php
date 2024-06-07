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
    <title>ELM EXPRESS</title>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="keywords" content="" />  
      <link rel="shortcut icon" href="{{ asset('storage/images/appLogo.png') }}" />

   
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
    </head>
    <body>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
        <div class="container">
            
      <div class="d-flex flex-column flex-root mt-10" id="kt_app_root">
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 mt-15">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-100 p-10">
                        <!--begin::Form-->
                        <form action="{{ route('auth.livreur.signUp.store') }}" method="post" enctype="multipart/form-data" class="form w-100 row"
                            novalidate="novalidate" id="kt_sign_up_form">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Devenir Livreur</h1>
                                <!--end::Title-->
                            </div>
                            <div class="fv-row mb-8 col-6">

                                <input type="text" placeholder="Nom Complet" name="nomcomplet" autocomplete="off"
                                    class="form-control bg-transparent" />

                            </div>
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">

                                <input type="text" placeholder="CIN" name="cin" autocomplete="off"
                                    class="form-control bg-transparent" />

                            </div>
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">

                                <input type="text" placeholder="Numero de telephone" name="Phone"
                                    autocomplete="off" class="form-control bg-transparent" />

                            </div>
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">

                                <input type="text" placeholder="Email" name="email" autocomplete="off"
                                    class="form-control bg-transparent" />

                            </div>
                            <!--begin::Input group-->
                            <div class="fv-row mb-8 col-6" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control bg-transparent" type="password"
                                            placeholder="Password" name="password" autocomplete="off" />
                                        <span
                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                            <i class="bi bi-eye-slash fs-2"></i>
                                            <i class="bi bi-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                    <!--end::Input wrapper-->
                                    <!--begin::Meter-->
                                    <div class="d-flex align-items-center mb-3"
                                        data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                        </div>
                                    </div>
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Hint-->
                                <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &
                                    symbols.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group=-->
                            <!--end::Input group=-->
                            <div class="fv-row mb-8 col-6">
                                <!--begin::Repeat Password-->
                                <input placeholder="Repeat Password" name="confirmpassword" type="password"
                                autocomplete="off" class="form-control bg-transparent" />
                                <!--end::Repeat Password-->
                            </div>
                            <div class="fv-row mb-8 col-6">
                                <label class="" >Zone </label>
                                <select name="id_Z" id="zone_select" class="form-select">
                                    @foreach ($zones as $item)
                                        <option value="{{ $item->id_Z }}">{{ $item->zonename }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="fv-row mb-8 col-6">
                                
                                <label class="" >Ville </label>
                                <select name="ville" id="ville_select" class="form-select">

                                </select>
                            </div>
                            
                            <!--end::Input group=-->

                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">

                                <input type="text" placeholder="Adresse" name="adress" autocomplete="off"
                                    class="form-control bg-transparent" />

                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">

                                <input type="number" placeholder="Frais de livraison (DH)" name="fraislivraison"
                                    autocomplete="off" class="form-control bg-transparent" />

                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">

                                <input type="number" placeholder="Frais de refus (DH)" name="fraisrefus"
                                    autocomplete="off" class="form-control bg-transparent" />

                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">

                                <input type="text" placeholder="Banque" name="nombanque" autocomplete="off"
                                    class="form-control bg-transparent" />

                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">

                                <input type="text" placeholder="Numero du compte" name="numerocompte"
                                    autocomplete="off" class="form-control bg-transparent" />

                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-4">

                                <input type="file" name="cinrecto" autocomplete="off" accept="image/*"
                                    class="form-control bg-transparent" />

                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-4">

                                <input type="file" name="cinverso" autocomplete="off" accept="image/*"
                                    class="form-control bg-transparent" />

                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-4">

                                <input type="file" name="RIB" autocomplete="off" accept="image/*"
                                    class="form-control bg-transparent" />

                            </div>
                            <!--end::Input group=-->
                            <!--begin::Accept-->
                            <div class="fv-row mb-8 col-6">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="toc" value="1" />
                                    <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">I Accept
                                        the
                                        <a href="#" class="ms-1 link-primary">Terms</a></span>
                                </label>
                            </div>
                            <!--end::Accept-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" {{-- id="kt_sign_up_submit" --}} class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Devenir Livreur</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">Vous avez déja un compte?
                                <a href="{{ route('auth.livreur.signIn') }}" class="link-primary fw-semibold">Espace
                                    Livreur</a>
                            </div>
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->

            </div>
        </div>
        <!--end::Authentication - Sign-up-->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-alert :message="session('error')" type="error" />
    <x-alert :message="session('success')" type="success" />
    <x-alert :message="session('warning')" type="warning" />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const zoneSelect = document.getElementById('zone_select');
            const villeSelect = document.getElementById('ville_select');
            var zones = @json($zones);
            zoneSelect.addEventListener('change', function() {
                // Get the selected zone ID
                const selectedZoneId = this.value;
                let data= zones.find(ele=>ele.id_Z==selectedZoneId).ville
                // console.log(data);
                
                villeSelect.innerHTML = '';
                        data.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.id_V;
                            option.textContent = city.villename;
                            villeSelect.appendChild(option);
                        });
        });
        });
    </script>
    
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->

    {{-- <script src="{{ asset('storage/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('storage/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('storage/assets/js/custom/authentication/sign-up/general.js') }}"></script> --}}
    
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

        </div>
        

<script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>
    </body>
</html>

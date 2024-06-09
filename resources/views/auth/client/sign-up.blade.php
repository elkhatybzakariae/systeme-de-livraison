<!DOCTYPE html>
<html dir="ws_config_dir" lang="ws_config_lang">

<head>
    <style>
        :root {
            --main-color: #202b46;
            --second-color: #388e3c;
            --third-color: #43a047;
            --fourth-color: #1b5e20;
            --fifth-color: #1b5e20;
            --hover-color: #388e3c;
            --focus-color: #2e7d32;
        }
        .eye-icon {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }
        .position-relative {
            position: relative;
        }
    </style>
    <title>ELM EXPRESS</title>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description"
        content="livraison est la nouvelle solution d'expédition pour gérer vos livraisons en ligne. Donnez à votre entreprise en ligne un avantage concurrentiel grâce aux solutions de livraison sur mesure de commerce électronique de livraison." />
    <meta name="keywords" content="" />    <link rel="shortcut icon" href="{{ asset('storage/images/appLogo.png') }}" />

    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.vitex.ma/assets/home-page/css/boxicons.min.css"> 
    <link rel="stylesheet" href="https://cdn.vitex.ma/assets/home-page/css/flaticon.css">
    <link href="{{ asset('storage/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('storage/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/responsive.css') }}">
    <link href="{{ asset('storage/styles/styles-ws.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('storage/assets/main-page/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/main-page/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/floatingapp.css') }}">
</head>
<body>
    <div class="container">
        <div class="d-flex flex-column flex-root mt-10" id="kt_app_root">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 mt-15">
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <div class="w-lg-100 p-10">
                            <form action="{{ route('auth.client.signUp.store') }}" method="post" class="form w-100 row" novalidate="novalidate" id="kt_sign_up_form">
                                @csrf
                                <div class="text-center mb-11">
                                    <h1 class="text-dark fw-bolder mb-3">Devenir Client</h1>
                                </div>
                                <div class="fv-row mb-8 col-6">
                                    <input type="text" placeholder="Nom Complet" name="nomcomplet" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row mb-8 col-6">
                                    <input type="text" placeholder="Nom du magasin" name="nommagasin" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row mb-8 col-6">
                                    <input type="text" placeholder="Numero de telephone" name="Phone" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row mb-8 col-6">
                                    <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row mb-8 col-6 position-relative">
                                    <input class="form-control bg-transparent" 
                                    type="password" placeholder="Password" 
                                    name="password" autocomplete="off" id="password" />
                                    <i class="fa fa-eye eye-icon" id="togglePassword"></i>
                                </div>
                                <div class="fv-row mb-8 col-6 position-relative">
                                    <input placeholder="Repeat Password" 
                                    name="confirmpassword" type="password" 
                                    autocomplete="off" class="form-control bg-transparent"
                                     id="confirmpassword" />
                                    <i class="fa fa-eye eye-icon" id="toggleConfirmPassword"></i>
                                </div>
                                <div class="fv-row mb-8 col-6">
                                    <input type="text" placeholder="Ville" name="ville" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row mb-8 col-6">
                                    <input type="text" placeholder="Adresse" name="adress" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row mb-8 col-6">
                                    <input type="text" placeholder="CIN" name="cin" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row mb-8 col-6">
                                    <input type="text" placeholder="Site web" name="siteweb" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row mb-8 col-6">
                                    <input type="text" placeholder="type entreprise" name="typeentreprise" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row mb-8 col-6">
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="toc" value="1" />
                                        <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">I Accept the <a href="#" class="ms-1 link-primary">Terms</a></span>
                                    </label>
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Devenir Client</span>
                                        <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <div class="text-gray-500 text-center fw-semibold fs-6">Vous avez déja un compte? <a href="{{ route('auth.client.signIn') }}" class="link-primary fw-semibold">Espace Client</a></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-alert :message="session('error')" type="error" />
    <x-alert :message="session('success')" type="success" />
    <x-alert :message="session('warning')" type="warning" />

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

        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            const confirmPasswordInput = document.getElementById('confirmpassword');
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>

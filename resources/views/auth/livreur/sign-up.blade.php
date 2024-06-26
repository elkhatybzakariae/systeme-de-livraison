<!DOCTYPE html>
<html dir="ws_config_dir" lang="ws_config_lang">

<head>
    <style>
        :root {
            --main-color: #000000;
            --second-color: #388e3c;
            --third-color: #43a047;
            --fourth-color: #1b5e20;
            --fifth-color: #1b5e20;
            --hover-color: #388e3c;
            --focus-color: #2e7d32;
        }

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
    <title>ELM EXPRESS</title>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="{{ asset('storage/images/appLogo.png') }}" />

    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/plugins/global/plugins.bundle.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('storage/assets/css/style.bundle.css') }}" type="text/css" />
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
    <link rel="stylesheet" href="{{ asset('storage/styles/styles-ws.css') }}" />
    <link rel="stylesheet" href="{{ asset('storage/assets/main-page/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/main-page/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/home-page/css/floatingapp.css') }}">
</head>

<body>
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="container">
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-4 mt-4">
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <div class="w-lg-100 p-10">
                            <form action="{{ route('auth.livreur.signUp.store') }}" method="post" enctype="multipart/form-data" class="form w-100 row" novalidate="novalidate" id="kt_sign_up_form">
                                @csrf
                                <div class="text-center mb-11">
                                    <h1 class="text-dark fw-bolder mb-3">Devenir Livreur</h1>
                                </div>
                                <div class="fv-row mb-4 col-md-4">
                                    <input type="text" placeholder="Nom Complet" value="{{old('nomcomplet')}}" name="nomcomplet" autocomplete="off" class="form-control" />
                                    @if ($errors->has('nomcomplet'))
                                        <div class="text-danger">
                                            * Le champ Nom complet est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="fv-row mb-4 col-md-4">
                                    <input type="text" placeholder="CIN" name="cin" value="{{old('cin')}}" autocomplete="off" class="form-control" />
                                    @if ($errors->has('cin'))
                                        <div class="text-danger">
                                            * Le champ CIN est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="fv-row mb-4 col-md-4">
                                    <input type="text" placeholder="Numero de telephone" name="Phone" value="{{old('Phone')}}" autocomplete="off" class="form-control" />
                                    @if ($errors->has('Phone'))
                                        <div class="text-danger">
                                            * Le champ Numero de telephone est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="fv-row mb-4 col-md-12">
                                    <input type="text" placeholder="Adresse" name="adress" value="{{old('adress')}}" autocomplete="off" class="form-control" />
                                    @if ($errors->has('adress'))
                                        <div class="text-danger">
                                            * Le champ Adresse est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="fv-row mb-4 col-md-3">
                                    <label class="">Zone </label>
                                    <select name="id_Z" id="zone_select" class="form-select">
                                        @foreach ($zones as $item)
                                            <option value="{{ $item->id_Z }}">{{ $item->zonename }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_Z'))
                                        <div class="text-danger">
                                            * Le champ Zone est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="fv-row mb-4 col-md-3">
                                    <label class="">Ville </label>
                                    <select name="ville" id="ville_select" value="{{old('ville')}}" class="form-select">
                                    </select>
                                    @if ($errors->has('ville'))
                                        <div class="text-danger">
                                            * Le champ ville est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="fv-row mb-4 col-md-3">
                                    <input type="number" placeholder="Frais de livraison (DH)" name="fraislivraison" value="{{old('fraislivraison')}}" autocomplete="off" class="form-control" />
                                    
                                    @if ($errors->has('fraislivraison'))
                                        <div class="text-danger">
                                            * Le champ frais livraison est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="fv-row mb-4 col-md-3">
                                    <input type="number" placeholder="Frais de refus (DH)" name="fraisrefus" value="{{old('fraisrefus')}}" autocomplete="off" class="form-control" />
                                    
                                    @if ($errors->has('fraisrefus'))
                                        <div class="text-danger">
                                            * Le champ frais refus est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="fv-row mb-4 mt-2 col-md-6">
                                    {{-- <label class="">Bank </label> --}}
                                    <select name="nombanque" id="nombanque" class="form-select">
                                        @foreach ($banks as $item)
                                            <option value="{{ $item->nom }}">{{ $item->nom }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" placeholder="Banque" name="nombanque" autocomplete="off" class="form-control" /> --}}
                                </div>
                                <div class="fv-row mb-4 col-md-6">
                                    <input type="text" placeholder="Numero du compte" name="numerocompte" autocomplete="off" class="form-control" />
                                </div>
                                <div class="fv-row mb-4 col-md-4">
                                    <label for="cinrecto">CIN Recto</label>
                                    <input type="file" name="cinrecto"  autocomplete="off" accept="image/*" class="form-control" />
                                    @if ($errors->has('cinrecto'))
                                    <div class="text-danger">
                                        * Le champ cin recto est obligatoire.</div>
                                @endif
                                </div>
                                <div class="fv-row mb-4 col-md-4">
                                    <label for="cinverso">CIN Verso</label>
                                    <input type="file" name="cinverso" autocomplete="off" accept="image/*" class="form-control" />
                                    @if ($errors->has('cinverso'))
                                        <div class="text-danger">
                                            * Le champ cin verso est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="fv-row mb-4 col-md-4">
                                    <label for="RIB">RIB</label>
                                    <input type="file" name="RIB"  autocomplete="off" accept="image/*" class="form-control" />
                                    @if ($errors->has('RIB'))
                                        <div class="text-danger">
                                            * Le champ RIB est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="fv-row mb-4 col-md-4">
                                    <input type="text" placeholder="Email" value="{{old('email')}}" name="email" autocomplete="off" class="form-control" />
                                    @if ($errors->has('email'))
                                        <div class="text-danger">
                                            * Le champ Email est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="fv-row mb-4 col-md-4 position-relative" data-kt-password-meter="true">
                                    <input placeholder="Password" name="password" id="password" type="password" autocomplete="off" class="form-control" />
                                    <i class="fa fa-eye eye-icon" id="togglePassword"></i>
                                    @if ($errors->has('password'))
                                        <div class="text-danger">
                                            * Le champ Password est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="fv-row mb-4 col-md-4 position-relative">
                                    <input placeholder="Repeat Password" name="confirmpassword" 
                                    id="confirmpassword" type="password" 
                                    autocomplete="off" class="form-control" />
                                    <i class="fa fa-eye eye-icon" id="toggleConfirmPassword"></i>
                                    @if ($errors->has('confirmpassword'))
                                        <div class="text-danger">
                                            * Le champ Repeat Password est obligatoire.</div>
                                    @endif
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Devenir Livreur</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <div class="text-gray-500 text-center fw-semibold fs-6">Vous avez déja un compte?
                                    <a href="{{ route('auth.livreur.signIn') }}" class="link-primary fw-semibold">Espace Livreur</a>
                                </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const zoneSelect = document.getElementById('zone_select');
            const villeSelect = document.getElementById('ville_select');
            var zones = @json($zones);
            zoneSelect.addEventListener('change', function() {
                const selectedZoneId = this.value;
                let data = zones.find(ele => ele.id_Z == selectedZoneId).ville;
                villeSelect.innerHTML = '';
                data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.villename;
                    option.textContent = city.villename;
                    villeSelect.appendChild(option);
                });
            });

            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
            });

            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const confirmpassword = document.getElementById('confirmpassword');
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmpassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmpassword.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
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
</body>

</html>

@extends('layouts.app')
@section('style')
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('storage/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('storage/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
@endsection
@section('content')
      <!--begin::Root-->
      <div class="d-flex flex-column flex-root mt-10" id="kt_app_root">
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            {{-- <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center"
			        style="background-image: url('{{ asset('storage/assets/media/misc/auth-bg.png') }}')">

                <!--begin::Content-->
                <div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
                    <!--begin::Logo-->
                    <a href="../../demo1/dist/index.html" class="mb-0 mb-lg-20">
                        <img alt="Logo" src="{{ asset('storage/assets/media/logos/default-white.svg') }}"
                            class="h-40px h-lg-50px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Image-->
                    <img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20"
                        src="{{ asset('storage/assets/media/misc/auth-screens.png') }}" alt="" />
                    <!--end::Image-->
                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bold text-center mb-7">Fast, Efficient and
                        Productive</h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
                        <a href="#" class="opacity-75-hover text-warning fw-semibold me-1">the
                            blogger</a>introduces a person they’ve interviewed
                        <br />and provides some background information about
                        <a href="#" class="opacity-75-hover text-warning fw-semibold me-1">the interviewee</a>and
                        their
                        <br />work following this is a transcript of the interview.
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div> --}}
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 mt-15">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-100 p-10">
                        <!--begin::Form-->
                        <form action="{{ route('auth.livreur.signUp.store') }}" method="post" class="form w-100 row"
                            novalidate="novalidate" id="kt_sign_up_form">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Devenir Client</h1>
                                <!--end::Title-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Separator-->
                            {{-- <div class="separator separator-content my-14">
                                <span class="w-125px text-gray-500 fw-semibold fs-7">Devenir Livreur</span>
                            </div> --}}
                            <!--end::Separator-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">

                                <input type="text" placeholder="Nom Complet" name="nomcomplet" autocomplete="off"
                                    class="form-control bg-transparent" />

                            </div>
                            
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">
                                <input type="text" placeholder="Nom du magasin" name="nommagasin" autocomplete="off"
                                    class="form-control bg-transparent" />
                            </div>                            
                            <!--end::Input group=-->
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
                            <!--end::Input group=-->

                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">

                                <input type="text" placeholder="Ville" name="ville" autocomplete="off"
                                    class="form-control bg-transparent" />

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

                                <input type="text" placeholder="CIN" name="cin" autocomplete="off"
                                    class="form-control bg-transparent" />

                            </div>
                            
                            <!--end::Input group=-->
                            
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">

                                <input type="text" placeholder="Site web" name="siteweb" autocomplete="off"
                                    class="form-control bg-transparent" />

                            </div>
                            
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8 col-6">

                                <input type="text" placeholder="type entreprise" name="typeentreprise" autocomplete="off"
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
                                    <span class="indicator-label">Devenir Client</span>
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
                                    Client</a>
                            </div>
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->

            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-up-->
    </div>
    <!--end::Root-->
@endsection
@section('script')
    <!--begin::Theme mode setup on page load-->
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
@endsection
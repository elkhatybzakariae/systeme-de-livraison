@extends('layouts.livreur.admin')

@section('content')
<div class="d-flex flex-column flex-root mt-10" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 mt-15">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-100 p-10">
                    <form action="{{ route('auth.livreur.signUp.store') }}" method="post" class="form w-100 row" novalidate="novalidate" id="kt_sign_up_form">
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
                        <div class="fv-row mb-8 col-6" data-kt-password-meter="true">
                            <div class="mb-1">
                                <div class="position-relative mb-3">
                                    <input class="form-control bg-transparent" type="password" placeholder="Password" name="password" autocomplete="off" />
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                            </div>
                            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                        </div>
                        <div class="fv-row mb-8 col-6">
                            <input placeholder="Repeat Password" name="confirmpassword" type="password" autocomplete="off" class="form-control bg-transparent" />
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
                        <div class="text-gray-500 text-center fw-semibold fs-6">Vous avez déja un compte? <a href="{{ route('auth.livreur.signIn') }}" class="link-primary fw-semibold">Espace Client</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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
@endsection

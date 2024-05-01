@extends('layouts.admin.admin')
@section('content')
    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form id="kt_modal_new_target_form" method="POST" class="form row" action="{{ route('tarif.store') }}">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3" id="title">Ajouter tarif</h1>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row col-6">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">ville Ramassage</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <select name="villeRamassage" id="villeRamassage" class="form-control form-control-solid">
                                <option selected>select ville de ramassage</option>
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->id_V }}">{{ $ville->villename }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row col-6">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">la ville</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <select name="ville" id="ville" class="form-control form-control-solid">
                                <option selected>select ville</option>
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->id_V }}">{{ $ville->villename }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row col-4">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Prix Livraison</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="number" class="form-control form-control-solid" placeholder="prix de livraison"
                                id="prixliv" name="prixliv"  value="{{old('prixliv')}}"/>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row col-4">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Prix Retour</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="number" class="form-control form-control-solid" placeholder="prix de retour"
                                id="prixret" name="prixret"  value="{{old('prixret')}}"/>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row col-4">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Prix Refus</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="number" class="form-control form-control-solid" placeholder="prix refus"
                                id="prixref" name="prixref"  value="{{old('prixref')}}"/>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">delai livraison</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="delai livraison"
                                id="delailiv" name="delailiv"  value="{{old('delailiv')}}"/>
                        </div>

                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <input type="text" data-kt-ecommerce-product-filter="search"
                        class="form-control form-control-solid w-250px ps-14" placeholder="Search Product" />
                </div>
            </div>
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Ajouter
                    tarif</a>
            </div>
        </div>

        <div class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                    data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                    value="1" />
                            </div>
                        </th>
                        <th class="min-w-200px">ville Ramassage</th>
                        <th class=" min-w-100px">ville</th>
                        <th class=" min-w-70px">Frais livraison</th>
                        <th class=" min-w-70px">Frais Retour</th>
                        <th class=" min-w-70px">Frais Refus</th>
                        <th class=" min-w-70px">Delai Livraison</th>
                        <th class=" min-w-70px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @foreach ($tarifs as $index => $tarif)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="{{ $tarif->id_Tar }}" />
                                </div>
                            </td>
                            {{-- <td>
                                <div class="">
                                    <div class="ms-5">
                                    <a href="" class="text-gray-800 text-hover-primary fs-5 fw-bold" >{{ $tarif->id_Tar }}</a>
                                    </div>
                                </div>
                                </td> --}}
                            <td class="pe-0">
                                <span class="fw-bold"
                                    data-kt-ecommerce-product-filter="villeRamassage">{{ $tarif->villeRamassage }}</span>
                            </td>
                            <td class="pe-0">
                                <span class="fw-bold"
                                    data-kt-ecommerce-product-filter="ville">{{ $tarif->ville }}</span>
                            </td>
                            <td class="pe-0">
                                <span class="fw-bold"
                                    data-kt-ecommerce-product-filter="prixliv">{{ $tarif->prixliv }}</span>
                            </td>
                            <td class="pe-0">
                                <span class="fw-bold"
                                    data-kt-ecommerce-product-filter="prixret">{{ $tarif->prixret }}</span>
                            </td>
                            <td class="pe-0">
                                <span class="fw-bold"
                                    data-kt-ecommerce-product-filter="prixref">{{ $tarif->prixref }}</span>
                            </td>
                            <td class="pe-0">
                                <span class="fw-bold"
                                    data-kt-ecommerce-product-filter="delailiv">{{ $tarif->delailiv }}</span>
                            </td>
                            {{-- <td class=" pe-0" data-order="{{ $tarif->statut }}">
                                <div class="badge badge-light-danger">{{ $tarif->statut }}</div>
                            </td> --}}
                            <!--begin::Action=-->
                            <td class="">
                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                    data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a onclick="openModal('{{ $tarif->villeRamassage }}','{{ $tarif->ville }}','{{ $tarif->prixliv }}','{{ $tarif->prixret }}','{{ $tarif->prixref }}','{{ $tarif->delailiv }}','{{ route('tarif.update', $tarif->id_Tar) }}')"data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_new_target" class="menu-link px-3">Edit</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <form action="{{ route('tarif.destroy', $tarif->id_Tar) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="menu-link px-3 btn text-danger"
                                                data-kt-ecommerce-product-filter="delete_row" value="delete">
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // Filter by search input
            $('[data-kt-ecommerce-product-filter="search"]').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                filterTable(searchText);
            });

            // Function to filter table by search text
            function filterTable(searchText) {
                $('#kt_ecommerce_products_table tbody tr').each(function() {
                    var villeRamassage = $(this).find('[data-kt-ecommerce-product-filter="villeRamassage"]').text()
                        .toLowerCase();
                    if (villeRamassage.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });

        function openModal(villeRamassage = '',ville = '',prixliv = '',prixret = '',prixref = '',delailiv = '', actionUrl = "{{ route('tarif.store') }}") {
            // Set the tarif input value
            document.getElementById('title').textContent  = 'Modifier tarif';
            document.getElementById('villeRamassage').value = villeRamassage;
            document.getElementById('ville').value = ville;
            document.getElementById('prixliv').value = prixliv;
            document.getElementById('prixret').value = prixret;
            document.getElementById('prixref').value = prixref;
            document.getElementById('delailiv').value = delailiv;
            document.getElementById('kt_modal_new_target_form').action = actionUrl;
            // document.getElementById('kt_modal_new_target_form').setAttribute('method', 'PUT');

        }
    </script>
@endsection

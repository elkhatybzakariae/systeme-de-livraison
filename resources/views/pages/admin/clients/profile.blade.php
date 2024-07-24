@extends('layouts.admin.admin')
@section('breads')
    <x-breadcrumb :breads="$breads" />
@endsection
@section('content')
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
        <div class="w-lg-100 p-10">
            <form action="{{ route('accept.client', $client->id_Cl) }}" method="post" class="form w-100 row"
                enctype="multipart/form-data" id="kt_sign_up_form">
                @csrf
                @method('PUT')
                <div class="text-center mb-11">
                    <h1 class="text-dark fw-bolder mb-3">Profile Client</h1>
                </div>
                <div class="fv-row mb-8 col-6"> <label class="fw-bold" for="nomcomplet">Nom Client:</label>

                    <input type="text" placeholder="Nom Complet" name="nomcomplet" value="{{ $client->nomcomplet }}"
                        class="form-control bg-transparent" />
                </div>
                <div class="fv-row mb-8 col-6"> <label class="fw-bold" for="nommagasin">Nom magasin:</label>

                    <input type="text" placeholder="Nom du magasin" name="nommagasin" value="{{ $client->nommagasin }}"
                        class="form-control bg-transparent" />
                </div>
                <div class="fv-row mb-8 col-6">
                    <label class="fw-bold" for="typeentreprise">Type entreprise:</label>
                    <input type="text" name="typeentreprise" id="typeentreprise" class="form-control bg-transparent"
                        value="{{ $client->typeentreprise }}">

                </div>
                <div class="fv-row mb-8 col-6">
                    <label class="fw-bold" for="cin">CIN:</label>
                    <input type="text" id="cin" name="cin" class="form-control bg-transparent" value="{{ $client->cin }}">

                </div>
                <div class="fv-row mb-8 col-6"> <label class="fw-bold" for="phone">Numero de telephone:</label>

                    <input type="text" placeholder="Numero de telephone" name="Phone" value="{{ $client->Phone }}"
                        class="form-control bg-transparent" />
                </div>
                <div class="fv-row mb-8 col-6"> <label class="fw-bold" for="email">Adresse electronique:</label>

                    <input type="text" placeholder="Email" name="email" value="{{ $client->email }}"
                        class="form-control bg-transparent" />
                </div>

                
                <div class="fv-row mb-8 col-12"> <label class="fw-bold" for="adresse">Adresse:</label>

                    <input type="text" placeholder="Adresse" name="adress" value="{{ $client->adress }}"
                        class="form-control bg-transparent" />
                </div><div class="fv-row mb-8 col-6"> <label class="fw-bold" for="ville">Ville:</label>

                    <input type="text" placeholder="Ville" name="ville" value="{{ $client->Cville->villename }}"
                        class="form-control bg-transparent" />
                </div>
                {{-- <div class="fv-row mb-8 col-6">
                    <input type="text" placeholder="CIN" name="cin" value="{{ $client->cin }}"
                        class="form-control bg-transparent" />
                </div> --}}
                <div class="fv-row mb-8 col-6"> <label class="fw-bold" for="siteweb">Site web:</label>

                    <input type="text" placeholder="Site web" name="siteweb" value="{{ $client->siteweb }}"
                        class="form-control bg-transparent" />
                </div>
                <div class="form-group mb-3 col col-md-6">
                    <label class="fw-bold" for="nombanque">Bank:</label>
                    <input type="text" id="nombanque" class="form-control bg-transparent"
                        value="{{ $client->nombanque }}">
                </div>
                <div class="form-group mb-3 col col-md-6">
                    <label class="fw-bold" for="numerocompte">Numero compte:</label>
                    <input type="text" id="numerocompte" class="form-control bg-transparent"
                        value="{{ $client->numerocompte }}">
                </div>
                {{-- <div class="fv-row mb-8 col-6">
                    <input type="text" placeholder="type entreprise" name="typeentreprise"
                        value="{{ $client->typeentreprise }}" class="form-control bg-transparent" />
                </div> --}}

                <div class="d-grid mb-10">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Accepter Client</span>
                        <span class="indicator-progress">Please wait...<span
                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

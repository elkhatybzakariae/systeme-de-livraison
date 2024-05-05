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
    <form action="{{ route('accept.livreur',$livreur->id_Liv) }}" method="post" class="form w-100 row" enctype="multipart/form-data" id="kt_sign_up_form">
        @csrf
        @method('PUT')
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">Profile livreur</h1>
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Nom Complet" name="nomcomplet" value="{{ $livreur->nomcomplet }}" 
                class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="CIN" name="cin" value="{{ $livreur->cin }}" 
                class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Numero de telephone" value="{{ $livreur->Phone }}" name="Phone"
                 class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Email" name="email" value="{{ $livreur->email }}"
                class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Ville" name="ville" value="{{ $livreur->ville }}"
                class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Adresse" name="adress" value="{{ $livreur->adress }}"
                class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="number" placeholder="Frais de livraison (DH)" name="fraislivraison" value="{{ $livreur->fraislivraison }}"
                 class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="number" placeholder="Frais de refus (DH)" name="fraisrefus" value="{{ $livreur->fraisrefus }}"
                 class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Banque" name="nombanque"  value="{{ $livreur->nombanque }}"
                class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Numero du compte" name="numerocompte" value="{{ $livreur->numerocompte }}"
                 class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-4">
            <input type="file" name="cinrecto"  accept="image/*" 
                class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-4">
            <input type="file" name="cinverso"  accept="image/*"
                class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-4">
            <input type="file" name="RIB"  accept="image/*"
                class="form-control bg-transparent" />
        </div>
        <div class="d-grid mb-10">
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">Accepter livreur</span>
                <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
        <div class="text-gray-500 text-center fw-semibold fs-6">Vous avez déja un compte? <a href="{{ route('auth.livreur.signIn') }}" class="link-primary fw-semibold">Espace livreur</a></div>
    </form>

  </div>
</div>

@endsection
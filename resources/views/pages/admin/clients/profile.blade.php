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
    <form action="{{ route('accept.client',$client->id_Cl) }}" method="post" class="form w-100 row" enctype="multipart/form-data" id="kt_sign_up_form">
        @csrf
        @method('PUT')
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">Profile Client</h1>
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Nom Complet" name="nomcomplet" value="{{ $client->nomcomplet }}"  class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Nom du magasin" name="nommagasin" value="{{ $client->nommagasin }}"  class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Numero de telephone" name="Phone" value="{{ $client->Phone }}"  class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Email" name="email" value="{{ $client->email }}"  class="form-control bg-transparent" />
        </div>
        
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Ville" name="ville" value="{{ $client->ville }}" class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Adresse" name="adress" value="{{ $client->adress }}"  class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="CIN" name="cin" value="{{ $client->cin }}"  class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="Site web" name="siteweb" value="{{ $client->siteweb }}"  class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-8 col-6">
            <input type="text" placeholder="type entreprise" name="typeentreprise" value="{{ $client->typeentreprise }}"  class="form-control bg-transparent" />
        </div>
        
        <div class="d-grid mb-10">
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">Accepter Client</span>
                <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
  </div>
</div>

@endsection
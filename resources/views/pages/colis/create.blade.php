@extends('layouts.client.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Colis') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('colis.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="code_d_envoi" class="col-md-4 col-form-label text-md-right">{{ __('Code d\'envoi') }}</label>

                            <div class="col-md-6">
                                <input id="code_d_envoi" type="text" class="form-control @error('code_d_envoi') is-invalid @enderror" name="code_d_envoi" value="{{ old('code_d_envoi') }}" required autocomplete="code_d_envoi" autofocus>

                                @error('code_d_envoi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_d_expedition" class="col-md-4 col-form-label text-md-right">{{ __('Date d\'expedition') }}</label>

                            <div class="col-md-6">
                                <input id="date_d_expedition" type="date" class="form-control @error('date_d_expedition') is-invalid @enderror" name="date_d_expedition" value="{{ old('date_d_expedition') }}" required>

                                @error('date_d_expedition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="destinataire" class="col-md-4 col-form-label text-md-right">{{ __('Destinataire') }}</label>

                            <div class="col-md-6">
                                <input id="destinataire" type="text" class="form-control @error('destinataire') is-invalid @enderror" name="destinataire" value="{{ old('destinataire') }}" required autocomplete="destinataire">

                                @error('destinataire')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>

                            <div class="col-md-6">
                                <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone">

                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="marchandise" class="col-md-4 col-form-label text-md-right">{{ __('Marchandise') }}</label>

                            <div class="col-md-6">
                                <input id="marchandise" type="text" class="form-control @error('marchandise') is-invalid @enderror" name="marchandise" value="{{ old('marchandise') }}" required autocomplete="marchandise">

                                @error('marchandise')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantite" class="col-md-4 col-form-label text-md-right">{{ __('Quantite') }}</label>

                            <div class="col-md-6">
                                <input id="quantite" type="number" class="form-control @error('quantite') is-invalid @enderror" name="quantite" value="{{ old('quantite') }}" required autocomplete="quantite">

                                @error('quantite')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zone" class="col-md-4 col-form-label text-md-right">{{ __('Zone') }}</label>

                            <div class="col-md-6">
                                <select id="zone" class="form-control @error('zone') is-invalid @enderror" name="zone" required>
                                    <option value="">Select Zone</option>
                                    <!-- Add options for zones here -->
                                </select>

                                @error('zone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ville_id" class="col-md-4 col-form-label text-md-right">{{ __('Ville') }}</label>

                            <div class="col-md-6">
                                <select id="ville_id" class="form-control @error('ville_id') is-invalid @enderror" name="ville_id" required>
                                    <option value="">Select Ville</option>
                                    <!-- Add options for cities here -->
                                </select>

                                @error('ville_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Add other form fields as needed -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

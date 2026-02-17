@extends('layouts.app')

@section('title', 'Nouvelle Entrée')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-plus-circle"></i> Enregistrer une Entrée
                </h4>
            </div>
            <div class="card-body">

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Saisissez l'immatriculation et le type du véhicule.
                   
                </div>

                <form action="{{ route('vehicles.store') }}" method="POST">
                    @csrf

                   
                    <div class="mb-4">
                        <label for="immatriculation" class="form-label fw-bold">
                            Numéro d'Immatriculation *
                        </label>
                        <input
                            type="text"
                            class="form-control form-control-lg @error('immatriculation') is-invalid @enderror"
                            id="immatriculation"
                            name="immatriculation"
                            placeholder="Ex: 1234 TAB"
                            value="{{ old('immatriculation') }}"
                            required
                            autofocus
                        >
                        @error('immatriculation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                   
                    <div class="mb-4">
                        <label class="form-label fw-bold">Type de Véhicule *</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="radio" class="btn-check"
                                    name="type_vehicule" id="voiture"
                                    value="voiture"
                                    {{ old('type_vehicule') == 'voiture' ? 'checked' : '' }}
                                    required>
                                <label class="btn btn-outline-primary w-100 py-4" for="voiture">
                                    <i class="fas fa-car fa-2x d-block mb-2"></i>
                                    <strong>Voiture</strong><br>
                                    <small>500 Ar/heure</small>
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check"
                                    name="type_vehicule" id="moto"
                                    value="moto"
                                    {{ old('type_vehicule') == 'moto' ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger w-100 py-4" for="moto">
                                    <i class="fas fa-motorcycle fa-2x d-block mb-2"></i>
                                    <strong>Moto</strong><br>
                                    <small>200 Ar/heure</small>
                                </label>
                            </div>
                        </div>
                        @error('type_vehicule')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                   
                    <div class="alert alert-warning">
                        <strong> Info</strong>
                        Toute heure commencée est due. Minimum 1 heure.
                    </div>

                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('home') }}" class="btn btn-secondary btn-lg">
                            ← Annuler
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                             Enregistrer l'Entrée
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Majuscules automatiques
    document.getElementById('immatriculation').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });
</script>

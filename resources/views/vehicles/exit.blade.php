@extends('layouts.app')

@section('title', 'Enregistrer Sortie')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-sign-out-alt"></i> Enregistrer une Sortie
                </h4>
            </div>
            <div class="card-body">

                @if(!isset($vehicle))
                    {{-- Formulaire de recherche --}}
                    <div class="alert alert-info">
                        <i class="fas fa-search"></i>
                        Recherchez le véhicule par immatriculation ou numéro de ticket.
                    </div>

                    <form action="{{ route('vehicles.search') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="search" class="form-label fw-bold">
                                Immatriculation ou Numéro de Ticket *
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-lg @error('search') is-invalid @enderror"
                                id="search"
                                name="search"
                                placeholder="Ex: 1234 TAB ou PARK-0001"
                                value="{{ old('search') }}"
                                required
                                autofocus
                            >
                            @error('search')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="btn btn-secondary btn-lg">
                                ← Retour
                            </a>
                            <button type="submit" class="btn btn-danger btn-lg">
                                 Rechercher
                            </button>
                        </div>
                    </form>

                @else
                    {{-- Résultat de la recherche --}}
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        Véhicule trouvé !
                    </div>

                    <div class="card mb-4 border-primary">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <p class="text-muted mb-1">Ticket</p>
                                    <h5 class="text-primary">{{ $vehicle->ticket_number }}</h5>
                                </div>
                                <div class="col-md-3">
                                    <p class="text-muted mb-1">Immatriculation</p>
                                    <h5>{{ $vehicle->immatriculation }}</h5>
                                </div>
                                <div class="col-md-3">
                                    <p class="text-muted mb-1">Type</p>
                                    <h5>
                                        @if($vehicle->type_vehicule == 'voiture')
                                            Voiture
                                        @else
                                            Moto
                                        @endif
                                    </h5>
                                </div>
                                <div class="col-md-3">
                                    <p class="text-muted mb-1">Entrée</p>
                                    <h5>{{ $vehicle->heure_entree->format('H:i') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 bg-light">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">Durée de stationnement</h6>
                                    <h3 class="text-primary">{{ $duree }} heure(s)</h3>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">Montant à payer</h6>
                                    <h3 class="text-success">{{ number_format($montant, 0, ',', ' ') }} Ar</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('vehicles.exit', $vehicle->id) }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('vehicles.searchExit') }}" class="btn btn-secondary btn-lg">
                                ← Retour
                            </a>
                            <button type="submit" class="btn btn-success btn-lg">
                                 Confirmer le Paiement ({{ number_format($montant, 0, ',', ' ') }} Ar)
                            </button>
                        </div>
                    </form>

                @endif

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Majuscules automatiques
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    }
</script>

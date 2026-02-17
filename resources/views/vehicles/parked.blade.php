@extends('layouts.app')

@section('title', 'Véhicules Garés')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-car"></i> Véhicules Actuellement Garés
                </h4>
                <a href="{{ route('vehicles.create') }}" class="btn btn-light btn-sm">
                    + Nouvelle Entrée
                </a>
            </div>
            <div class="card-body">

                @if(isset($vehicles) && $vehicles->count() > 0)
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <strong>{{ $vehicles->count() }}</strong> véhicule(s) actuellement garé(s)
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Ticket</th>
                                    <th>Immatriculation</th>
                                    <th>Type</th>
                                    <th>Heure d'entrée</th>
                                    <th>Durée actuelle</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicles as $vehicle)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $vehicle->ticket_number }}
                                        </span>
                                    </td>
                                    <td><strong>{{ $vehicle->immatriculation }}</strong></td>
                                    <td>
                                        @if($vehicle->type_vehicule == 'voiture')
                                            🚗 Voiture
                                        @else
                                            🏍️ Moto
                                        @endif
                                    </td>
                                    <td>{{ $vehicle->heure_entree->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @php
                                            $mins = $vehicle->heure_entree->diffInMinutes(now());
                                            $h = floor($mins / 60);
                                            $m = $mins % 60;
                                        @endphp
                                        {{ $h }}h {{ $m }}min
                                    </td>
                                    <td>
                                        <a href="{{ route('vehicles.searchExit') }}?search={{ $vehicle->immatriculation }}"
                                           class="btn btn-danger btn-sm">
                                            Sortie
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-car fa-5x text-muted mb-4"></i>
                        <h3 class="text-muted">Aucun véhicule garé</h3>
                        <p>Le parking est actuellement vide.</p>
                        <a href="{{ route('vehicles.create') }}" class="btn btn-primary btn-lg">
                            + Enregistrer une entrée
                        </a>
                    </div>
                @endif

                <div class="mt-3">
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        ← Retour à l'accueil
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

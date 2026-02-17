@extends('layouts.app')

@section('title', 'Historique - Parking')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-history"></i> Historique des Stationnements
                </h4>
            </div>
            <div class="card-body">

                @if(isset($vehicles) && $vehicles->count() > 0)
                    <!-- Si on a des véhicules sortis -->
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> 
                        <strong>{{ $vehicles->total() }}</strong> véhicule(s) dans l'historique
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Ticket</th>
                                    <th>Immatriculation</th>
                                    <th>Type</th>
                                    <th>Entrée</th>
                                    <th>Sortie</th>
                                    <th>Durée</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicles as $vehicle)
                                <tr>
                                    <td><span class="badge bg-secondary">{{ $vehicle->ticket_number }}</span></td>
                                    <td><strong>{{ $vehicle->immatriculation }}</strong></td>
                                    <td>
                                        @if($vehicle->type_vehicule == 'voiture')
                                            <i class="fas fa-car text-primary"></i> Voiture
                                        @else
                                            <i class="fas fa-motorcycle text-danger"></i> Moto
                                        @endif
                                    </td>
                                    <td>{{ $vehicle->heure_entree->format('d/m H:i') }}</td>
                                    <td>{{ $vehicle->heure_sortie ? $vehicle->heure_sortie->format('d/m H:i') : '-' }}</td>
                                    <td><span class="badge bg-info">{{ $vehicle->duree_heures }}h</span></td>
                                    <td><strong class="text-success">{{ number_format($vehicle->montant, 0, ',', ' ') }} Ar</strong></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $vehicles->links() }}
                    </div>
                @else
                    <!-- Si pas d'historique -->
                    <div class="text-center py-5">
                        <i class="fas fa-history fa-5x text-muted mb-4"></i>
                        <h3 class="text-muted">Aucun historique</h3>
                        <p class="lead">Aucun véhicule n'est encore sorti du parking.</p>
                        
                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-home"></i> Retour à l'accueil
                            </a>
                        </div>
                    </div>
                @endif

                <div class="mt-3">
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
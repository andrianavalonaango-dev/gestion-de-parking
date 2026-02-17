@extends('layouts.app')

@section('title', 'Accueil - Gestion de Parking')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="text-center mb-5">
            <h1 class="display-4">
                
                GESTION DE PARKING
            </h1>
            <p class="lead text-muted">Gérez vos entrées et sorties de véhicules en toute simplicité</p>
        </div>
    </div>
</div>


<div class="row mb-5">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body text-center">
                <i class="fas fa-car fa-3x mb-3"></i>
                <h3 class="card-title">{{ $vehiculesGares }}</h3>
                <p class="card-text">Véhicules Garés</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body text-center">
                <i class="fas fa-check-circle fa-3x mb-3"></i>
                <h3 class="card-title">{{ \App\Models\Vehicle::where('statut', 'sorti')->whereDate('heure_sortie', today())->count() }}</h3>
                <p class="card-text">Sorties Aujourd'hui</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body text-center">
                <i class="fas fa-dollar-sign fa-3x mb-3"></i>
                <h3 class="card-title">{{ number_format(\App\Models\Vehicle::where('statut', 'sorti')->whereDate('heure_sortie', today())->sum('montant'), 0, ',', ' ') }} Ar</h3>
                <p class="card-text">Revenus du Jour</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body text-center">
                <i class="fas fa-history fa-3x mb-3"></i>
                <h3 class="card-title">{{ \App\Models\Vehicle::count() }}</h3>
                <p class="card-text">Total Véhicules</p>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"> Menu</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    
                    
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('vehicles.create') }}" class="btn btn-primary btn-lg w-100 py-4 text-decoration-none">
                            <i class="fas fa-plus-circle fa-2x mb-2 d-block"></i>
                            <h5 class="mb-1 text-uppercase">Enregistrer une Entrée</h5>
                            <small>Nouveau véhicule dans le parking</small>
                        </a>
                    </div>
                    
                  
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('vehicles.searchExit') }}" class="btn btn-danger btn-lg w-100 py-4 text-decoration-none">
                            <i class="fas fa-sign-out-alt fa-2x mb-2 d-block"></i>
                            <h5 class="mb-1 text-uppercase">Enregistrer une Sortie</h5>
                            <small>quitte le parking</small>
                        </a>
                    </div>
                    
                   
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('vehicles.parked') }}" class="btn btn-success btn-lg w-100 py-4 text-decoration-none">
                            <i class="fas fa-car fa-2x mb-2 d-block"></i>
                            <h5 class="mb-1 text-uppercase">Vehicules Gares</h5>
                            <small>Liste des véhicules actuellement dans le parking</small>
                        </a>
                    </div>
                    
                   
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('vehicles.history') }}" class="btn btn-info btn-lg w-100 py-4 text-decoration-none">
                            <i class="fas fa-history fa-2x mb-2 d-block"></i>
                            <h5 class="mb-1 text-uppercase">Historiques</h5>
                            <small>Consulter l'historique complet</small>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"> Tarifs</h4>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-6">
                        <div class="p-4 border rounded">
                            <i class="fas fa-car fa-3x text-primary mb-3"></i>
                            <h3>500 Ar/heure</h3>
                            <p class="text-muted mb-0">VOITURE</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 border rounded">
                            <i class="fas fa-motorcycle fa-3x text-danger mb-3"></i>
                            <h3>200 Ar/heure</h3>
                            <p class="text-muted mb-0">MOTO</p>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info mt-3 mb-0">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Note :</strong> Toute heure commencée est due. Facturation minimum : 1 heure.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
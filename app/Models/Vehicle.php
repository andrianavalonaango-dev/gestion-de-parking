<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    // Nom de la table
    protected $table = 'vehicles';

    // Champs autorisés pour l'insertion/modification
    protected $fillable = [
        'immatriculation',
        'type_vehicule',
        'ticket_number',
        'heure_entree',
        'heure_sortie',
        'duree_heures',
        'montant',
        'statut'
    ];

    // Conversion automatique des dates
    protected $casts = [
        'heure_entree' => 'datetime',
        'heure_sortie' => 'datetime',
        'duree_heures' => 'decimal:2',
        'montant' => 'decimal:2'
    ];
}
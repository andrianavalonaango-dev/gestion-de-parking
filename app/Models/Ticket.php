<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'numero',
        'vehicle_id',
        'place_id',
        'heure_entree',
        'heure_sortie',
        'duree_heures',
        'montant',
        'statut'
    ];

    protected $casts = [
        'heure_entree' => 'datetime',
        'heure_sortie' => 'datetime',
        'duree_heures' => 'decimal:2',
        'montant' => 'decimal:2'
    ];

    // Un ticket appartient à un véhicule
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Un ticket appartient à une place
    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
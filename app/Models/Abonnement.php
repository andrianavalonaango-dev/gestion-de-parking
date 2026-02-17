<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    protected $table = 'abonnements';

    protected $fillable = [
        'client_id',
        'type',
        'date_debut',
        'date_fin',
        'montant',
        'statut'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'montant' => 'decimal:2'
    ];

    // Relation : Un abonnement appartient à un client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
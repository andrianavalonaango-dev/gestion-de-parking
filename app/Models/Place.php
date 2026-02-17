<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = 'places';

    protected $fillable = [
        'numero',
        'type',
        'statut',
        'parking_id'
    ];

    // Relation : Une place appartient à un parking
    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }
}
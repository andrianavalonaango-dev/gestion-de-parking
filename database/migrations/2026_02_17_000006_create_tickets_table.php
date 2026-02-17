<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 20)->unique();
            
            // Clé étrangère vehicle_id
            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')
                  ->references('id')
                  ->on('vehicles');

            // Clé étrangère place_id
            $table->unsignedBigInteger('place_id')->nullable();
            $table->foreign('place_id')
                  ->references('id')
                  ->on('places');

            $table->dateTime('heure_entree');
            $table->dateTime('heure_sortie')->nullable();
            $table->decimal('duree_heures', 5, 2)->nullable();
            $table->decimal('montant', 10, 2)->nullable();
            $table->enum('statut', ['actif', 'payé', 'annulé'])->default('actif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
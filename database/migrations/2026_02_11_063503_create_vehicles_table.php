<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('vehicles', function (Blueprint $table) {
        $table->id();
        $table->string('immatriculation', 20);
        $table->enum('type_vehicule', ['voiture', 'moto']);
        $table->string('ticket_number', 20)->unique();
        $table->dateTime('heure_entree');
        $table->dateTime('heure_sortie')->nullable();
        $table->decimal('duree_heures', 5, 2)->nullable();
        $table->decimal('montant', 10, 2)->nullable();
        $table->enum('statut', ['garé', 'sorti'])->default('garé');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->enum('type', ['mensuel', 'trimestriel', 'annuel']);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->decimal('montant', 10, 2);
            $table->enum('statut', ['actif', 'expiré', 'annulé'])->default('actif');
            $table->timestamps();

            // Clé étrangère
            $table->foreign('client_id')
                  ->references('id')
                  ->on('clients');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abonnements');
    }
};
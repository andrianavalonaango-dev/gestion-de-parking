<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 10);
            $table->enum('type', ['voiture', 'moto']);
            $table->enum('statut', ['libre', 'occupée'])->default('libre');
            $table->unsignedBigInteger('parking_id')->nullable();
            $table->timestamps();

            // Clé étrangère
            $table->foreign('parking_id')
                  ->references('id')
                  ->on('parkings');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
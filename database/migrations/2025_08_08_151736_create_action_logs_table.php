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
        Schema::create('action_logs', function (Blueprint $table) {
            $table->id();
            $table->string('model'); // Nombre del modelo
            $table->unsignedBigInteger('model_id')->nullable(); // ID del registro
            $table->string('action'); // created, updated, deleted
            $table->json('changes')->nullable(); // Datos modificados
            $table->unsignedBigInteger('user_id')->nullable(); // Quién lo hizo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_logs');
    }
};

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
        Schema::create('content_carousels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_content');
            $table->unsignedBigInteger('id_carousel');

            $table->foreign('id_content')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('id_carousel')->references('id')->on('carrusel_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_carousels');
    }
};

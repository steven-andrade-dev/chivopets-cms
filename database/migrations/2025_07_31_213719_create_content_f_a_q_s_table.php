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
        Schema::create('content_f_a_q_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_content');
            $table->unsignedBigInteger('id_faq');

            $table->foreign('id_content')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('id_faq')->references('id')->on('FAQs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_f_a_q_s');
    }
};

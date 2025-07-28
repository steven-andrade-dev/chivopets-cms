<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rol', function (Blueprint $table) {
            $table->id('rol_id');
            $table->string('name');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
        });

        Schema::create('user', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('lastname');
            $table->unsignedBigInteger('id_rol');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();

            $table->foreign('id_rol')->references('rol_id')->on('rol')->onDelete('cascade');
        });

        Schema::create('section', function (Blueprint $table) {
            $table->id('id_section');
            $table->string('name');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->string('locale')->nullable();
        });

        Schema::create('content', function (Blueprint $table) {
            $table->id('id_content');
            $table->string('title');
            $table->string('description');
            $table->string('image');
            $table->string('subtitle');
            $table->string('url');
            $table->unsignedBigInteger('id_section');
            $table->integer('tipe_carrusel')->nullable();
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->string('locale')->nullable();

            $table->foreign('id_section')->references('id_section')->on('section')->onDelete('cascade');
        });

        Schema::create('carrusel_item', function (Blueprint $table) {
            $table->id('id_carrusel');
            $table->unsignedBigInteger('id_content');
            $table->string('title');
            $table->string('subtitle');
            $table->string('image');
            $table->string('href');
            $table->string('introduction');
            $table->string('description');
            $table->decimal('value', 10, 2)->nullable();
            $table->string('title_info_aditional')->nullable();
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->string('locale')->nullable();

            $table->foreign('id_content')->references('id_content')->on('content')->onDelete('cascade');
        });

        Schema::create('FAQ', function (Blueprint $table) {
            $table->id('id_faq');
            $table->unsignedBigInteger('id_content');
            $table->string('question');
            $table->string('answer');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->string('locale')->nullable();

            $table->foreign('id_content')->references('id_content')->on('content')->onDelete('cascade');
        });

        Schema::create('description_case', function (Blueprint $table) {
            $table->id('id_descrition');
            $table->string('description');
            $table->string('etiqueta');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->string('locale')->nullable();
        });

        Schema::create('case', function (Blueprint $table) {
            $table->id('id_case');
            $table->string('image');
            $table->string('image_author');
            $table->string('author');
            $table->string('area');
            $table->string('name');
            $table->string('introduction');
            $table->unsignedBigInteger('id_description');
            $table->datetime('date');
            $table->string('text_button');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->string('locale')->nullable();

            $table->foreign('id_description')->references('id_descrition')->on('description_case')->onDelete('cascade');
        });

        Schema::create('main', function (Blueprint $table) {
            $table->id('id_main');
            $table->string('name');
            $table->string('url');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->string('locale')->nullable();
        });

        Schema::create('submain', function (Blueprint $table) {
            $table->id('id_submain');
            $table->unsignedBigInteger('id_main');
            $table->string('name');
            $table->string('url');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->string('locale')->nullable();

            $table->foreign('id_main')->references('id_main')->on('main')->onDelete('cascade');
        });

        Schema::create('socialmedia_terms', function (Blueprint $table) {
            $table->id('id_submain');
            $table->string('name');
            $table->string('url');
            $table->string('icon');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->string('locale')->nullable();
        });

        Schema::create('locale', function (Blueprint $table) {
            $table->id();
            $table->string('document_id');
            $table->string('name');
            $table->string('code');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->string('locale')->nullable();
        });

        Schema::create('indice', function (Blueprint $table) {
            $table->id();
            $table->string('document_id');
            $table->string('action');
            $table->string('model');
            $table->unsignedBigInteger('id_entry');
            $table->json('data_before')->nullable();
            $table->json('data_after')->nullable();
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->string('locale')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indice');
        Schema::dropIfExists('locale');
        Schema::dropIfExists('socialmedia_terms');
        Schema::dropIfExists('submain');
        Schema::dropIfExists('main');
        Schema::dropIfExists('case');
        Schema::dropIfExists('description_case');
        Schema::dropIfExists('FAQ');
        Schema::dropIfExists('carrusel_item');
        Schema::dropIfExists('content');
        Schema::dropIfExists('section');
        Schema::dropIfExists('user');
        Schema::dropIfExists('rol');
    }
};

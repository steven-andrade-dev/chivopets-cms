<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->enum('status', ['Borrador', 'Creado', 'Publicado', 'Archivado'])->default('Creado');
            $table->integer('section_id_parent')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->unsignedBigInteger('id_locale');

            $table->foreign('id_locale')->references('id')->on('locals')->onDelete('cascade');
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('bloque_principal')->nullable();
            $table->text('bloque_secundario')->nullable();
            $table->string('image')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('url')->nullable();
            $table->unsignedBigInteger('id_section');
            $table->integer('type_carrusel')->nullable();
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->enum('status', ['Borrador', 'Creado', 'Publicado', 'Archivado'])->default('Creado');
            $table->integer('content_id_parent')->nullable();
            $table->unsignedBigInteger('id_locale');

            $table->foreign('id_locale')->references('id')->on('locals')->onDelete('cascade');

            $table->foreign('id_section')->references('id')->on('sections')->onDelete('cascade');
        });

        Schema::create('carrusel_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('image')->nullable();
            $table->string('href')->nullable();
            $table->string('introduction')->nullable();
            $table->text('description')->nullable();
            $table->decimal('value')->nullable();
            $table->string('title_info_aditional')->nullable();
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->unsignedBigInteger('id_locale');

            $table->foreign('id_locale')->references('id')->on('locals')->onDelete('cascade');
        });

        Schema::create('FAQs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->unsignedBigInteger('id_locale');

            $table->foreign('id_locale')->references('id')->on('locals')->onDelete('cascade');


        });


        Schema::create('tips', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('image_author');
            $table->string('author');
            $table->string('area');
            $table->string('name');
            $table->text('introduction');
            $table->string('text_button');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->unsignedBigInteger('id_locale');

            $table->foreign('id_locale')->references('id')->on('locals')->onDelete('cascade');
        });

        Schema::create('description_tips', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->integer('order');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->unsignedBigInteger('id_locale');
            $table->unsignedBigInteger('id_tips');

            $table->foreign('id_locale')->references('id')->on('locals')->onDelete('cascade');
            $table->foreign('id_tips')->references('id')->on('tips')->onDelete('cascade');
        });

        Schema::create('case', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('image_author');
            $table->string('author');
            $table->string('area');
            $table->string('name');
            $table->text('introduction');
            $table->string('text_button');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->unsignedBigInteger('id_locale');

            $table->foreign('id_locale')->references('id')->on('locals')->onDelete('cascade');
        });

        Schema::create('description_case', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->integer('order');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->unsignedBigInteger('id_locale');
            $table->unsignedBigInteger('id_case');

            $table->foreign('id_locale')->references('id')->on('locals')->onDelete('cascade');
            $table->foreign('id_case')->references('id')->on('case')->onDelete('cascade');
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->boolean('status')->default(true); // true = visible, false = oculto
            $table->integer('type'); // 1 = header, 2 = footer, 3 - boton
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->unsignedBigInteger('id_locale');

            $table->foreign('id_locale')->references('id')->on('locals')->onDelete('cascade');
        });

        Schema::create('submenus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_menu');
            $table->string('name');
            $table->string('url');
            $table->boolean('status')->default(true); // true = visible, false = oculto
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->unsignedBigInteger('id_locale');

            $table->foreign('id_locale')->references('id')->on('locals')->onDelete('cascade');

            $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade');
        });

        Schema::create('socialmedia_terms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('icon');
            $table->timestamps();
            $table->datetime('published_at')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->unsignedBigInteger('id_locale');

            $table->foreign('id_locale')->references('id')->on('locals')->onDelete('cascade');
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
            $table->unsignedBigInteger('id_locale');

            $table->foreign('id_locale')->references('id')->on('locals')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indice');
        Schema::dropIfExists('locale');
        Schema::dropIfExists('socialmedia_terms');
        Schema::dropIfExists('submenus');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('case');
        Schema::dropIfExists('description_case');
        Schema::dropIfExists('FAQs');
        Schema::dropIfExists('carrusel_items');
        Schema::dropIfExists('contents');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('user');
        Schema::dropIfExists('rol');
        Schema::dropIfExists('tips');
        Schema::dropIfExists('description_tips');
    }
};

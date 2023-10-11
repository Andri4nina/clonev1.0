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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('titre_blog');
            $table->string('sous_titre_blog')->nullable();
            $table->longText('contenu_blog');
            $table->string('type_blog');
            $table->string('url_blog')->nullable();
            $table->string('couv_blog')->nullable();
            $table->string('status_blog')->default('En attente');
            $table->date('date_publi_blog')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

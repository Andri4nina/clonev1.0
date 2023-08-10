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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table-> string('titre_publi');
            $table-> string('sous_titre_publi')->nullable();
            $table-> string('img_couv_publi')->nullable();
            $table-> text('contenu_publi')->nullable();
            $table-> string('piece_jointe_publi')->nullable();
            $table-> string('status_publi')->default('En attente');
            $table-> foreignId('id_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};

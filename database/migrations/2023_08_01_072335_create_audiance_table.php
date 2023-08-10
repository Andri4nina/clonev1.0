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
        Schema::create('audiance', function (Blueprint $table) {
            $table->id();
            $table->text('libelle_aud');
            $table->text('status_aud');
            $table->date('date_aud')->nullable();
            $table->time('heure_aud')->nullable();
            $table->foreignId('id_vis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Audiance~');
    }
};

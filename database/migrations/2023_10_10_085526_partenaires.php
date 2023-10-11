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
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom_partenaire');
            $table->string('abbrev_partenaire')->nullable();
            $table->longText('histoire_partenaire');
            $table->string('siteOff_partenaire')->nullable();
            $table->string('logo_partenaire')->nullable();
            $table->string('status_partenaire')->default('En attente');
            $table->date('date_relation_partenaire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->char('status_user', 15)->default('hors-ligne');
            $table->char('theme_user', 10)->default('bleu');
            $table->char('mode_user', 10)->default('light');
            $table->char('role_user', 10)->unique();
            $table->datetime('date_deconnexion_Utilisateur')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('prvlg_creation_super_user')->default(false);
            $table->boolean('prvlg_suppression_super_user')->default(false);
            $table->boolean('prvlg_creation_user')->default(false);
            $table->boolean('prvlg_suppression_user')->default(false);
            $table->boolean('prvlg_approb_blog')->default(false);
            $table->boolean('prvlg_publi_blog')->default(false);
            $table->boolean('prvlg_creation')->default(false);
            $table->boolean('prvlg_suppression')->default(false);
            $table->boolean('prvlg_modification')->default(false);


            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

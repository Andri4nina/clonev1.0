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
            $table->string('pdp');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->char('status_user', 15)->default('hors-ligne');
            $table->char('theme_user', 10)->default('bleu');
            $table->char('mode_user', 10)->default('light');
            $table->char('role_user', 50);
            $table->char('tel_user', 25);
            $table->boolean('prvlg_super_user')->default(false);
            $table->boolean('prvlg_task')->default(false);
            $table->boolean('prvlg_create_user')->default(false);
            $table->boolean('prvlg_delete_user')->default(false);
            $table->boolean('prvlg_update_user')->default(false);
            $table->boolean('prvlg_membre')->default(false);
            $table->boolean('prvlg_project')->default(false);
            $table->boolean('prvlg_partenaire')->default(false);
            $table->boolean('prvlg_create_blog')->default(false);
            $table->boolean('prvlg_delete_blog')->default(false);
            $table->boolean('prvlg_update_blog')->default(false);
            $table->boolean('prvlg_approv_blog')->default(false);
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

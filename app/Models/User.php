<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /* insertion de maniere grouper */
    protected $fillable = [
        'pdp',
        'name',
        'email',
        'password',
        'status_user',
        'theme_user',
        'mode_user',
        'role_user',
        'tel_user',
        'prvlg_super_user',
        'prvlg_task',
        'prvlg_create_user',
        'prvlg_delete_user',
        'prvlg_update_user',
        'prvlg_membre',
        'prvlg_project',
        'prvlg_partenaire',
        'prvlg_create_blog',
        'prvlg_delete_blog',
        'prvlg_update_blog',
        'prvlg_approv_blog'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

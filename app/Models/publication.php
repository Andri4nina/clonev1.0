<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publication extends Model
{
    use HasFactory;

    protected $fillable = ['
    titre_publi',
    'sous-titre_publi',
    'contenu_publi',
    'img_couv_publi',
    'status_publi',
    'id_user'
    ];
}

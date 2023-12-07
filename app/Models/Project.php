<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre_project',
        'contenu_project',
        'zone_project',
        'status_project',
        'date_publi_project'
    ];
}

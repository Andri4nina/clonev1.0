<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;
    protected $fillable = [
        'pdp_membre',
        'nom_membre',
        'poste_membre',
        'descri_membre',
        'date_adhesion_membre',
    ];
}

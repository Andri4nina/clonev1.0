<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audiance extends Model
{
    protected $fillable = [
        'libelle_aud',
        'status_aud',
        'date_aud',
        'heure_aud',
    ];
}

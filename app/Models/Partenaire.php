<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_partenaire',
        'abbrev_partenaire',
        'histoire_partenaire',
        'siteOff_partenaire',
        'logo_partenaire',
        'status_partenaire',
        'date_relation_partenaire'
    ];
}

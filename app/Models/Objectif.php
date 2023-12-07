<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objectif extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle_obj',
        'status_obj',
        'project_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'nom', 
        'abreviation', 
        'url', 
        'histoire',
        'status_part'
    ];

}

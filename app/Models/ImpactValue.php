<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpactValue extends Model
{
    use HasFactory;
    protected $fillable = ['enfants', 'adolescents', 'adultes'];
}

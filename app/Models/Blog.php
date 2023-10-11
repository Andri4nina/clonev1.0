<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre_blog', 
        'sous_titre_blog', 
        'contenu_blog', 
        'type_blog', 
        'url_blog', 
        'couv_blog', 
        'status_blog', 
        'date_publi_blog', 
        'user_id'
    ];
    
}

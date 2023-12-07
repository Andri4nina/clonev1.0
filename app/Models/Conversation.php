<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'id_user1',
        'id_user2',
        'type',
    ];

    // Vous pouvez ajouter des relations ici, par exemple, avec la table des utilisateurs
    public function user1()
    {
        return $this->belongsTo(User::class, 'id_user1');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'id_user2');
    }
}

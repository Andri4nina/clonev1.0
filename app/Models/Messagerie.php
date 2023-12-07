<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messagerie extends Model
{
    protected $fillable = [
        'id_user',
        'id_conversation',
        'Libelle',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'id_conversation');
    }
}
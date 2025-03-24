<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'utilisateur_id',
        'sujet',
        'description',
        'statut',
        'category_id',
        'piece_jointe',
        'created_by',
    ];

    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    
}

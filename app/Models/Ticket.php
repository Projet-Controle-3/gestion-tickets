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
   // Un ticket appartient à un seul utilisateur
    public function utilisateur()
   {
    return $this->belongsTo(utilisateur::class);
   }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
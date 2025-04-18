<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Model;

#[ApiResource]
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

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
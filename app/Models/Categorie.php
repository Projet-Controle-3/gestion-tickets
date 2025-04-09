<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Model;

#[ApiResource]

class Categorie extends Model

{
    protected $fillable = [
        'nom', 'description'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class , 'category_id');
    }
}


<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Model;

#[ApiResource]

class Comment extends Model
{
    protected $fillable = [
        'utilisateur_id',
        'response_id',
        'messages',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function response()
    {
        return $this->belongsTo(Response::class);
    }
}

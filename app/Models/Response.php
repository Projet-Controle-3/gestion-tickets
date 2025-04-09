<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Model;

#[ApiResource]
class Response extends Model
{
    protected $fillable = [
        'utilisateur_id',
        'ticket_id',
        'message'
    ];

    // utilisateur (support) peut envoyer plusieurs réponse
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    // ticket peut avoir plusieurs réponse
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
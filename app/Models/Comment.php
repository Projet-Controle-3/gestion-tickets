<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

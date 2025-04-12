<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[ApiResource]
class Utilisateur extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nom',
        'email',
        'password',
        'role',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarAttribute()
    {
        return 'images/' . ($this->role === 'admin' ? 'admin.png' : ($this->role === 'support' ? 'support.png' : 'User.png'));
    }

    public function getPhotoUrlAttribute()
    {
        return 'storage/photos/' . $this->photo;
    }

    public function getImageAttribute()
    {

        $photoPath = $this->getPhotoUrlAttribute();

        if (file_exists(public_path($photoPath))) {
            return asset($photoPath);
        }

        return asset($this->getAvatarAttribute());
    
    }



    // Un utilisateur peut avoir plusieurs tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}
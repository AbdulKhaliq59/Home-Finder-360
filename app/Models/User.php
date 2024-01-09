<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;

class User extends AuthenticatableUser implements Authenticatable
{
    use Notifiable;

    protected $fillable = [
        "name",
        "email",
        "password",
        "role"
    ];
    public function houses(): HasMany
    {
        return $this->hasMany(House::class);
    }
}

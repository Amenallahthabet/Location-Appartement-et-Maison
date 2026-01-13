<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Clients extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'clients';
    protected $rememberTokenName = null;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'num_tel',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function logements()
    {
        return $this->hasMany(Logement::class, 'locateur_id');
    }
    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }
}

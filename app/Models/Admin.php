<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['nom','email','password'];

    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }

    public function clients()
    {
        return $this->hasMany(clients::class);
    }
}

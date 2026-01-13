<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logement extends Model
{
    protected $fillable = ['titre','description','type','adresse','ville','nb_chambres','photos','prix','locateur_id'];

    protected $casts = [
        'photos' => 'array',
        'published' => 'boolean',
    ];

    public function annonce()
    {
        return $this->hasOne(Annonce::class);
    }

    public function locateur()
    {
        return $this->belongsTo(Clients::class, 'locateur_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'logment_id',
        'client_id',
        'locateur_id',
        'status'
    ];

    public function logement()
    {
        return $this->belongsTo(Logement::class, 'logment_id'); 
    }
    
     public function client()
    {
        return $this->belongsTo(ClientS::class, 'client_id');
    }

    public function locateur()
    {
        return $this->belongsTo(Client::class, 'locateur_id');
    }

    public function accepter()
    {
        $this->update(['status' => 'accepte']);
    }

    public function refuser()
    {
        $this->update(['status' => 'refuse']);
    }
}

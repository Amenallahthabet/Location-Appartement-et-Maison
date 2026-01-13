<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = ['titre','description','date_publication','user_id','logement_id'];

    protected $dates = ['date_publication'];

    public function clients()
    {
        return $this->belongsTo(clients::class);
    }


    public function logement()
    {
        return $this->belongsTo(Logement::class);
    }
}

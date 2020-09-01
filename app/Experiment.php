<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiment extends Model
{
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id_owner');
    }

}

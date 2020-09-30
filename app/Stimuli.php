<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Stimuli extends Model
{
    protected $table = 'stimuli';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id_owner');
    }

}

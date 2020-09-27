<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiment extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id_owner');
    }

    public function stimuli_lists()
    {
        return $this->belongsToMany('App\StimuliList', 'list_in_experiments', 
      'experiment_id', 'stimuli_list_id');
    }


}

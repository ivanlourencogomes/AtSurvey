<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StimuliList extends Model
{
    public function stimulis()
    {
        return $this->belongsToMany('App\Stimuli', 'stimuli_in_lists', 
      'stimuli_id', 'list_id');
    }
}

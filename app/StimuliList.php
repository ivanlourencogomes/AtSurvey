<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StimuliList extends Model
{
    public function list_in_experiment()
    {
        return $this->hasMany('App\ListInExperiment', 'stimuli_list_id');
    }
}

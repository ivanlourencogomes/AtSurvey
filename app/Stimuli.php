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

    public function answerField()
    {
        return $this->belongsToMany('App\AnswerField', 'answer_fields_in_stimuli', 
      'stimuli_id', 'answer_field_id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldType extends Model
{
    public function answerField()
    {
        return $this->belongsToMany('App\AnswerField', 'field_type_id');
    }
}

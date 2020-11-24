<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "questions";

    protected $casts = [
        'created_at' => 'datetime:yy-m-d h:i:s',
        'updated_at' => 'datetime:yy-m-d h:i:s',
    ];

    public function selection()
    {
        return $this->belongsTo('App\Models\Selection', 'group_question_id', 'id');
    }

    public function test()
    {
        return $this->belongsTo('App\Models\Test', 'sub_group_question_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'question_id', 'id');
    }

    public function solving()
    {
        return $this->hasOne('App\Models\Solve', 'question_id', 'id');
    }
}

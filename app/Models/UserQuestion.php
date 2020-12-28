<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuestion extends Model
{
    protected $table = "user_question_answer";

    protected $casts = [
        'created_at' => 'datetime:yy-m-d h:i:s',
        'updated_at' => 'datetime:yy-m-d h:i:s',
    ];

    public function question()
    {
        return $this->hasOne('App\Models\Question', 'id', 'question_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = "answers";

    protected $fillable = ["text_answer", "is_true", "question_id"];

    protected $casts = [
        'created_at' => 'datetime:yy-m-d h:i:s',
        'updated_at' => 'datetime:yy-m-d h:i:s',
    ];
}

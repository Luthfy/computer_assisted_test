<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = "sub_group_questions";

    protected $fillable = ["code_sub_group_question", "name_sub_group_question", "passing_grade", "group_question_id"];

    protected $casts = [
        'created_at' => 'datetime:yy-m-d h:i:s',
        'updated_at' => 'datetime:yy-m-d h:i:s',
    ];

    public function selection()
    {
        return $this->belongsTo('App\Models\Selection', 'group_question_id', 'id');
    }
}

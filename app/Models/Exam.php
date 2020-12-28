<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = "exams";

    protected $primarykey = "code_exam";

    public $incrementing = false;

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

    public function user_question()
    {
        return $this->hasMany('App\Models\UserQuestion', 'exam_id', 'code_exam');
    }
}

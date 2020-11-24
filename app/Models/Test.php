<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = "sub_group_questions";

    protected $fillable = ["code_sub_group_question", "name_sub_group_question"];

    protected $casts = [
        'created_at' => 'datetime:yy-m-d h:i:s',
        'updated_at' => 'datetime:yy-m-d h:i:s',
    ];
}

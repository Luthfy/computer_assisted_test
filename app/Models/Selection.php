<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    protected $table = "group_questions";

    protected $fillable = ["code_group_question", "name_group_question"];

    protected $casts = [
        'created_at' => 'datetime:yy-m-d h:i:s',
        'updated_at' => 'datetime:yy-m-d h:i:s',
    ];
}

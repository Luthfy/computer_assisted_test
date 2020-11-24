<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solve extends Model
{
    protected $table = "problem_solvings";

    // protected $fillable = ["code_group_question", "name_group_question"];

    protected $casts = [
        'created_at' => 'datetime:yy-m-d h:i:s',
        'updated_at' => 'datetime:yy-m-d h:i:s',
    ];
}

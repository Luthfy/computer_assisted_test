<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = "exams";

    protected $casts = [
        'created_at' => 'datetime:yy-m-d h:i:s',
        'updated_at' => 'datetime:yy-m-d h:i:s',
    ];
}

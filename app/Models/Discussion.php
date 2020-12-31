<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $table = 'problem_solvings';

    protected $fillable = [
        'question_id', 'text_problem_solving'
    ];
}

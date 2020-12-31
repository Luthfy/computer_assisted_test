<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Discussion;

class ProblemSolvingController extends Controller
{
    public function create($id_question)
    {
        $data = [
            'title' => 'Tambah Pembahasan',
            'data' => null,
            'question' => Question::find($id_question)
        ];
        return view('administrator.problem_solving.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required',
            'text_problem_solving' => 'required'
        ]);

        $insert = Discussion::create($request->only(['question_id', 'text_problem_solving']));

        if ($insert)
        {
            return redirect('control-panel/questions/' . $request->question_id)->with('info', 'Pembahasan berhasil ditambahkan');
        }
    }
}

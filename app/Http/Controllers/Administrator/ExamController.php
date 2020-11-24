<?php

namespace App\Http\Controllers\Administrator;

use App\User;
use App\Models\Exam;
use App\Models\Test;
use Ramsey\Uuid\Uuid;
use App\Models\Selection;
use Illuminate\Http\Request;
use App\DataTables\ExamsDataTable;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExamsDataTable $datatable)
    {
        $data = [
            "title" => 'Data Ujian',
            "data" => null
        ];

        return $datatable->render('administrator.exam.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $participants    = User::where('user_role', 'participant')->get();
        $selections      = Selection::all();
        $tests           = Test::all();

        foreach ($participants as $value) {
            $participant_parsing[$value->id] = $value->name . " (". $value->email .")";
        }

        foreach ($selections as $value) {
            $selection_parsing[$value->id] = $value->code_group_question . " - " . $value->name_group_question;
        }

        foreach ($tests as $value) {
            $test_parsing[$value->id] = $value->code_sub_group_question . " - " . $value->name_sub_group_question;
        }

        $data = [
            "title"             => 'Tambah Ujian',
            "selection_group"   => $selection_parsing ?? null,
            "test_group"        => $test_parsing ?? null,
            "participant_group" => $participant_parsing ?? null,
            "code_exam"         => Uuid::uuid4()->toString(),
            "data"              => null
        ];

        return view('administrator.exam.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_exam'             => 'required',
            'package_exam'          => 'required',
            'group_question_id'     => 'required',
            'sub_group_question_id' => 'required',
            'participant_id'        => 'required'
        ]);

        $exam = new Exam();
        $exam->code_exam                = $request->code_exam;
        $exam->package_exam             = $request->package_exam;
        $exam->group_question_id        = $request->group_question_id;
        $exam->sub_group_question_id    = $request->group_question_id;
        $exam->user_id                  = $request->participant_id;
        $insert = $exam->save();

        if ($insert)
        {
            return redirect('control-panel/exams')->with('info', 'Paket Ujian Telah Dibuat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $question = Question::findOrFail($id);

        // $data = [
        //     'title' => 'Detail Pertanyaan',
        //     'data' => $question
        // ];

        // return view('administrator.question.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $question = Question::findOrFail($id);

        // $selections = Selection::all();

        // foreach ($selections as $value) {
        //     $selection_parsing[$value->id] = $value->code_group_question . " - " . $value->name_group_question;
        // }

        // $tests = Test::all();

        // foreach ($tests as $value) {
        //     $test_parsing[$value->id] = $value->code_sub_group_question . " - " . $value->name_sub_group_question;
        // }

        // $data = [
        //     "title" => 'Ubah Pertanyaan',
        //     "selection_group" => $selection_parsing ?? null,
        //     "test_group" => $test_parsing ?? null,
        //     "data" => $question,
        // ];

        // return view('administrator.question.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // $request->validate([
        //     'group_question_id' => 'required',
        //     'sub_group_question_id' => 'required',
        //     'text_question' => 'required'
        // ]);

        // switch ($request->is_true) {
        //     case '0':
        //         $correct_question = $request->text_answer_a;
        //         break;
        //     case '1':
        //         $correct_question = $request->text_answer_b;
        //         break;
        //     case '2':
        //         $correct_question = $request->text_answer_c;
        //         break;
        //     case '3':
        //         $correct_question = $request->text_answer_d;
        //         break;
        //     case '4':
        //         $correct_question = $request->text_answer_e;
        //         break;
        //     default:
        //         $correct_question = "";
        //         break;
        // }

        // $question = Question::find($id);
        // $question->text_question            = $request->text_question;
        // $question->correct_question         = $correct_question;
        // $question->group_question_id        = $request->group_question_id;
        // $question->sub_group_question_id    = $request->sub_group_question_id;
        // $question->save();

        // $answer_a = Answer::find($request->id_answer_a);
        // $answer_a->text_answer = $request->text_answer_a;
        // $answer_a->is_true = $request->is_true == "0" ? "1" : "0";
        // $answer_a->save();

        // $answer_b = Answer::find($request->id_answer_b);
        // $answer_b->text_answer = $request->text_answer_b;
        // $answer_b->is_true = $request->is_true == "1" ? "1" : "0";
        // $answer_b->save();

        // $answer_c = Answer::find($request->id_answer_c);
        // $answer_c->text_answer = $request->text_answer_c;
        // $answer_c->is_true = $request->is_true == "2" ? "1" : "0";
        // $answer_c->save();

        // $answer_d = Answer::find($request->id_answer_d);
        // $answer_d->text_answer = $request->text_answer_d;
        // $answer_d->is_true = $request->is_true == "3" ? "1" : "0";
        // $answer_d->save();

        // $answer_e = Answer::find($request->id_answer_e);
        // $answer_e->text_answer = $request->text_answer_e;
        // $answer_e->is_true = $request->is_true == "4" ? "1" : "0";
        // $answer_e->save();

        // return redirect('control-panel/questions')->with('info', 'Soal dan Jawaban berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $delete = User::findOrFail($id)->delete();

        // if ($delete)
        // {
        //     return TRUE;
        // }
        // else
        // {
        //     return false;
        // }
    }
}

<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\QuestionDataTable;
use App\Models\Answer;
use App\Models\Discussion;
use App\Models\Question;
use App\Models\Selection;
use App\Models\Test;

class QuestionAndAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionDataTable $datatable)
    {
        $data = [
            "title" => 'Data Pertanyaan',
            "data" => null
        ];

        return $datatable->render('administrator.question.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selections = Selection::all();

        foreach ($selections as $value) {
            $selection_parsing[$value->id] = $value->code_group_question . " - " . $value->name_group_question;
        }

        $tests = Test::all();

        foreach ($tests as $value) {
            $test_parsing[$value->id] = $value->code_sub_group_question . " - " . $value->name_sub_group_question;
        }

        $data = [
            "title" => 'Tambah Pertanyaan',
            "selection_group" => $selection_parsing ?? null,
            "test_group" => $test_parsing ?? null,
            "data" => null
        ];

        return view('administrator.question.form', $data);
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
            'group_question_id' => 'required',
            'sub_group_question_id' => 'required',
            'text_question' => 'required',
            'is_true' => 'required'
        ]);

        switch ($request->is_true) {
            case '0':
                $correct_question = $request->text_answer_a;
                break;
            case '1':
                $correct_question = $request->text_answer_b;
                break;
            case '2':
                $correct_question = $request->text_answer_c;
                break;
            case '3':
                $correct_question = $request->text_answer_d;
                break;
            case '4':
                $correct_question = $request->text_answer_e;
                break;
            default:
                $correct_question = "";
                break;
        }

        $question = new Question();
        $question->group_question_id        = $request->group_question_id;
        $question->sub_group_question_id    = $request->sub_group_question_id;
        $question->sub_test                 = $request->sub_test;
        $question->text_question            = $request->text_question;
        $question->correct_question         = $correct_question;
        $insert = $question->save();

        for ($i=0; $i < 5; $i++)
        {
            switch ($i) {
                case '0':
                    if ($request->text_answer_a != null)
                    {
                        $answer = [
                            "text_answer" => $request->text_answer_a,
                            "poin_answer" => $request->text_poin_a,
                            "is_true" => $request->is_true == "0" ? "1" : "0",
                            "question_id" => $question->id ?? null
                        ];
                    }
                    break;
                case '1':
                    if ($request->text_answer_b != null)
                    {
                        $answer = [
                            "text_answer" => $request->text_answer_b,
                            "poin_answer" => $request->text_poin_b,
                            "is_true" => $request->is_true == "1" ? "1" : "0",
                            "question_id" => $question->id ?? null
                        ];
                    }
                    break;
                case '2':
                    if ($request->text_answer_c != null)
                    {
                        $answer = [
                            "text_answer" => $request->text_answer_c,
                            "poin_answer" => $request->text_poin_c,
                            "is_true" => $request->is_true == "2" ? "1" : "0",
                            "question_id" => $question->id ?? null
                        ];
                    }
                    break;
                case '3':
                    if ($request->text_answer_d != null)
                    {
                        $answer = [
                            "text_answer" => $request->text_answer_d,
                            "poin_answer" => $request->text_poin_d,
                            "is_true" => $request->is_true == "3" ? "1" : "0",
                            "question_id" => $question->id ?? null
                        ];
                    }
                    break;
                case '4':
                    if ($request->text_answer_e != null)
                    {
                        $answer = [
                            "text_answer" => $request->text_answer_e,
                            "poin_answer" => $request->text_poin_e,
                            "is_true" => $request->is_true == "4" ? "1" : "0",
                            "question_id" => $question->id ?? null
                        ];
                    }
                    break;
            }
            Answer::create($answer);
        }

        if ($insert)
        {
            return redirect('control-panel/questions')->with('info', 'Soal berhasil ditambahkan');
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
        $question = Question::findOrFail($id);

        $data = [
            'title' => 'Detail Pertanyaan',
            'data' => $question,
            'pembahasan' => Discussion::where('question_id', $id)->first()
        ];

        return view('administrator.question.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);

        $selections = Selection::all();

        foreach ($selections as $value) {
            $selection_parsing[$value->id] = $value->code_group_question . " - " . $value->name_group_question;
        }

        $tests = Test::all();

        foreach ($tests as $value) {
            $test_parsing[$value->id] = $value->code_sub_group_question . " - " . $value->name_sub_group_question;
        }

        $data = [
            "title" => 'Ubah Pertanyaan',
            "selection_group" => $selection_parsing ?? null,
            "test_group" => $test_parsing ?? null,
            "data" => $question,
        ];

        return view('administrator.question.form', $data);
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

        $request->validate([
            'group_question_id' => 'required',
            'sub_group_question_id' => 'required',
            'text_question' => 'required'
        ]);

        switch ($request->is_true) {
            case '0':
                $correct_question = $request->text_answer_a;
                break;
            case '1':
                $correct_question = $request->text_answer_b;
                break;
            case '2':
                $correct_question = $request->text_answer_c;
                break;
            case '3':
                $correct_question = $request->text_answer_d;
                break;
            case '4':
                $correct_question = $request->text_answer_e;
                break;
            default:
                $correct_question = "";
                break;
        }

        $question = Question::find($id);
        $question->text_question            = $request->text_question;
        $question->correct_question         = $correct_question;
        $question->group_question_id        = $request->group_question_id;
        $question->sub_group_question_id    = $request->sub_group_question_id;
        $question->save();

        $answer_a = Answer::find($request->id_answer_a);
        $answer_a->text_answer = $request->text_answer_a;
        $answer_a->is_true = $request->is_true == "0" ? "1" : "0";
        $answer_a->save();

        $answer_b = Answer::find($request->id_answer_b);
        $answer_b->text_answer = $request->text_answer_b;
        $answer_b->is_true = $request->is_true == "1" ? "1" : "0";
        $answer_b->save();

        $answer_c = Answer::find($request->id_answer_c);
        $answer_c->text_answer = $request->text_answer_c;
        $answer_c->is_true = $request->is_true == "2" ? "1" : "0";
        $answer_c->save();

        $answer_d = Answer::find($request->id_answer_d);
        $answer_d->text_answer = $request->text_answer_d;
        $answer_d->is_true = $request->is_true == "3" ? "1" : "0";
        $answer_d->save();

        $answer_e = Answer::find($request->id_answer_e);
        $answer_e->text_answer = $request->text_answer_e;
        $answer_e->is_true = $request->is_true == "4" ? "1" : "0";
        $answer_e->save();

        return redirect('control-panel/questions')->with('info', 'Soal dan Jawaban berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_question    = Question::findOrFail($id)->delete();
        $delete_answer      = Answer::where('question_id', $id)->delete();

        if ($delete_question || $delete_answer)
        {
            return TRUE;
        }
        else
        {
            return false;
        }
    }
}

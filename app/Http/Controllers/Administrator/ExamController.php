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
use App\Models\UserQuestion;
use App\Models\Question;
use Carbon\Carbon;

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
            "participant_group" => $participant_parsing ?? [],
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
            'participant_id'        => 'required',
            'duration_exam'         => 'required|numeric'
        ]);

        $exam = new Exam();
        $exam->code_exam                = $request->code_exam;
        $exam->package_exam             = $request->package_exam;
        $exam->group_question_id        = $request->group_question_id;
        $exam->sub_group_question_id    = $request->group_question_id;
        $exam->user_id                  = $request->participant_id;
        $exam->duration_exam            = $request->duration_exam * 60;
        $exam->number_of_question       = $request->number_of_question;
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
        $exam = Exam::findOrFail($id);

        $data = [
            'title' => 'Detail Paket Ujian',
            'data' => $exam
        ];

        return view('administrator.exam.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Exam::findOrFail($id)->delete();

        if ($delete)
        {
            return TRUE;
        }
        else
        {
            return false;
        }
    }

    public function create_question($id)
    {
        $exam = Exam::findOrFail($id);

        $question = Question::where("group_question_id", $exam->group_question_id)->where("sub_group_question_id", $exam->sub_group_question_id)->get();

        $random = range(0, $exam->number_of_question - 1);
        shuffle($random);
        for ($i=0; $i < $exam->number_of_question; $i++) {
            $user_question = new UserQuestion();
            $user_question->uuid = Uuid::uuid4()->toString();
            $user_question->exam_id = $exam->code_exam;
            $user_question->question_id = $question[$random[$i]]->id;
            $user_question->save();
        }

        return true;

    }
}

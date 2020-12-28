<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Models\Exam;
use App\Models\Answer;
use App\Models\Question;
use App\Models\UserQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    private $test_result = 0;

    public function get_user_question($exam_id)
    {
        $exam = Exam::where('code_exam', $exam_id)->first();
        $user_question = UserQuestion::where('exam_id', $exam_id)->get();

        $questions = [];

        foreach ($user_question as $key) {
            $question = [
                "id_question" => $key->question->id,
                "selection_group" => $key->question->selection->name_group_question,
                "test_group" => $key->question->test->name_sub_group_question,
                "sub_test" => $key->question->sub_test,
                "text_question" => $key->question->text_question,
                "opsion_answer" => $key->question->answers
            ];
            array_push($questions, $question);
        }

        return response([
            "status" => true,
            "message" => "test will start",
            "data" => [
                "user" => User::find($exam->user_id),
                "exam" => [
                    "id_user" => $exam->user_id,
                    "code_exam" => $exam->code_exam,
                    "package_question" => $exam->package_exam,
                    "number_of_question" => $exam->number_of_question,
                    "duration" => $exam->duration_exam,
                    "selection_group" => $exam->selection->name_group_question,
                    "test_group" => $exam->test->name_sub_group_question,
                    "question" => $questions
                ]
            ]
        ]);

    }

    public function post_user_answer(Request $request)
    {
        $questions  = UserQuestion::where('exam_id', $request->code_exam)->get();
        $answer     = $request->user_answer;
        $poin       = 0;

        foreach ($questions as $q) {

            for ($i=0; $i < count($answer); $i++) {
                if ($q->question->correct_question == $answer[$i]['answer']) {
                    $poin = 1;
                    $this->test_result += 1;
                }

                UserQuestion::where('question_id', $answer[$i]['id_question'])->update(['user_answer' => $answer[$i]['answer'],'result_checking' => $poin]);

            }
            break;
        }

        $exam = Exam::where('code_exam', $request->code_exam)->first();
        $exam->test_result = $this->test_result;
        $exam->save();

        return response(['status'=>'success']);

    }

}

<?php

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 1000; $i++) {

            if ($i < 200) {
                $question_id = '1';
                $sub_question_id = '1';
            } else if ($i >= 200 && $i < 400) {
                $question_id = '1';
                $sub_question_id = '2';
            } else if ($i >= 400 && $i < 600) {
                $question_id = '1';
                $sub_question_id = '3';
            } else if ($i >= 600 && $i < 1000) {
                $question_id = '2';
                $sub_question_id = '4';
            }

            $question = Question::create([
                'sub_test' => 'uji coba SKD TWK',
                'text_question' => $i . '. percobaan soal dengan panjang 255',
                'correct_question' => 'jawaban benar',
                'group_question_id' => $question_id,
                'sub_group_question_id' => $sub_question_id
            ]);

            Answer::create([
                'text_answer' => 'jawaban salah',
                'poin_answer' => 0,
                'is_true' => '0',
                'question_id' => $question->id
            ]);
            Answer::create([
                'text_answer' => 'jawaban salah',
                'poin_answer' => 0,
                'is_true' => '0',
                'question_id' => $question->id
                ]);
            Answer::create([
                'text_answer' => 'jawaban benar',
                'poin_answer' => 0,
                'is_true' => '1',
                'question_id' => $question->id
            ]);
            Answer::create([
                'text_answer' => 'jawaban salah',
                'poin_answer' => 0,
                'is_true' => '0',
                'question_id' => $question->id
            ]);
            Answer::create([
                'text_answer' => 'jawaban salah',
                'poin_answer' => 0,
                'is_true' => '0',
                'question_id' => $question->id
            ]);


        }
    }
}

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Test;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Selection;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


// SKD 200 TWK 200 TIU 200 TKP SKB 400 Bidang
for ($i=0; $i < 200; $i++) {
    factory(Question::class)->create([
        'sub_test' => 'uji coba SKD TWK',
        'text_question' => $i . '. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        'correct_question' => 'jawaban benar',
        'group_question_id' => '1',
        'sub_group_question_id' => '1'
    ])->each(function ($question) {
        $question->answers()->save(factory(App\Models\Answer::class)->create([
            'text_answer' => 'jawaban salah',
            'is_true' => '0',
            'queston_id' => $question->id
        ],[
            'text_answer' => 'jawaban salah',
            'is_true' => '0',
            'queston_id' => $question->id
        ],[
            'text_answer' => 'jawaban benar',
            'is_true' => '1',
            'queston_id' => $question->id
        ],[
            'text_answer' => 'jawaban salah',
            'is_true' => '0',
            'queston_id' => $question->id
        ],[
            'text_answer' => 'jawaban salah',
            'is_true' => '0',
            'queston_id' => $question->id
        ]));
    });
}


// $factory->define(Question::class, function (Faker $faker) {
//     return factory(App\Models\Answer::class)->raw([

//     ]);
// });

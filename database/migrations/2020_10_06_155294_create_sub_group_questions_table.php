<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubGroupQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_group_questions', function (Blueprint $table) {
            $table->id();
            $table->string('code_sub_group_question',5);
            $table->string('name_sub_group_question')->nullable();
            $table->integer('passing_grade')->default(0);
            $table->unsignedBigInteger('group_question_id')->index()->nullable();
            $table->timestamps();

            $table->foreign('group_question_id')->references('id')->on('group_questions')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_group_questions');
    }
}

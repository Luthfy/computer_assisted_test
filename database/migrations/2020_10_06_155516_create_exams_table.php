<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('code_exam');
            $table->string('package_exam');
            $table->string('user_id');
            $table->string('group_question_id');
            $table->string('sub_group_question_id');
            $table->string('number_of_question')->default('40');
            $table->string('test_result')->nullable();
            $table->string('once_exam')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}

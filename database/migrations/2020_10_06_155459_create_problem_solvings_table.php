<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemSolvingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_solvings', function (Blueprint $table) {
            $table->id();
            $table->string('text_problem_solving');
            $table->string('media_problem_solving')->nullable();
            $table->string('media_type_problem_solving')->nullable();
            $table->foreignId('question_id')->index()->nullable();
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
        Schema::dropIfExists('problem_solvings');
    }
}

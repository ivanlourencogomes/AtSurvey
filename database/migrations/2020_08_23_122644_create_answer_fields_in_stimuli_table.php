<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerFieldsInStimuliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_fields_in_stimuli', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('answer_field_id');
            $table->unsignedBigInteger('stimuli_id');

            $table->primary(['answer_field_id', 'stimuli_id']);
            
            $table->foreign('answer_field_id')
                  ->references('id')->on('answer_fields')
                  ->onDelete('cascade');

            $table->foreign('stimuli_id')
                  ->references('id')->on('stimuli')
                  ->onDelete('cascade');
            
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
        Schema::dropIfExists('answer_fields_in_stimuli');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalDataFormInExperimentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_data_form_in_experiment', function (Blueprint $table) {
            $table->unsignedBigInteger('experiment_id');
            $table->unsignedBigInteger('personal_data_form_id');

            $table->primary('experiment_id');
            
            $table->foreign('experiment_id')
                  ->references('id')->on('experiments')
                  ->onDelete('cascade');

            $table->foreign('personal_data_form_id')
                  ->references('id')->on('personal_data_forms')
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
        Schema::dropIfExists('personal_data_form_in_experiment');
    }
}

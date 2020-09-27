<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListInExperimentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_in_experiments', function (Blueprint $table) {
            
            $table->unsignedBigInteger('stimuli_list_id');
            $table->unsignedBigInteger('experiment_id');

            $table->primary(['stimuli_list_id', 'experiment_id']);

            $table->foreign('stimuli_list_id')
                  ->references('id')->on('stimuli_lists')
                  ->onDelete('cascade');
            
            $table->foreign('experiment_id')
                  ->references('id')->on('experiments')
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
        Schema::dropIfExists('list_in_experiments');
    }
}

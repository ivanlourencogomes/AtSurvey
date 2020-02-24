<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStimuliInListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stimuli_in_list', function (Blueprint $table) {

            $table->unsignedBigInteger('stimuli_id');
            $table->unsignedBigInteger('list_id');

            $table->primary(['stimuli_id', 'list_id']);
            
            $table->foreign('stimuli_id')
                  ->references('id')->on('stimuli')
                  ->onDelete('cascade');

            $table->foreign('list_id')
                  ->references('id')->on('stimuli_lists')
                  ->onDelete('cascade');

            $table->integer('order');

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
        Schema::dropIfExists('stimuli_in_list');
    }
}

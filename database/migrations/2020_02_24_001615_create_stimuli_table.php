<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStimuliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stimuli', function (Blueprint $table) {
            $table->unsignedBigInteger('stimuli_type_id');
            $table->unsignedBigInteger('user_id_owner');

            $table->bigIncrements('id');
            $table->string('stimuli_name', 50)->nullable();
            
            $table->foreign('user_id_owner')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('stimuli_type_id')
                  ->references('id')->on('stimuli_types')
                  ->onDelete('cascade');
            
            $table->string('stimuli_text', 500)->nullable();
            $table->string('stimuli_resource_url', 2000)->nullable();

            $table->string('instruction_text', 200)->nullable();

            $table->string('item', 20)->nullable();
            $table->string('condition', 20)->nullable();
            $table->string('condition_code', 20)->nullable();
            

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
        Schema::dropIfExists('stimuli');
    }
}

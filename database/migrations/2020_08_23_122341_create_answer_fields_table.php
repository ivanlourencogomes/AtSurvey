<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_fields', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('label', 120)->nullable();
            $table->string('placeholder', 120)->nullable();

            $table->unsignedBigInteger('field_type_id');

            $table->foreign('field_type_id')
                  ->references('id')->on('field_types')
                  ->onDelete('cascade');
            
            $table->json('options')->nullable();

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
        Schema::dropIfExists('answer_fields');
    }
}

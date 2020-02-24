<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStimuliTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stimuli_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stimuli_type_name', 50);
            $table->string('stimuli_type_description', 500);
            $table->boolean('text_is_required')->default('1');
            $table->boolean('url_is_required')->default('0');

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
        Schema::dropIfExists('stimuli_types');
    }
}

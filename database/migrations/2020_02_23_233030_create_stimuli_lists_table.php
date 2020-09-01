<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStimuliListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stimuli_lists', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id_owner');
            $table->foreign('user_id_owner')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->string('list_name', 50);
            $table->string('list_description', 2000)->nullable();
            $table->boolean('is_public')->default('0');
            $table->integer('stimuli_per_page')->default(1);
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
        Schema::dropIfExists('stimuli_lists');
    }
}

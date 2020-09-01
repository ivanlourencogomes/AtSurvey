<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiments', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('user_id_owner');
            
            $table->foreign('user_id_owner')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->string('experiment_name', 100);
            $table->boolean('is_public')->default('0');
            $table->boolean('is_active')->default('0');

            $table->string('welcome_text', 2000);
            $table->string('consent_text', 2000);
            $table->string('consent_label', 200);
            $table->string('instructions_text', 2000);
            $table->string('ending_text', 2000);

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
        Schema::dropIfExists('experiments');
    }
}

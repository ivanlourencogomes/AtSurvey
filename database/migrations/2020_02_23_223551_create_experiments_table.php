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
            $table->unsignedBigInteger('user_id_owner');
            
            $table->bigIncrements('id');
            
            $table->foreign('user_id_owner')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->string('experiment_name', 100);
            $table->boolean('is_public')->default('0');
            $table->boolean('is_active')->default('0');
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

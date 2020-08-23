<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsInPersonalDataFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields_in_personal_data_forms', function (Blueprint $table) {
            
            $table->unsignedBigInteger('field_id');
            $table->unsignedBigInteger('form_id');

            $table->primary(['field_id', 'form_id']);
            
            $table->foreign('field_id')
                  ->references('id')->on('personal_data_forms_fields')
                  ->onDelete('cascade');

            $table->foreign('form_id')
                  ->references('id')->on('personal_data_forms')
                  ->onDelete('cascade');

            $table->boolean('is_required')->default('0');

            $table->integer('order');

            $table->boolean('start_new_page')->default('0');

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
        Schema::dropIfExists('fields_in_personal_data_forms');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalAssistantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_assistants', function (Blueprint $table) {
            $table->id();

            $table->string("medical_assistant_id")->unique();
            $table->string("name");
            $table->string("email")->unique();
            $table->string("phone")->unique();
            $table->string("image")->nullable();
            $table->string("password");

            $table->string("present_address");
            $table->string("permanent_address");
            $table->string("nid")->unique();
            $table->string("bmdc_reg_no")->unique();

            $table->boolean("is_active")->default(false);

            $table->string("month");
            $table->string("year");
            
            $table->rememberToken();
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
        Schema::dropIfExists('medical_assistants');
    }
}

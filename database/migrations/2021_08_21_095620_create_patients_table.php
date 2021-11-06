<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->string("patient_id")->unique();
            $table->string("name");
            $table->string("email")->unique();
            $table->string("phone")->unique();
            $table->date("date_of_birth");
            $table->enum("blood_group",['A-','A+','B-','B+','AB-','AB+','O-','O+']);
            $table->enum("gender",["Male","Female","Others"]);
            $table->string("address");
            $table->string("city");
            $table->string("district");
            $table->string("password");
            $table->string("image")->nullable();

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
        Schema::dropIfExists('patients');
    }
}

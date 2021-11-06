<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_days', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("doctor_id");
            $table->unsignedBigInteger("day_id");
            
            $table->foreign("doctor_id")->references("id")->on("doctors")->onDelete("cascade");
            $table->foreign("day_id")->references("id")->on("days")->onDelete("cascade");

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
        Schema::dropIfExists('doctor_days');
    }
}

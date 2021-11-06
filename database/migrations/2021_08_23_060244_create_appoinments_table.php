<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppoinmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appoinments', function (Blueprint $table) {
            $table->id();

            $table->string("appoinment_no")->unique();
            $table->date("appoinment_date")->nullable();
            $table->integer("total")->nullable();
            $table->enum("status",["Pending","Confirm","Complete","Cancel"])->default("Pending");
            $table->enum("payment_status",["Paid","Unpaid"])->default("Unpaid");

            $table->foreignId("patient_id")->constrained("patients");
            $table->unsignedBigInteger("doctor_id")->nullable();

            $table->string("month");
            $table->string("year");

            $table->foreign("doctor_id")->on("doctors")->references("id")->onDelete("cascade");

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
        Schema::dropIfExists('appoinments');
    }
}

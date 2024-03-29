<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionChiefComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_chief_complaints', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("prescription_id");
            $table->unsignedBigInteger("chief_complaint_id");

            $table->foreign("prescription_id")->references("id")->on("prescriptions")->onDelete("cascade");
            $table->foreign("chief_complaint_id")->references("id")->on("chief_complaints")->onDelete("cascade");

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
        Schema::dropIfExists('prescription_chief_complaints');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_reports', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("prescription_id");
            $table->string("image");
            $table->string("name");

            $table->foreign("prescription_id")->references("id")->on("prescriptions")->onDelete("cascade");

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
        Schema::dropIfExists('prescription_reports');
    }
}

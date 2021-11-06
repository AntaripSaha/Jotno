<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_medicines', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("prescription_id");
            $table->unsignedBigInteger("medicine_id");
            $table->enum("type",["Mark","OR","Drop"]);
            $table->text("timing")->nullable();
            $table->text("note")->nullable();

            $table->foreign("prescription_id")->references("id")->on("prescriptions")->onDelete("cascade");
            $table->foreign("medicine_id")->references("id")->on("medicines")->onDelete("cascade");

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
        Schema::dropIfExists('prescription_medicines');
    }
}

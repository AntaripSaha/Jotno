<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();

            $table->string("prescription_no")->unique();
            $table->unsignedBigInteger("appoinment_id");
            $table->unsignedBigInteger("created_by");
            $table->enum("type",["MA","Doctor"]);
            $table->text("advice");

            $table->foreign("appoinment_id")->references("id")->on("appoinments")->onDelete("cascade");

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
        Schema::dropIfExists('prescriptions');
    }
}

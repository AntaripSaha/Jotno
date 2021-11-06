<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppoinmentInitialTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appoinment_initial_tests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("appoinment_id");
            $table->unsignedBigInteger("initial_test_id");
            $table->string("value");

            $table->foreign("appoinment_id")->references("id")->on("appoinments")->onDelete("cascade");
            $table->foreign("initial_test_id")->references("id")->on("initial_tests")->onDelete("cascade");

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
        Schema::dropIfExists('appoinment_initial_tests');
    }
}

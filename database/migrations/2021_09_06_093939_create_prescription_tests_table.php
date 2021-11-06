<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_tests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("prescription_id");
            $table->unsignedBigInteger("test_type_id");
            $table->text("test_type_list");

            $table->foreign("prescription_id")->references("id")->on("prescriptions")->onDelete("cascade");
            $table->foreign("test_type_id")->references("id")->on("test_types")->onDelete("cascade");

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
        Schema::dropIfExists('prescription_tests');
    }
}

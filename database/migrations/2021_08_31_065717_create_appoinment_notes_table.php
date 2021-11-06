<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppoinmentNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appoinment_notes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("appoinment_id");
            $table->text("note");
            $table->foreign("appoinment_id")->references("id")->on("appoinments")->onDelete("cascade");
            $table->unsignedBigInteger("created_by");
            $table->enum("type",["MA","DOCTOR"]);

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
        Schema::dropIfExists('appoinment_notes');
    }
}

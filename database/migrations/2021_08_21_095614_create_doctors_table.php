<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();

            $table->string("doctor_id")->unique();
            $table->string("name");
            $table->text("designation");
            $table->text("chamber");
            $table->string("location");
            $table->string("email")->unique();
            $table->string("phone")->unique();
            $table->string("image")->nullable();
            $table->string("password");
            $table->enum("gender",["Male","Female"]);

            $table->string("degree");
            $table->string("speciality")->nullable();
            $table->string("nid")->unique()->nullable();

            $table->string("in");
            $table->string("out");
            $table->boolean("is_available")->default(false);

            $table->boolean("is_active")->default(false);

            $table->string("month");
            $table->string("year");

            $table->unsignedBigInteger("charge_id");

            $table->foreign("charge_id")->references("id")->on("charges")->onDelete("cascade");
            
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
        Schema::dropIfExists('doctors');
    }
}

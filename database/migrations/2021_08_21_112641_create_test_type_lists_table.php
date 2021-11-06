<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTypeListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_type_lists', function (Blueprint $table) {
            $table->id();

            $table->foreignId("test_type_id")->constrained("test_types");
            $table->string("name")->unique();
            $table->string("slug")->unique();
            $table->integer("price");
            $table->boolean("is_active");

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
        Schema::dropIfExists('test_type_lists');
    }
}

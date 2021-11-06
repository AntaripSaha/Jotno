<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_infos', function (Blueprint $table) {
            $table->id();

            $table->string("logo");
            $table->string("footer_logo");
            $table->string("fav");
            $table->string("address");
            $table->string("email");
            $table->string("phone");
            $table->string("footer_text");
            $table->string("facebook_url");
            $table->string("twitter_url");
            $table->string("linkedin_url");
            
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
        Schema::dropIfExists('app_infos');
    }
}

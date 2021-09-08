<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();

            $table->string("name")->charset('utf8mb4 COLLATE utf8mb4_bin')->unique();
            $table->string("code")->charset('utf8mb4 COLLATE utf8mb4_bin')->unique();//String eg. Writers Admin Employers represented with code we prefix so that payments with eg. we-197 csn be idntified. Please
            $table->string("endpoint");
            $table->string("login_endpoint");
            $table->string("username");
            $table->string("password");
            $table->string("validation_url")->nullable();
            $table->text("description")->nullable();
            $table->text("logo")->nullable();//Url

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
        Schema::dropIfExists('apps');
    }
}

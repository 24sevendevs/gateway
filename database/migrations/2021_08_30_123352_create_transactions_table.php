<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->integer("app_id")->nullable();
            $table->string("TransactionType")->nullable();
            $table->string("TransID");
            $table->string("TransTime")->nullable();
            $table->string("BusinessShortCode")->nullable();
            $table->string("BillRefNumber")->unique();
            $table->string("FirstName")->nullable();
            $table->string("MiddleName")->nullable();
            $table->string("LastName")->nullable();
            $table->float("OrgAccountBalance")->nullable();
            $table->string("ThirdPartyTransID")->nullable();
            $table->string("MSISDN");//phone
            $table->float("TransAmount");//amount

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
        Schema::dropIfExists('transactions');
    }
}

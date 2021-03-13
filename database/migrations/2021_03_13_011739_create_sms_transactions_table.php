<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSMSTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_m_s_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->index();
            $table->dateTime('created_at');
            $table->string('from', 100);
            $table->string('too', 100);
            $table->string('message');
            $table->string('source');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_m_s_transactions');
    }
}

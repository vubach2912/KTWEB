<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketTradeHistoryTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_trade_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trade_id');
            $table->integer('status');
            $table->string('username');
            $table->string('password');
            $table->float('amount');
            $table->string('amount_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('market_trade_history');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketTradeTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_trade', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id');
            $table->integer('storage_char_id');
            $table->string('difficulty');
            $table->string('item_type');
            $table->string('name');
            $table->text('note');
            $table->string('quality');
            $table->text('image');
            $table->bigInteger('amount');
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
        Schema::drop('market_trade');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftRuleCustomerGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_rule_customer_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_group_id')->unsigned();
            $table->foreign('customer_group_id')->references('id')->on('customer_groups')->onDelete('cascade');
            $table->integer('gift_rule_id')->unsigned();
            $table->foreign('gift_rule_id')->references('id')->on('gift_rules')->onDelete('cascade');
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
        Schema::dropIfExists('gift_rule_customer_groups');
    }
}

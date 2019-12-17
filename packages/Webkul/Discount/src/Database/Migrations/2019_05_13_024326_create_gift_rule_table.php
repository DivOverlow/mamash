<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('discount_customer_group');
        Schema::dropIfExists('discount_channels');
        Schema::dropIfExists('discount_rules');
        Schema::dropIfExists('discounts');
        Schema::dropIfExists('products_grid');

        Schema::create('gift_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->boolean('status')->default(0);
            $table->decimal('action_amount', 12, 4)->default(0);
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
        Schema::dropIfExists('gift_rules');
    }
}

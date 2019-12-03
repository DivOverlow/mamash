<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('template_key')->nullable();
            $table->longtext('html_content');
            $table->string('template_title');
            $table->json('content')->nullable();
            $table->integer('channel_id')->unsigned();
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->integer('locale_id')->unsigned();
            $table->foreign('locale_id')->references('id')->on('locales')->onDelete('cascade');
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
        Schema::dropIfExists('cms_templates');
    }
}

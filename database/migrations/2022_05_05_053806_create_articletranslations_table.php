<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articletranslations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->string('locale')->index();

            $table->string('title');
            $table->string('content');

            $table->unique(['article_id','locale']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articletranslations');
    }
};

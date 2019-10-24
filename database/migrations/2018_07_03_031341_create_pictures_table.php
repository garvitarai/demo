<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pictures', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('productId');
          $table->string('type')->nullable();
          $table->string('comments', 255)->nullable();
          $table->dateTime('created_at');
          $table->dateTime('updated_at');
          $table->binary('picture');
          $table->foreign('productId')->references('id')->on('compProducts')->onDelete('cascade');
          $table->unique(['id', 'productId']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}

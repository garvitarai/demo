<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('reports', function (Blueprint $table) {
          $table->integer('reportId')->autoIncrement();
          $table->string('employeeId', 100)->default('sam@tjx.ca');
          $table->string('title', 255)->default('Monthly Comp Shop Report');
          $table->dateTime('created_at');
          $table->dateTime('updated_at');
          $table->foreign('employeeId')->references('email')->on('users');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}

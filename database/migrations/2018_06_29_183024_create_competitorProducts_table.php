<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitorProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('compProducts', function (Blueprint $table) {
             $table->integer('id')->autoIncrement();
             $table->string('employeeId', 100)->default('sam@tjx.ca');
             $table->string('store');
             $table->dateTime('created_at');
             $table->dateTime('updated_at');
             $table->string('description')->nullable();
             $table->decimal('regularPrice', 8, 2)->nullable();
             $table->decimal('salePrice', 8, 2)->nullable();
             $table->decimal('internalPrice', 8, 2)->nullable();
             $table->string('vendorCode')->nullable();
             $table->string('styleCode')->nullable();
             $table->string('brand')->nullable();
             $table->string('colour')->nullable();
             $table->string('itemType')->nullable();
             $table->string('size')->nullable();
             $table->string('status')->default('Not Submitted');
             $table->string('submittedBy')->nullable();
             $table->string('approvedBy')->nullable();
             $table->string('department', 100);
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
         Schema::dropIfExists('compProducts');
     }
 }

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200);
            $table->string('address' , 300);
            $table->string('address_2', 300)->nullable();
            $table->string('city', 100);
            $table->string('postal_code', 100)->nullable();
            $table->string('main_phone', 100)->nullable();
            $table->string('main_fax', 100)->nullable();
            $table->string('e_phone', 100)->nullable();
            $table->string('office_hours', 300)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('main_email', 100)->nullable();
            $table->string('management')->nullable();
            $table->string('building_type')->nullable();
            $table->string('property_type')->nullable();
            $table->string('category')->nullable();
            $table->tinyInteger('status')->unsigned()->default(1);
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
        Schema::dropIfExists('properties');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 200);
            $table->string('address' , 300);          
            $table->string('city', 100);
            $table->string('postal_code', 100)->nullable();
            $table->string('building', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('fax', 100)->nullable();
            $table->string('third_party', 200)->nullable();
            $table->string('third_party_phone', 100)->nullable();
            $table->string('third_party_fax', 100)->nullable();
            $table->string('third_party_email', 100)->nullable();
            $table->string('unit_type')->nullable();
            $table->smallInteger('floor')->unsigned();
            $table->smallInteger('bedroom')->unsigned();
            $table->tinyInteger('bedroom_study')->unsigned()->default(0);
            $table->smallInteger('bathroom')->unsigned();
            $table->tinyInteger('bathroom_half')->unsigned()->default(0);
            $table->double('sqft', 15, 2);
            $table->string('lockbox_code')->nullable();
            $table->string('lockbox_notes')->nullable();
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
        Schema::dropIfExists('units');
    }
}

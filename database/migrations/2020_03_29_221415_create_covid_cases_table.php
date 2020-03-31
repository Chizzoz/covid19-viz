<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_cases', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->id();
            $table->integer('batch');
            $table->string('fips')->nullable();
            $table->string('admin')->nullable();
            $table->string('province_state')->nullable();
            $table->string('country_region');
            $table->string('lastupdate');
            $table->string('latitude', 19, 16)->nullable();
            $table->string('longitude', 19, 16)->nullable();
            $table->integer('confirmed');
            $table->integer('deaths');
            $table->integer('recovered');
            $table->integer('active');
            $table->string('combined_key');
            $table->string('unique_source');
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
        Schema::dropIfExists('covid_cases');
    }
}

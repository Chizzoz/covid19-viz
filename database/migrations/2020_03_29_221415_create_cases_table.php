<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->id();
            $table->integer('batch');
            $table->integer('fips')->nullable();
            $table->string('admin')->nullable();
            $table->string('province_state')->nullable();
            $table->string('country_region');
            $table->dateTime('lastupdate');
            $table->decimal('latitude', 3, 16);
            $table->decimal('longitude', 3, 16);
            $table->integer('confirmed');
            $table->integer('deaths');
            $table->integer('recovered');
            $table->integer('active');
            $table->string('combined_key');
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
        Schema::dropIfExists('cases');
    }
}

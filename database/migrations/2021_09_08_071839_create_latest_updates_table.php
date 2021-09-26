<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatestUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //creating table
        Schema::create('latest_updates', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('cases_new');
            $table->integer('cases_recovered');
            $table->integer('death_new');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //dropping the table 
        Schema::dropIfExists('latest_updates');
    }
}

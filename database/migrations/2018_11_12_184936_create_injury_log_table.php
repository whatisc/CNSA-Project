<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInjuryLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('injury_logs');
        Schema::enableForeignKeyConstraints();
        Schema::create('injury_logs', function (Blueprint $table) {
            $table->increments('injuryId');
            $table->date('injuryDate');
            // fk
            $table->integer('playerId');
            $table->string('injury', 50);
            $table->timestamps();

        });

        Schema::table('injury_logs', function($table) {
            //Setting up the relationships
            $table->foreign('playerId')->references('playerId')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('injury_logs');
    }
}

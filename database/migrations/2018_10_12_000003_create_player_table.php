<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreatePlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('players');
        Schema::enableForeignKeyConstraints();
        Schema::create('players', function (Blueprint $table) {
            $table->increments('playerId');
            //fk
            $table->integer('personId')->unsigned();
            $table->integer('yearEntered');
            $table->string('position', 25);
            $table->string('highSchool')->nullable();
            //fk
            $table->integer('playerStatsId')->unsigned();
            $table->integer('playerRating')->default(0);
            // fk
            $table->integer('teamId')->unsigned();            
            $table->timestamps();
        });

        Schema::table('players', function($table) {
            //Setting up the relationships
            $table->foreign('personId')->references('personId')->on('persons')->onDelete('cascade');
            $table->foreign('teamId')->references('teamId')->on('teams')->onDelete('cascade');
            $table->foreign('playerStatsId')->references('playerStatsId')->on('playerStats')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}

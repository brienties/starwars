<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->integer('species_id')->unique();
            $table->string('name')->nullable();
            $table->string('classification')->nullable();
            $table->string('designation')->nullable();
            $table->string('average_height')->nullable();
            $table->string('average_lifespan')->nullable();
            $table->string('eye_colors')->nullable();
            $table->string('hair_colors')->nullable();
            $table->string('skin_color')->nullable();
            $table->string('language')->nullable();
            $table->integer('homeworld')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('species');
    }
}

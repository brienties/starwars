<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->integer('people_id')->unique();
            $table->string('name')->nullable();
            $table->string('birth_year')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('gender')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('height')->nullable();
            $table->string('mass')->nullable();
            $table->string('skin_color')->nullable();
            $table->integer('homeworld')->nullable();
            $table->integer('species')->nullable();
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
        Schema::dropIfExists('people');
    }
}

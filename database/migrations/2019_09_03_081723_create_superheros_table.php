<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperherosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('superheros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nickname', 30);
            $table->string('real_name', 50)->nullable();
            $table->text('origin_description')->nullable();
            $table->string('superpowers', 255)->nullable();
            $table->string('catch_phrase', 255)->nullable();
            $table->string('images')->nullable();
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
        Schema::dropIfExists('superheros');
    }
}

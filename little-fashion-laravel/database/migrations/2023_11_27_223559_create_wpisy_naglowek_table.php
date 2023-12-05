<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpisyNaglowekTable extends Migration
{
    public function up()
    {
        Schema::create('wpisy_naglowkow', function (Blueprint $table) {
            $table->id();
            $table->string('tresc_naglowka')->nullable();
            $table->string('sciezka_artykulu')->nullable();
            $table->integer('numer_naglowka')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wpisy');
    }
}
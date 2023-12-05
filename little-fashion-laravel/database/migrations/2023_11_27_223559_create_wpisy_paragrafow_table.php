<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpisyParagrafowTable extends Migration
{
    public function up()
    {
        Schema::create('wpisy_paragrafow', function (Blueprint $table) {
            $table->id();
            $table->text('tresc_paragrafu');
            $table->string('sciezka_artykulu')->nullable();
            $table->integer('numer_paragrafu')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wpisy');
    }
}
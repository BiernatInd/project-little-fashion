<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaWpisowTable extends Migration
{
    public function up()
    {
        Schema::create('lista_wpisow', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title');
            $table->text('meta_description');
            $table->string('sciezka_artykulu');
            $table->string('nazwa_artykulu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lista_wpisow');
    }
}
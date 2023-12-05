<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpisyZdjeciaTable extends Migration
{
    public function up()
    {
        Schema::create('wpisy_zdjecia', function (Blueprint $table) {
            $table->id();
            $table->string('zdjecie_artykulu')->nullable();
            $table->string('sciezka_artykulu')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wpisy');
    }
}
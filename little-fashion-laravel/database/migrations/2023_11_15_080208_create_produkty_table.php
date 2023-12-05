<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduktyTable extends Migration
{
    public function up()
    {
        Schema::create('produkty', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa');
            $table->string('kategoria');
            $table->decimal('cena', 8, 2);
            $table->decimal('cena_promocyjna', 8, 2)->nullable();
            $table->integer('stan_magazynowy')->unsigned();
            $table->string('zdjecie_produktu_1')->nullable();
            $table->string('zdjecie_produktu_2')->nullable();
            $table->string('zdjecie_produktu_3')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produkty');
    }
}
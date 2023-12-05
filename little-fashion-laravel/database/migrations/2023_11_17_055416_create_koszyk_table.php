<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoszykTable extends Migration
{
    public function up()
    {
        Schema::create('koszyk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produkt_id')->constrained('produkty');
            // Add other columns if needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('koszyk');
    }
}
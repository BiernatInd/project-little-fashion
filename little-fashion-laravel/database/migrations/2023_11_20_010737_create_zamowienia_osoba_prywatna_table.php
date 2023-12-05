<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZamowieniaOsobaPrywatnaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zamowienia_osoba_prywatna', function (Blueprint $table) {
            $table->id();
            $table->string('imie');
            $table->string('nazwisko');
            $table->string('email');
            $table->string('telefon', 15);
            $table->string('kraj');
            $table->string('ulica_i_numer_domu');
            $table->string('miejscowosc');
            $table->string('kod_pocztowy');
            $table->string('faktura_imie')->nullable();
            $table->string('faktura_nazwisko')->nullable();
            $table->string('faktura_ulica_i_numer_domu')->nullable();
            $table->string('faktura_miejscowosc')->nullable();
            $table->string('faktura_kod_pocztowy')->nullable();
            $table->decimal('laczna_kwota', 10, 2)->nullable();
            $table->string('platnosc')->nullable();
            $table->decimal('podatek_vat', 5, 2)->nullable();
            $table->string('dostawa')->nullable();
            $table->string('status_zamowienia')->default('nieoplacono');
            $table->string('numer_zamowienia')->nullable();
            $table->string('wprowadzony_kod_promocyjny')->nullable();
            $table->decimal('znizka', 5, 2)->nullable();
            $table->text('zakupione_produkty')->nullable();
            $table->string('nazwa_uzytkownika')->nullable();
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
        Schema::dropIfExists('zamowienia_osoba_prywatna');
    }
}

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


//Authentication
Route::post('/register', 'App\Http\Controllers\Authentication\RegisterController@register');
Route::post('/login', 'App\Http\Controllers\Authentication\LoginController@login');
Route::post('/recover-password', 'App\Http\Controllers\Authentication\RecoverPasswordController@recoverPassword');
Route::post('/reset-password/{token}', 'App\Http\Controllers\Authentication\ResetPasswordController@resetPassword');

Route::get('/produkty', 'App\Http\Controllers\Sklep\Produkty\ProduktyController@pobierzProdukty');
Route::get('/produkty/{id}', 'App\Http\Controllers\Sklep\Produkty\ProduktyController@pobierzProdukt');





Route::group(['middleware' => ['api']], function () {
    Route::post('/add-to-cart', 'App\Http\Controllers\Sklep\Koszyk\ShoppingCartController@addToCart');
});

Route::post('zamowienia-osoba-prywatna', 'App\Http\Controllers\Sklep\Zamowienia\ZamowieniaOsobaPrywatnaController@zapiszDane');
Route::post('zamowienia-firma', 'App\Http\Controllers\Sklep\Zamowienia\ZamowieniaFirmaController@zapiszDane');

Route::get('lista-kategorii', 'App\Http\Controllers\Sklep\Kategorie\ListaKategoriiController@pobierzKategorie');

Route::post('aktualizacja-stanu', 'App\Http\Controllers\Sklep\AktualizacjaStanu\AktualizacjaStanuController@zaktualizujStan');

//Zamowienia - Panel Administratora
Route::get('lista-zamowien', 'App\Http\Controllers\PanelAdministratora\Zamowienia\ListaZamowienController@pobierzListeZamowien');
Route::get('/szczegoly-zamowienia/{numerZamowienia}', 'App\Http\Controllers\PanelAdministratora\Zamowienia\ListaZamowienController@pobierzSzczegolyZamowienia');
Route::put('/aktualizuj-status-zamowienia/{numerZamowienia}', 'App\Http\Controllers\PanelAdministratora\Zamowienia\ListaZamowienController@aktualizujStatusZamowienia');
Route::delete('/usun-zamowienie/{numerZamowienia}', 'App\Http\Controllers\PanelAdministratora\Zamowienia\ListaZamowienController@usunZamowienie');

//Lista produktów

Route::get('/lista-produktow', 'App\Http\Controllers\PanelAdministratora\Produkty\ListaProduktowController@pobierzProdukty');
Route::get('/lista-produktow/{id}', 'App\Http\Controllers\PanelAdministratora\Produkty\ListaProduktowController@pobierzProdukt');
Route::put('edytuj-nazwe-produktu/{id}', 'App\Http\Controllers\PanelAdministratora\Produkty\EdytowanieProduktowController@edytujNazweProduktu');
Route::put('edytuj-kategorie-produktu/{id}', 'App\Http\Controllers\PanelAdministratora\Produkty\EdytowanieProduktowController@edytujKategorieProduktu');
Route::put('edytuj-cene-produktu/{id}', 'App\Http\Controllers\PanelAdministratora\Produkty\EdytowanieProduktowController@edytujCeneProduktu');
Route::put('edytuj-cene-promocyjna-produktu/{id}', 'App\Http\Controllers\PanelAdministratora\Produkty\EdytowanieProduktowController@edytujCenePromocyjnaProduktu');
Route::put('edytuj-stan-magazynowy-produktu/{id}', 'App\Http\Controllers\PanelAdministratora\Produkty\EdytowanieProduktowController@edytujStanMagazynowyProduktu');
Route::post('/edytuj-pierwsze-zdjecie/{id}', 'App\Http\Controllers\PanelAdministratora\Produkty\EdytowanieProduktowController@edytujPierwszeZdjecie');
Route::post('/edytuj-drugie-zdjecie/{id}', 'App\Http\Controllers\PanelAdministratora\Produkty\EdytowanieProduktowController@edytujDrugieZdjecie');
Route::post('/edytuj-trzecie-zdjecie/{id}', 'App\Http\Controllers\PanelAdministratora\Produkty\EdytowanieProduktowController@edytujTrzecieZdjecie');
Route::post('/dodaj-produkt', 'App\Http\Controllers\PanelAdministratora\Produkty\DodawanieProduktowController@dodajProdukt');
Route::delete('/usun-produkt/{id}','App\Http\Controllers\PanelAdministratora\Produkty\ListaProduktowController@usunProdukt');

//lista kategorii
Route::get('/lista-kategorii', 'App\Http\Controllers\PanelAdministratora\Kategorie\ListaKategoriiController@pobierzListeKategorii');
Route::get('/kategorie/{id}', 'App\Http\Controllers\PanelAdministratora\Kategorie\ListaKategoriiController@pobierzKategorie');
Route::put('edytuj-nazwe-kategorii/{id}', 'App\Http\Controllers\PanelAdministratora\Kategorie\EdytowanieKategoriiController@edytujNazweKategorii');
Route::put('edytuj-sciezke-kategorii/{id}', 'App\Http\Controllers\PanelAdministratora\Kategorie\EdytowanieKategoriiController@edytujSciezkeKategorii');
Route::post('/dodaj-kategorie', 'App\Http\Controllers\PanelAdministratora\Kategorie\DodawanieKategoriiController@dodajKategorie');
Route::delete('/usun-kategorie/{id}','App\Http\Controllers\PanelAdministratora\Kategorie\ListaKategoriiController@usunKategorie');

//Blog
Route::post('/dodaj-wpis', 'App\Http\Controllers\PanelAdministratora\Blog\DodawanieWpisowController@dodajWpis');
Route::post('/dodaj-zdjecie/{sciezkaArtykulu}', 'App\Http\Controllers\PanelAdministratora\Blog\DodawanieZdjeciaDoWpisu@dodajZdjecie');
Route::post('/dodaj-naglowek/{sciezkaArtykulu}', 'App\Http\Controllers\PanelAdministratora\Blog\DodawanieTresciDoWpisowController@dodajNaglowek');
Route::post('/dodaj-paragraf/{sciezkaArtykulu}', 'App\Http\Controllers\PanelAdministratora\Blog\DodawanieTresciDoWpisowController@dodajParagraf');
Route::get('/pobierz-dane/{sciezkaArtykulu}', 'App\Http\Controllers\PanelAdministratora\Blog\DodawanieTresciDoWpisowController@pobierzDane');
Route::get('/lista-wpisow', 'App\Http\Controllers\PanelAdministratora\Blog\ListaWpisowController@pobierzListeWpisow');
Route::get('/pobierz-wpis/{sciezkaArtykulu}', 'App\Http\Controllers\PanelAdministratora\Blog\ListaWpisowController@pobierzWpisPoSciezce');
Route::get('/pobierz-zdjecie/{sciezkaArtykulu}', 'App\Http\Controllers\PanelAdministratora\Blog\DodawanieTresciDoWpisowController@pobierzZdjecia');
Route::get('/pobierz-wszystkie-zdjecia', 'App\Http\Controllers\PanelAdministratora\Blog\DodawanieTresciDoWpisowController@pobierzWszystkieZdjecia');
Route::put('/edytuj-naglowek', 'App\Http\Controllers\PanelAdministratora\Blog\EdytowanieWpisowController@edytujNaglowek');
Route::put('/edytuj-paragraf', 'App\Http\Controllers\PanelAdministratora\Blog\EdytowanieWpisowController@edytujParagraf');


Route::delete('/usun-wpis/{sciezkaArtykulu}', 'App\Http\Controllers\PanelAdministratora\Blog\ListaWpisowController@usunWpis');

//Kolekcje
Route::post('/dodaj-kolekcje', 'App\Http\Controllers\PanelAdministratora\Kolekcje\GaleriaKolekcjeController@dodajKolekcje');
Route::post('/dodaj-zdjecia-kolekcji/{sciezkaKolekcji}', 'App\Http\Controllers\PanelAdministratora\Kolekcje\GaleriaKolekcjeController@dodajZdjeciaKolekcji');
Route::get('/pobierz-dane-kolekcji', 'App\Http\Controllers\PanelAdministratora\Kolekcje\GaleriaKolekcjeController@pobierzDaneKolekcji');
Route::get('/pobierz-dane-tresci-kolekcji/{sciezkaKolekcji}', 'App\Http\Controllers\PanelAdministratora\Kolekcje\GaleriaKolekcjeController@pobierzDaneTresciKolekcji');
Route::delete('/usun-kolekcje/{id}', 'App\Http\Controllers\PanelAdministratora\Kolekcje\GaleriaKolekcjeController@usunKolekcje');
Route::delete('/usun-tresci-kolekcji/{id}', 'App\Http\Controllers\PanelAdministratora\Kolekcje\GaleriaKolekcjeController@usunTresciKolekcji');

//Rabaty
Route::post('/obsluga-rabatu', 'App\Http\Controllers\PanelAdministratora\Rabaty\ObslugaRabatowController@obslugaKoduRabatowego');
Route::get('/pobierz-kody-rabatowe', 'App\Http\Controllers\PanelAdministratora\Rabaty\ListaRabatowController@pobierzRabaty');
Route::delete('/usun-rabat/{id}', 'App\Http\Controllers\PanelAdministratora\Rabaty\ListaRabatowController@usunRabat');
Route::post('/dodaj-kod-rabatowy', 'App\Http\Controllers\PanelAdministratora\Rabaty\DodawanieKodowRabatowych@dodajKodRabatowy');

//Uzytkownicy Panel Administratora
Route::get('/pobierz-uzytkownikow', 'App\Http\Controllers\PanelAdministratora\Uzytkownicy\ListaUzytkownikowController@pobierzUzytkownikow');
Route::delete('/usun-uzytkownika/{id}', 'App\Http\Controllers\PanelAdministratora\Uzytkownicy\ListaUzytkownikowController@usunUzytkownika');

//Ustawienia
Route::get('/pobierz-administratora', 'App\Http\Controllers\PanelAdministratora\Ustawienia\UstawieniaController@pobierzAdministratora');
Route::put('/zmien-email-administratora/{id}', 'App\Http\Controllers\PanelAdministratora\Ustawienia\UstawieniaController@zmienEmailAdministratora');

//Panel uzytkownika
Route::get('/pobierz-liste-zamowien-uzytkownika', 'App\Http\Controllers\Uzytkownik\Zamowienia\ListaZamowienUzytkownik@pobierzListeZamowien');
Route::get('/pobierz-uzytkownika', 'App\Http\Controllers\Uzytkownik\Ustawienia\UstawieniaController@pobierzUzytkownika');
Route::put('/zmien-email-uzytkownika/{id}', 'App\Http\Controllers\Uzytkownik\Ustawienia\UstawieniaController@zmienEmailUzytkownika');
Route::delete('usun-konto-uzytkownika/{id}', 'App\Http\Controllers\Uzytkownik\Ustawienia\UstawieniaController@usunUzytkownika');

//Status

Route::get('/status-zamowienia/{numerZamowienia}', 'App\Http\Controllers\Uzytkownik\Status\StatusController@pobierzStatusZamowienia');

//Odstapienie
Route::post('/wyslij-odstapienie', 'App\Http\Controllers\PanelAdministratora\Odstapienie\OdstapienieController@wyslijOdstapienie');
Route::get('/pobierz-odstapienia', 'App\Http\Controllers\PanelAdministratora\Odstapienie\OdstapienieController@pobierzOdstapienia');
Route::get('/pobierz-odstapienie/{id}', 'App\Http\Controllers\PanelAdministratora\Odstapienie\OdstapienieController@pobierzOdstapienie');
Route::post('/newsletter', 'App\Http\Controllers\PanelAdministratora\Newsletter\NewsletterController@newsletter');
Route::get('/pobierz-newslettery', 'App\Http\Controllers\PanelAdministratora\Newsletter\NewsletterController@pobierzNewslettery');

//Kontakt
Route::post('/wyslij-formularz', 'App\Http\Controllers\Sklep\Kontakt\KontaktController@wyslijFormularz');

//Meta tagi
Route::get('/pobierz-meta/{sciezka_artykulu}', 'App\Http\Controllers\PanelAdministratora\Blog\MetaTagiController@pobierzMetaDane');
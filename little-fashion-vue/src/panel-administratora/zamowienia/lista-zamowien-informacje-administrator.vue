<template>
    <AdminHeader />
    <div class="home">
        <div v-if="orderTyp === 'firma'" class="home-content" id="firma">
            <div class="home-left">
                <div class="home-left-box">
                    <div class="home-box-content">
                        <div class="home-box-top">
                            <h2>Dane do faktury</h2>
                            <p>Firma</p>
                        </div>
                        <hr>
                        <p>NIP: {{ order.nip || 'Brak danych' }}</p>
                        <p>Nazwa firmy: {{ order.nazwa_firmy || 'Brak danych'}}</p>
                        <p>Ulica i numer domu / mieszkania: {{ order.ulica_i_numer_domu || 'Brak danych'}}</p>
                        <p>Miejscowość: {{ order.miejscowosc || 'Brak danych'}}</p>
                        <p>Kod pocztowy: {{ order.kod_pocztowy || 'Brak danych'}}</p>
                        <h2>Adres dostawy:</h2>
                        <hr>
                        <p>Imię: {{ order.faktura_imie || 'Brak danych'}}</p>
                        <p>Nazwisko: {{ order.faktura_nazwisko || 'Brak danych'}}</p>
                        <p>Adres E-mail: {{ order.faktura_email || 'Brak danych'}}</p>
                        <p>Numer telefonu: {{ order.faktura_telefon || 'Brak danych'}}</p>
                        <p>Kraj: {{ order.faktura_kraj || 'Brak danych'}}</p>
                        <p>Ulica i numer domu / mieszkania: {{ order.faktura_ulica_i_numer_domu || 'Brak danych'}}</p>
                        <p>Miejscowość: {{ order.faktura_miejscowosc || 'Brak danych'}}</p>
                        <p>Kod pocztowy: {{ order.faktura_kod_pocztowy || 'Brak danych'}}</p>
                    </div>
                </div>
            </div>
            <div class="home-right">
                <div class="home-right-top">
                    <div class="home-right-box">
                        <div class="home-box-content">
                            <h2>Dane zamówienia</h2>
                            <hr>
                            <p>Łączna kwota: {{ order.laczna_kwota ? order.laczna_kwota + ' zł' : 'Brak danych' }}</p>
                            <p>Metoda płatności: {{  order.platnosc || 'Brak danych' }}</p>
                            <p>Podatek (23% VAT): {{  order.podatek_vat ? order.podatek_vat + ' zł' : 'Brak danych' }}</p>
                            <p>Metoda dostawy: {{ order.dostawa || 'Brak danych' }}</p>
                            <p>Status zamówienia: {{  order.status_zamowienia || 'Brak danych' }}</p>
                            <p>Numer zamówienia: {{ order.numer_zamowienia || 'Brak danych' }}</p>
                            <p>Kod promocyjny: {{  order.wprowadzony_kod_promocyjny || 'Brak danych'}}</p>
                            <p>Zniżka: {{  order.znizka || 'Brak danych' }}</p>
                            <p>Zakupiono: {{  order.zakupione_produkty || 'Brak danych' }}</p>
                        </div>
                    </div>
                </div>
                <div class="home-right-bottom">
                    <div class="home-right-box">
                        <div class="home-box-content">
                            <h2>Zmień status</h2>
                            <hr>
                            <select v-model="newOrderStatus">
                                <option value="Zrealizowano">Zrealizowano</option>
                                <option value="Opłacono">Opłacono</option>
                                <option value="Nie opłacono">Nie opłacono</option>
                            </select>
                            <div class="home-box-button">
                                <button class="home-box-btn"  @click="showConfirmation">Zmień status</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="orderTyp === 'osoba_prywatna'" class="home-content" id="osoba_prywatna">
            <div class="home-left">
                <div class="home-left-box">
                    <div class="home-box-content">
                        <div class="home-box-top">
                            <h2>Dane klienta</h2>
                            <p>Osoba prywatna</p>
                        </div>
                        <hr>
                        <p>Imię: {{  order.imie || 'Brak danych' }}</p>
                        <p>Nazwisko: {{ order.nazwisko || 'Brak danych'}}</p>
                        <p>Adres E-mail: {{  order.email || 'Brak danych'}}</p>
                        <p>Numer telefonu: {{  order.telefon || 'Brak danych' }}</p>
                        <p>Kraj: {{ order.kraj || 'Brak danych'}}</p>
                        <p>Ulica i numer domu / mieszkania: {{ order.ulica_i_numer_domu || 'Brak danych' }}</p>
                        <p>Miejscowość: {{  order.miejscowosc || 'Brak danych' }}</p>
                        <p>Kod pocztowy: {{  order.kod_pocztowy || 'Brak danych' }}</p>
                        <h2>Dodatkowe dane do faktury</h2>
                        <hr>
                        <p>Imię: {{ order.faktura_imie || 'Brak danych' }}</p>
                        <p>Nazwisko: {{ order.faktura_nazwisko || 'Brak danych' }}</p>
                        <p>Ulica i numer domu / mieszkania: {{ order.faktura_ulica_i_numer_domu || 'Brak danych' }}</p>
                        <p>Miejscowość: {{  order.faktura_miejscowosc || 'Brak danych' }}</p>
                        <p>Kod pocztowy: {{ order.faktura_kod_pocztowy || 'Brak danych' }}</p>
                    </div>
                </div>
            </div>
            <div class="home-right">
                <div class="home-right-top">
                    <div class="home-right-box">
                        <div class="home-box-content">
                            <h2>Dane zamówienia</h2>
                            <hr>
                            <p>Łączna kwota: {{ order.laczna_kwota ? order.laczna_kwota + ' zł' : 'Brak danych' }}</p>
                            <p>Metoda płatności: {{  order.platnosc || 'Brak danych' }}</p>
                            <p>Podatek (23% VAT): {{  order.podatek_vat ? order.podatek_vat + ' zł' : 'Brak danych' }}</p>
                            <p>Metoda dostawy: {{ order.dostawa || 'Brak danych' }}</p>
                            <p>Status zamówienia: {{  order.status_zamowienia || 'Brak danych' }}</p>
                            <p>Numer zamówienia: {{ order.numer_zamowienia || 'Brak danych' }}</p>
                            <p>Kod promocyjny: {{  order.wprowadzony_kod_promocyjny || 'Brak danych'}}</p>
                            <p>Zniżka: {{  order.znizka || 'Brak danych' }}</p>
                            <p>Zakupiono: {{  order.zakupione_produkty || 'Brak danych' }}</p>
                        </div>
                    </div>
                </div>
                <div class="home-right-bottom">
                    <div class="home-right-box">
                        <div class="home-box-content">
                            <h2>Zmień status</h2>
                            <hr>
                            <select v-model="newOrderStatus">
  <option value="Zrealizowano">Zrealizowano</option>
  <option value="Opłacono">Opłacono</option>
  <option value="Nie opłacono">Nie opłacono</option>
</select>
<div class="home-box-button">
  <button class="home-box-btn" @click="showConfirmation">Zmień status</button>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="confirmation" :class="{ 'active': confirmationActive }">
      <div class="confirmation-content">
        <div class="confirmation-main">
            <div class="confirmation-top">
                <h2>Potwierdzenie</h2>
                <hr>
            </div>
            <div class="confirmation-bottom">
                <p>Czy napewno chcesz zmienić status zamówienia?</p>
                <div class="confirmation-buttons">
                    <button class="confirmation-btn" @click="hideConfirmation" ref="collection">Anuluj</button>
                    <button class="confirmation-btn" @click="updateOrderStatus">Zmień</button>
                </div>
            </div>
        </div>
      </div>
    </div>
    <AdminLoginSidebar />
    <MainFooterBottom />
  </template>

<script>
import AdminHeader from '../../components/admin/admin-header.vue'
import MainFooterBottom from '../../components/main/main-footer-bottom.vue'
import axios from 'axios'

export default {
    components: {
        AdminHeader,
        MainFooterBottom
    },
    data() {
        return {
            confirmationActive: false,
            order: {},
            newOrderStatus: '',
            statusOptions: ['Zrealizowano', 'Opłacono', 'Nie opłacono'],
        }
    },
    computed: {
    orderTyp() {
      // Sprawdź, czy order jest firmą czy osobą prywatną
      return this.order && this.order.typ_zamowienia === 'firma' ? 'firma' : 'osoba_prywatna';
    },
    },
    methods: {
        showConfirmation() {
    console.log('showConfirmation');
    this.confirmationActive = !this.confirmationActive;
    document.body.classList.toggle('active', this.confirmationActive);
  },
  updateOrderStatus() {
    const numerZamowienia = this.$route.params.numer_zamowienia;
    axios.put(`http://localhost:8000/api/aktualizuj-status-zamowienia/${numerZamowienia}`, {
      nowy_status: this.newOrderStatus,
    })
      .then(response => {
        console.log('Status zamówienia zaktualizowany pomyślnie:', response.data.message);
        this.fetchOrderDetails(numerZamowienia);
        this.hideConfirmation();
      })
      .catch(error => {
        console.error('Błąd podczas aktualizacji statusu zamówienia:', error.response.data.error);
      });
  },
    hideConfirmation() {
        console.log('hideConfirmation');
        this.confirmationActive = false;
        document.body.classList.remove('active');
    },
    fetchOrderDetails(numerZamowienia) {
        axios.get(`http://localhost:8000/api/szczegoly-zamowienia/${numerZamowienia}`)
            .then(response => {
                this.order = response.data.order;
                console.log('Order details:', this.order);

                // Pobierz dostępne statusy i przypisz do statusOptions
                this.statusOptions = response.data.statusOptions;

                // Ustaw domyślny status na aktualny status zamówienia
                this.newOrderStatus = this.order.status_zamowienia || '';
            })
            .catch(error => {
                console.error('Error fetching order details:', error);
            });
    },
    checkUserRole() {
            const userRole = localStorage.getItem('userRole'); // Zakładam, że rola użytkownika jest przechowywana w local storage

            if (userRole !== 'admin') {
                // Jeżeli użytkownik nie ma roli admin, przekieruj go na stronę logowania
                this.$router.push('/logowanie');
            } else {
                // Jeżeli użytkownik ma rolę admin, pobierz numer zamówienia z trasy
                const numerZamowienia = this.$route.params.numer_zamowienia;

                // Pobierz szczegóły zamówienia
                this.fetchOrderDetails(numerZamowienia);
            }
        },
    },
    created() {
  // Pobierz numer zamówienia z trasy
  const numerZamowienia = this.$route.params.numer_zamowienia;
  this.fetchOrderDetails(numerZamowienia);
  this.checkUserRole();
},
    
}
</script>
  
<style lang="scss" scoped>
    .home {
        .home-content {
            padding-top: 7rem;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            .home-left {
                width: 48%;
                .home-left-box {
                    border: 1px solid var(--dark-beige);
                    border-radius: 10px;
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    .home-box-content {
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        .home-box-top {
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                            h2 {
                                font-size: 32px;
                            }
                            p {
                                font-size: 24px;
                            }
                        }
                        hr {
                            width: 150px;
                            height: 3px;
                            border: none;
                            border-radius: 10px;
                            background-color: var(--light-beige);
                            margin-bottom: 1rem;
                            margin-top: 1rem;
                        }
                        h2 {
                                font-size: 32px;
                            }
                        p {
                            font-size: 20px;
                        }
                        p:not(:last-child) {
                            margin-bottom: 1rem;
                        }
                    }
                }
            }
            .home-right {
                width: 48%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                .home-right-box {
                    border: 1px solid var(--dark-beige);
                    border-radius: 10px;
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    .home-box-content {
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        h2 {
                            font-size: 32px;
                            margin-bottom: 1rem;
                        }
                        hr {
                            width: 150px;
                            height: 3px;
                            border: none;
                            border-radius: 10px;
                            background-color: var(--light-beige);
                            margin-bottom: 1rem;
                        }
                        p {
                            font-size: 20px;
                        }
                        p:not(:last-child) {
                            margin-bottom: 1rem;
                        }
                        select {
                            border: none;
                            border-bottom: 1px solid var(--dark-beige);
                            height: 30px;
                            font-size: 16px;
                            width: 100%;
                            margin-bottom: 1rem;
                            cursor: pointer;
                            background-color: var(--transparent);
                        }
                        .home-box-button {
                            .home-box-btn {
                                width: 30%;
                                height: 30px;
                                border: 1px solid var(--dark-beige);
                                background-color: var(--transparent);
                                color: var(--dark-beige);
                                font-size: 16px;
                                cursor: pointer;
                                transition: 0.5s;
                                border-radius: 10px;
                                &:hover {
                                    background-color: var(--dark-beige);
                                    color: var(--white);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    
    .confirmation {
        position: fixed;
        max-width: 1920px;
        top: -100%;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.5s;
        z-index: 999;
        &.active {
            top: 0;
        }
        .confirmation-content {
            width: 40%;
            height: 25%;
            border-radius: 10px;
            background-color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            .confirmation-main {
                width: 90%;
                .confirmation-top {
                    margin-bottom: 1rem;
                    h2 {
                        font-size: 32px;
                        margin-bottom: 1rem;
                    }
                    hr {
                    width: 50%;
                    height: 3px;
                    border: none;
                    border-radius: 10px;
                    background-color: var(--light-beige);
                    }
                }
                .confirmation-bottom {
                    p {
                        font-size: 20px;
                        margin-bottom: 1rem;
                    }
                    .confirmation-buttons {
                        .confirmation-btn {
                            width: 220px;
                            height: 30px;
                            font-size: 16px;
                        }
                        .confirmation-btn:nth-child(1) {
                            margin-right: 1rem;
                            background-color: var(--white);
                            border: 1px solid var(--dark-beige);
                            color: var(--dark-beige);
                            border-radius: 5px;
                            cursor: pointer;
                            transition: 0.5s;
                            &:hover {
                                background-color: var(--dark-beige);
                                color: var(--white);
                            }
                        }
                        .confirmation-btn:nth-child(2) {
                            margin-right: 1rem;
                            background-color: var(--dark-beige);
                            border: 1px solid var(--dark-beige);
                            color: var(--white);
                            border-radius: 5px;
                            cursor: pointer;
                            transition: 0.5s;
                            &:hover {
                                background-color: var(--white);
                                color: var(--dark-beige);
                            }
                        }
                    }
                }
            }
        }
    }

    
    @media screen and (max-width: 1600px) {
            .confirmation {
                .confirmation-content {
                    height: 200px;
                    width: 60%;
                }
            }
          }

    @media screen and (max-width: 1024px) {
        .home {
            .home-content {
                flex-direction: column;
                .home-left {
                    width: 100%;
                    .home-left-box {
                        margin-bottom: 2rem;
                        .home-box-content {
                            .home-box-top {
                                h2 {
                                    font-size: 24px;
                                }
                                p {
                                    font-size: 20px;
                                }
                            }
                            h2 {
                                font-size: 24px;
                            }
                            p {
                                font-size: 20px;
                            }
                        }
                            
                    }
                }
                .home-right {
                    width: 100%;
                    .home-right-top {
                        margin-bottom: 2rem;
                        .home-right-box {
                            .home-box-content {
                                h2 {
                                    font-size: 24px;
                                }
                                p {
                                    font-size: 20px;
                                }
                            }
                        }
                    }
                    .home-right-bottom {
                        .home-right-box {
                            .home-box-content {
                                h2 {
                                    font-size: 24px;
                                }
                                p {
                                    font-size: 20px;
                                }
                            }
                        }
                    }
                }
            }
        }
        .confirmation {
                .confirmation-content {
                    height: 240px;
                    width: 95%;
                    .confirmation-main {
                        .confirmation-top {
                            hr {
                                width: 30%;
                            }
                        }
                        .confirmation-bottom {
                            .confirmation-buttons {
                                display: flex;
                                flex-direction: column;
                                .confirmation-btn:nth-child(1) {
                                    margin-bottom: 1rem;
                                }
                            }
                        }
                    }
                }
            }
    }

    @media screen and (max-width: 468px) {
        .home {
            .home-content {
                .home-left {
                    .home-left-box {
                        .home-box-content {
                            .home-box-top {
                                h2 {
                                    font-size: 20px;
                                }
                                p {
                                    font-size: 16px;
                                }
                            }
                            p {
                                font-size: 16px;
                            }
                            h2 {
                                    font-size: 20px;
                            }
                        }
                            
                    }
                }
                .home-right {
                    width: 100%;
                    .home-right-top {
                        .home-right-box {
                            .home-box-content {
                                h2 {
                                    font-size: 20px;
                                }
                                p {
                                    font-size: 16px;
                                }
                            }
                        }
                    }
                    .home-right-bottom {
                        .home-right-box {
                            .home-box-content {
                                h2 {
                                    font-size: 20px;
                                }
                                p {
                                    font-size: 16px;
                                }
                                .home-box-button {
                                    .home-box-btn {
                                        width: 100%;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        .confirmation {
                .confirmation-content {
                    height: 260px;
                    .confirmation-main {
                        .confirmation-top {
                            h2 {
                                font-size: 24px;
                            }
                        }
                        .confirmation-bottom {
                            p {
                                font-size: 16px;
                            }
                            .confirmation-buttons {
                                .confirmation-btn {
                                    width: 100%;
                                }
                            }
                        }
                    }
                }
            }
    }
</style>

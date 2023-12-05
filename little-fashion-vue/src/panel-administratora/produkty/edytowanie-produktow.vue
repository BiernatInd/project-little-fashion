<template>
    <AdminHeader />
    <AdminLoginSidebar />
    <div class="home">
        <div class="home-content">
            <div class="home-left">
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Edytowanie nazwy produktu</h2>
                        <input v-model="nowaNazwa" type="text" placeholder="Wprowadź nową nazwę produktu">
                        <div class="home-button">
                            <button class="home-btn" @click="edytujNazweProduktu">Edytuj nazwę produktu</button>
                        </div>
                    </div>
                </div>
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Edytowanie kategorii produktu</h2>
                        <input v-model="nowaKategoriaProduktu" type="text" placeholder="Wprowadź nową kategorię produktu">
                        <div class="home-button">
                            <button class="home-btn" @click="edytujKategorieProduktu">Edytuj kategorię produktu</button>
                        </div>
                    </div>
                </div>
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Edytowanie ceny produktu</h2>
                        <input v-model="nowaCenaProduktu" type="text" placeholder="Wprowadź nową cenę produktu">
                        <div class="home-button">
                            <button class="home-btn" @click="edytujCeneProduktu">Edytuj cenę produktu</button>
                        </div>
                    </div>
                </div>
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Edytowanie ceny promocyjnej produktu</h2>
                        <input v-model="nowaCenaPromocyjnaProduktu" type="text" placeholder="Wprowadź nową cenę produktu">
                        <div class="home-button">
                            <button class="home-btn" @click="edytujCenePromocyjnaProduktu">Edytuj cenę produktu</button>
                        </div>
                    </div>
                </div>
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Edytowanie stanu magazynowego</h2>
                        <input v-model="nowyStanMagazynowyProduktu" type="text" placeholder="Wprowadź nowy stan magazynowy produktu">
                        <div class="home-button">
                            <button class="home-btn" @click="edytujStanMagazynowyProduktu">Edytuj stan magazynowy produktu</button>
                        </div>
                    </div>
                </div>
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Wprowadź zdjęcie produktu numer 1</h2>
                        <input type="file" @change="ObslugaPierwszegoPliku">
                        <div class="home-button">
                            <button class="home-btn" @click="edytujPierwszeZdjecie">Edytuj cenę produktu</button>
                        </div>
                    </div>
                </div>
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Wprowadź zdjęcie produktu numer 2</h2>
                        <input type="file" @change="ObslugaDrugiegoPliku">
                        <div class="home-button">
                            <button class="home-btn" @click="edytujDrugieZdjecie">Edytuj cenę produktu</button>
                        </div>
                    </div>
                </div>
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Wprowadź zdjęcie produktu numer 3</h2>
                        <input type="file" @change="ObslugaTrzeciegoPliku" placeholder="Wprowadź nową cenę produktu">
                        <div class="home-button">
                            <button class="home-btn" @click="edytujTrzecieZdjecie">Edytuj cenę produktu</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-right">
                <div class="home-right-box">
                    <div class="home-box-content">
                        <h2>Aktualny produkt</h2>
                        <p>Numer: {{ product.id }}</p>
                        <p>Nazwa: {{ product.nazwa }}</p>
                        <p>Kategoria: {{ product.kategoria }}</p>
                        <p>Cena: {{  product.cena }}</p>
                        <p>Cena promocyjna: {{  product.cena_promocyjna || 'Brak danych'}}</p>
                        <p>Stan magazynowy: {{ product.stan_magazynowy }}</p>
                        <p>Zdjęcie produktu numer 1: {{ product.zdjecie_produktu_1 }}</p>
                        <p>Zdjęcie produktu numer 2: {{ product.zdjecie_produktu_2 }}</p>
                        <p>Zdjęcie produktu numer 3: {{ product.zdjecie_produktu_3 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            nowaNazwa: '', // Dodane pole do przechowywania nowej nazwy produktu
            nowaKategoriaProduktu: '',
            nowaCenaProduktu: '',
            nowaCenaPromocyjnaProduktu: '',
            nowyStanMagazynowyProduktu: '',
            product: {}, // Dodane pole do przechowywania aktualnych danych produktu
            selectedFirstImage: null,
            selectedSecondImage: null,
            selectedThirdImage: null,
        };
    },
    methods: {
        async pobierzDaneProduktu() {
            const productId = this.$route.params.id;
      try {
        const response = await axios.get(`http://localhost:8000/api/lista-produktow/${productId}`);
        this.product = response.data.product;
      } catch (error) {
        console.error('Błąd podczas pobierania danych produktu:', error);
      }
    },

    async edytujNazweProduktu() {
        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edytuj-nazwe-produktu/${productId}`, {
          nowaNazwa: this.nowaNazwa,
        });

        // Aktualizacja danych produktu po edycji
        await this.pobierzDaneProduktu();
        console.log('Nazwa produktu została zaktualizowana pomyślnie.');
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },

    async edytujKategorieProduktu() {
        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edytuj-kategorie-produktu/${productId}`, {
          nowaKategoriaProduktu: this.nowaKategoriaProduktu,
        });

        // Aktualizacja danych produktu po edycji
        await this.pobierzDaneProduktu();
        console.log('Kategoria produktu została zaktualizowana pomyślnie.');
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },

    async edytujCeneProduktu() {
        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edytuj-cene-produktu/${productId}`, {
          nowaCenaProduktu: this.nowaCenaProduktu,
        });

        // Aktualizacja danych produktu po edycji
        await this.pobierzDaneProduktu();
        console.log('Cena produktu została zaktualizowana pomyślnie.');
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },

    async edytujCenePromocyjnaProduktu() {
        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edytuj-cene-promocyjna-produktu/${productId}`, {
          nowaCenaPromocyjnaProduktu: this.nowaCenaPromocyjnaProduktu,
        });

        // Aktualizacja danych produktu po edycji
        await this.pobierzDaneProduktu();
        console.log('Cena promocyna produktu została zaktualizowana pomyślnie.');
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },

    async edytujStanMagazynowyProduktu() {
        const productId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edytuj-stan-magazynowy-produktu/${productId}`, {
          nowyStanMagazynowyProduktu: this.nowyStanMagazynowyProduktu,
        });

        // Aktualizacja danych produktu po edycji
        await this.pobierzDaneProduktu();
        console.log('Stan magazynowy produktu został zaktualizowany pomyślnie.');
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },

    ObslugaPierwszegoPliku(event) {
        this.selectedFirstImage = event.target.files[0];
    },
    ObslugaDrugiegoPliku(event) {
        this.selectedSecondImage = event.target.files[0];
    },
    ObslugaTrzeciegoPliku(event) {
        this.selectedThirdImage = event.target.files[0];
    },
    async edytujPierwszeZdjecie() {
        const productId = this.$route.params.id;
        const formData = new FormData();
        formData.append('image', this.selectedFirstImage);

        try {
            await axios.post(`http://localhost:8000/api/edytuj-pierwsze-zdjecie/${productId}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });

            // Aktualizacja danych produktu po dodaniu zdjęcia
            await this.pobierzDaneProduktu();
            console.log('Zdjęcie produktu zostało dodane pomyślnie.');
        } catch (error) {
            console.error('Błąd podczas dodawania zdjęcia:', error);
        }
    },
    async edytujDrugieZdjecie() {
        const productId = this.$route.params.id;
        const formData = new FormData();
        formData.append('image', this.selectedSecondImage);

        try {
            await axios.post(`http://localhost:8000/api/edytuj-drugie-zdjecie/${productId}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });

            // Aktualizacja danych produktu po dodaniu zdjęcia
            await this.pobierzDaneProduktu();
            console.log('Zdjęcie produktu zostało dodane pomyślnie.');
        } catch (error) {
            console.error('Błąd podczas dodawania zdjęcia:', error);
        }
    },
    async edytujTrzecieZdjecie() {
        const productId = this.$route.params.id;
        const formData = new FormData();
        formData.append('image', this.selectedThirdImage);

        try {
            await axios.post(`http://localhost:8000/api/edytuj-trzecie-zdjecie/${productId}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });

            // Aktualizacja danych produktu po dodaniu zdjęcia
            await this.pobierzDaneProduktu();
            console.log('Zdjęcie produktu zostało dodane pomyślnie.');
        } catch (error) {
            console.error('Błąd podczas dodawania zdjęcia:', error);
        }
    },
    checkUserRole() {
            const userRole = localStorage.getItem('userRole'); // Zakładam, że rola użytkownika jest przechowywana w local storage

            if (userRole !== 'admin') {
                // Jeżeli użytkownik nie ma roli admin, przekieruj go na stronę logowania
                this.$router.push('/logowanie');
            }
        },
    },
    mounted() {
        // Pobranie danych produktu przy załadowaniu komponentu
        this.pobierzDaneProduktu();
        this.checkUserRole();
    },
}
</script>
  
<style lang="scss" scoped>
    .home {
        .home-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            padding-top: 7rem;
            padding-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            .home-left {
                width: 48%;
                .home-left-box {
                    border: 1px solid var(--dark-beige);
                    border-radius: 10px;
                    .home-box-content {
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        padding-top: 1rem;
                        padding-bottom: 1rem;
                        h2 {
                            font-size: 32px;
                            margin-bottom: 1rem;
                        }
                        input {
                            width: 100%;
                            height: 30px;
                            font-size: 16px;
                            border: none;
                            border-bottom: 1px solid var(--dark-beige);
                            background-color: var(--transparent);
                            margin-bottom: 1rem; 
                        }
                        .home-button {
                            .home-btn {
                                height: 30px;
                                width: 40%;
                                background-color: var(--transparent);
                                border-radius: 5px;
                                border: 1px solid var(--dark-beige);
                                cursor: pointer;
                                transition: 0.5s;
                                font-size: 16px;
                                color: var(--dark-beige);
                                &:hover {
                                    background-color: var(--dark-beige);
                                    color: var(--white);
                                }
                            }
                        }
                    }
                }
                .home-left-box:not(:last-child) {
                    margin-bottom: 2rem
                }
            }
            .home-right {
                width: 48%;
                .home-right-box {
                    border: 1px solid var(--dark-beige);
                    border-radius: 10px;
                    height: 600px;
                    .home-box-content {
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        padding-top: 1rem;
                        padding-bottom: 1rem;
                        h2 {
                            font-size: 32px;
                            margin-bottom: 1rem;
                        }
                        p:not(:last-child) {
                            margin-bottom: 1rem;
                        }
                        p {
                            font-size: 20px;
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .home {
            .home-content {
                flex-direction: column;
                .home-left {
                    width: 100%;
                    margin-bottom: 2rem;
                    .home-left-box {
                        .home-box-content {
                            h2 {
                                font-size: 24px
                            }
                            .home-button {
                                .home-btn {
                                    width: 100%;
                                }
                            }
                        }
                    }
                }
                .home-right {
                    width: 100%;
                    .home-right-box {
                        .home-box-content {
                            h2 {
                                font-size: 24px;
                            }
                        }
                    }
                }
            }
        }
    }
</style>
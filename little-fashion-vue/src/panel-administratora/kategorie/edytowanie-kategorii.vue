<template>
    <AdminHeader />
    <AdminLoginSidebar />
    <div class="home">
        <div class="home-content">
            <div class="home-left">
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Edytowanie nazwy kategorii</h2>
                        <input v-model="nowaNazwaKategorii" type="text" placeholder="Wprowadź nową nazwę kategorii">
                        <div class="home-button">
                            <button class="home-btn" @click="edytujNazweKategorii">Edytuj nazwę kategorii</button>
                        </div>
                    </div>
                </div>
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Edytowanie ścieżki kategorii</h2>
                        <input v-model="nowaSciezkaKategorii" type="text" placeholder="Wprowadź nową ścieżkę">
                        <div class="home-button">
                            <button class="home-btn" @click="edytujSciezkeKategorii">Edytuj ścieżkę kategorii</button>
                        </div>
                        <p>Ważne: Ścieżka musi być z małej litery i zamiast spacji myślniki.</p>
                        <p>Przykład: ubranka-dla-lalek</p>
                    </div>
                </div>
            </div>
            <div class="home-right">
                <div class="home-right-box">
                    <div class="home-box-content">
                        <h2>Aktualny produkt</h2>
                        <p>Numer: {{ kategorie.id }}</p>
                        <p>Nazwa kategorii: {{ kategorie.nazwa_kategorii }}</p>
                        <p>Sciezka kategorii: {{ kategorie.sciezka_kategorii }}</p>
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
            nowaNazwaKategorii: '', // Dodane pole do przechowywania nowej nazwy produktu
            nowaSciezkaKategorii: '',
            kategorie: {}, // Dodane pole do przechowywania aktualnych danych produktu
        };
    },
    methods: {
        async pobierzDaneKategorii() {
            const kategorieId = this.$route.params.id;
      try {
        const response = await axios.get(`http://localhost:8000/api/kategorie/${kategorieId}`);
        this.kategorie = response.data.kategorie;
      } catch (error) {
        console.error('Błąd podczas pobierania danych produktu:', error);
      }
    },

    async edytujNazweKategorii() {
        const kategorieId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edytuj-nazwe-kategorii/${kategorieId}`, {
          nowaNazwaKategorii: this.nowaNazwaKategorii,
        });

        // Aktualizacja danych produktu po edycji
        await this.pobierzDaneKategorii();
        console.log('nazwa kategorii została zaktualizowana pomyślnie.');
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
      }
    },

    async edytujSciezkeKategorii() {
        const kategorieId = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/edytuj-sciezke-kategorii/${kategorieId}`, {
          nowaSciezkaKategorii: this.nowaSciezkaKategorii,
        });

        // Aktualizacja danych produktu po edycji
        await this.pobierzDaneKategorii();
        console.log('sciezka kategorii została zaktualizowana pomyślnie.');
      } catch (error) {
        console.error('Błąd podczas aktualizacji nazwy produktu:', error);
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
        this.pobierzDaneKategorii();
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
                        p {
                            margin-top: 1rem;
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
<template>
    <AdminHeader />
    <AdminLoginSidebar />
    <div class="home">
        <div class="home-content">
            <div class="home-main">
                <div class="home-main-content">
                    <h1>Dodawanie produktów</h1>
                    <div class="input-flex">
                        <input v-model="nazwaProduktu" type="text" placeholder="Wprowadź nazwę produktu">
                        <input v-model="kategoriaProduktu" type="text" placeholder="Wprowadź kategorię produktu">
                    </div>
                    <div class="input-flex">
                        <input v-model="cenaProduktu" type="number" placeholder="Wprowadź cenę produktu">
                        <input v-model="cenaPromocyjnaProduktu" type="number" placeholder="Wprowadź cenę promocyjną produktu">
                    </div>
                    <div class="input-flex">
                        <input v-model="stanMagazynowyProduktu" type="number" placeholder="Wprowadź stan magazynowy produktu">
                        <input type="file" @change="handleFileChange1">
                    </div>
                    <div class="input-flex">
                        <input type="file" @change="handleFileChange2">
                        <input type="file" @change="handleFileChange3">
                    </div>
                    <div class="home-button">
                        <button class="home-btn" @click="dodajProdukt">Dodaj produkt</button>
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
            nazwaProduktu: '',
            kategoriaProduktu: '',
            cenaProduktu: '',
            cenaPromocyjnaProduktu: '',
            stanMagazynowyProduktu: '',
            zdjecieProduktu1: null,
            zdjecieProduktu2: null,
            zdjecieProduktu3: null,
        };
    },
    methods: {
        handleFileChange1(event) {
      this.zdjecieProduktu1 = event.target.files[0];
    },

    handleFileChange2(event) {
      this.zdjecieProduktu2 = event.target.files[0];
    },

    handleFileChange3(event) {
      this.zdjecieProduktu3 = event.target.files[0];
    },
    
    dodajProdukt() {

        if (!this.nazwaProduktu || !this.kategoriaProduktu || !this.cenaProduktu || !this.stanMagazynowyProduktu || !this.zdjecieProduktu1 || !this.zdjecieProduktu2 || !this.zdjecieProduktu3) {
                alert('Wszystkie pola oprócz ceny promocyjnej, muszą zostać wypełnione.');
                return; // Do not proceed if any required field is empty
            }
            
        let formData = new FormData();
        formData.append('nazwa', this.nazwaProduktu);
        formData.append('kategoria', this.kategoriaProduktu);
        formData.append('cena', this.cenaProduktu);
        formData.append('cena_promocyjna', this.cenaPromocyjnaProduktu);
        formData.append('stan_magazynowy', this.stanMagazynowyProduktu);
        formData.append('zdjecie_produktu_1', this.zdjecieProduktu1);
        formData.append('zdjecie_produktu_2', this.zdjecieProduktu2);
        formData.append('zdjecie_produktu_3', this.zdjecieProduktu3);

        // Wysyłamy dane do kontrolera za pomocą Axios
        axios.post('http://localhost:8000/api/dodaj-produkt', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        })
        .then(response => {
            // Otrzymaliśmy odpowiedź z serwera
            console.log(response.data.message);
            alert('Produkt dodany pomyślnie');
            this.clearFields();
            // Możesz dodać kod obsługi odpowiedzi, np. wyświetlenie komunikatu o sukcesie
        })
        .catch(error => {
            // Obsługa błędów
            console.error('Błąd podczas dodawania produktu:', error);
            // Możesz dodać kod obsługi błędów, np. wyświetlenie komunikatu o błędzie
        });
    },
    clearFields() {
            // Wyczyszczenie wszystkich pól
            this.nazwaProduktu = '';
            this.kategoriaProduktu = '';
            this.cenaProduktu = '';
            this.cenaPromocyjnaProduktu = '';
            this.stanMagazynowyProduktu = '';
            this.zdjecieProduktu1 = null;
            this.zdjecieProduktu2 = null;
            this.zdjecieProduktu3 = null;

            const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.value = null;
    });
        },
        checkUserRole() {
            const userRole = localStorage.getItem('userRole'); // Zakładam, że rola użytkownika jest przechowywana w local storage

            if (userRole !== 'admin') {
                // Jeżeli użytkownik nie ma roli admin, przekieruj go na stronę logowania
                this.$router.push('/logowanie');
            }
        },
    },
    created() {
        this.checkUserRole();
    }
}
</script>
  
<style lang="scss" scoped>
.home {
    .home-content {
        padding-top: 7rem;
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        padding-bottom: 2rem;
        .home-main {
            width: 1200px;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid var(--dark-beige);
            border-radius: 10px;

            .home-main-content {
                width: 95%;
                margin-left: auto;
                margin-right: auto;
                padding-top: 2rem;
                padding-bottom: 2rem;
                h1 {
                    font-size: 32px;
                    color: var(--black);
                    margin-bottom: 2rem;
                }
                .input-flex {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 2rem;
                    input {
                        font-size: 16px;
                        width: 48%;
                        height: 30px;
                        border: none;
                        border-bottom: 1px solid var(--dark-beige);
                        background-color: var(--transparent);
                    }
                }
                .home-button {
                    .home-btn {
                        width: 20%;
                        height: 30px;
                        background-color: var(--transparent);
                        border: 1px solid var(--dark-beige);
                        color: var(--dark-beige);
                        font-size: 16px;
                        cursor: pointer;
                        transition: 0.5s;
                        border-radius: 5px;
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

@media screen and (max-width: 1600px) {
    .home {
        .home-content {
            .home-main {
                width: 80%;
            }
        }
    }
}

@media screen and (max-width: 1024px) {
    .home {
        .home-content {
            .home-main {
                width: 100%;
                .home-main-content {
                    h1 {
                        font-size: 24px;
                    }
                    .input-flex {
                        flex-direction: column;
                        margin-bottom: 0;
                        input {
                            width: 100%;
                            margin-bottom: 2rem
                        }
                    }
                    .home-button {
                        .home-btn {
                            width: 100%;
                        }
                    }
                }
            }
        }
    }
}
</style>


<!-- <div class="input-flex">
    <input type="number" placeholder="Wprowadź cenę produktu">
    <input type="number" placeholder="Wprowadź cenę promocyjną produktu">
</div>
<div class="input-flex">
    <input type="number" placeholder="Wprowadź stan magazynowy">
    <input type="file">
</div>
<div class="input-flex">
    <input type="file">
    <input type="file">
</div> -->
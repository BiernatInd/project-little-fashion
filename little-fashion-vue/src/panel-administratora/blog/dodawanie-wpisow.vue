<template>
    <div>
        <AdminHeader />
        <AdminLoginSidebar />
        <div class="home">
            <div class="home-content">
                <div class="home-main">
                    <div class="home-main-content">
                        <h1>Dodawanie wpisów</h1>
                        <div class="input-flex">
                            <input type="text" v-model="metaTitle" placeholder="Wprowadź Meta Tag Title">
                            <input type="text" v-model="metaDescription" placeholder="Wprowadź Meta Tag Description">
                        </div>
                        <div class="input-flex">
                            <input type="text" v-model="sciezkaArtykulu" placeholder="Wprowadź ścieżkę artykułu">
                            <input type="text" v-model="nazwaArtykulu" placeholder="Wprowadź nazwę artykułu">
                        </div>
                        <div class="home-button">
                            <button class="home-btn" @click="dodajWpis">Dodaj wpis</button>
                        </div>
                        <p>Ścieżka wpisu musi być z małych liter oraz mieć myślniki zamiast spacji.</p>
                        <p>Przykład: ubranka-dla-lalek.</p>
                    </div>
                </div>
            </div>
        </div>
        <MainFooterBottom />
    </div>
</template>

<script>
import AdminHeader from '../../components/admin/admin-header.vue'
import MainFooterBottom from '../../components/main/main-footer-bottom.vue'
import axios from 'axios'
import router from '../../router/router' // Załóżmy, że router jest dostępny w pliku z tym komponentem

export default {
    components: {
        AdminHeader,
        MainFooterBottom
    },
    data() {
        return {
            metaTitle: '',
            metaDescription: '',
            sciezkaArtykulu: '',
            nazwaArtykulu: '',
        };
    },
    methods: {
    dodajWpis() {

        if (
      !this.metaTitle ||
      !this.metaDescription ||
      !this.sciezkaArtykulu ||
      !this.nazwaArtykulu
    ) {
      // Display an alert if any field is empty
      alert('Wszystkie pola muszą zostać wypełnione.');
      return; // Stop execution if any field is empty
    }


      axios.post('http://localhost:8000/api/dodaj-wpis', {
        metaTitle: this.metaTitle,
        metaDescription: this.metaDescription,
        sciezkaArtykulu: this.sciezkaArtykulu,
        nazwaArtykulu: this.nazwaArtykulu,
      })
      .then(response => {
        console.log(response.data.message);

        // Przekieruj do widoku dodawania zdjęć z przekazaniem ścieżki artykułu
        const sciezkaArtykulu = this.sciezkaArtykulu;
        router.push({ name: 'dodawanie-zdjec-do-wpisow', params: { sciezkaArtykulu } });
      })
      .catch(error => {
        console.error('Błąd podczas dodawania wpisu:', error.response.data);
        // Dodaj odpowiednie działania po nieudanym dodaniu wpisu
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
  mounted() {
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
                p {
                    margin-top: 1rem;
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

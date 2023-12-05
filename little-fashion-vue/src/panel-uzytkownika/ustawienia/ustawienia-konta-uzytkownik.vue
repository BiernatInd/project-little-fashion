<template>
    <UserHeader />
    <AdminLoginSidebar />
    <div class="home">
        <div class="home-content">
            <div class="home-left">
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Aktualne dane twojego konta</h2>
                        <hr>
                        <p>Nazwa użytkownika: {{ uzytkownicy.length > 0 ? uzytkownicy[0].name : 'Brak danych' }}</p>
                        <p>Adres E-mail: {{ uzytkownicy.length > 0 ? uzytkownicy[0].email : 'Brak danych' }}</p>
                    </div>
                </div>
            </div>
            <div class="home-right">
                <div class="home-right-box">
                    <div class="home-box-content">
                        <h2>Zmiana danych</h2>
                        <hr>
                        <router-link v-if="uzytkownicy.length > 0" :to="{ name: 'zmiana-email-uzytkownik', params: { id: uzytkownicy[0].id }}">Zmień adres E-mail</router-link>
                     </div>
                </div>
            </div>
        </div>
        <div class="home-content">
            <div class="home-right">
                <div class="home-right-box">
                    <div class="home-box-content">
                        <h2>Usuwanie konta</h2>
                        <hr>
                        <a href="#" @click="showConfirmation">Usuń konto</a>
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
                <p>Czy napewno chcesz usunąć konto?</p>
                <div class="confirmation-buttons">
                    <button class="confirmation-btn" :class="{ 'active': confirmationActive }" @click="hideConfirmation" ref="collection">Anuluj</button>
                    <button class="confirmation-btn" @click="deleteAccount">Usuń</button>
                </div>
            </div>
        </div>
      </div>
    </div>
    <MainFooterBottom />
  </template>

<script>
import UserHeader from '../../components/user/user-header.vue'
import MainFooterBottom from '../../components/main/main-footer-bottom.vue'
import axios from 'axios'

export default {
    components: {
        UserHeader,
        MainFooterBottom
    },
    data() {
        return {
            confirmationActive: false,
            uzytkownicy: [],
        }
    },
    methods: {
        showConfirmation() {
        console.log('showConfirmation');
        this.confirmationActive = !this.confirmationActive;
        document.body.classList.toggle('active', this.confirmationActive);
    },
    hideConfirmation() {
        console.log('hideConfirmation');
        this.confirmationActive = false;
        document.body.classList.remove('active');
    },
    fetchData() {
        axios.get('http://localhost:8000/api/pobierz-uzytkownika')
          .then(response => {
            console.log('Odpowiedź z API:', response.data)
            this.uzytkownicy = response.data.uzytkownicy
          })
          .catch(error => {
            console.error('Błąd pobierania danych:', error)
          })
      },
      deleteAccount() {
            // Wyślij żądanie do kontrolera usuwania konta
            axios.delete(`http://localhost:8000/api/usun-konto-uzytkownika/${this.uzytkownicy[0].id}`)
                .then(response => {
                    console.log('Odpowiedź z API:', response.data);
                    // Jeżeli usunięcie konta powiodło się, przekieruj użytkownika na stronę logowania
                    // Tutaj możesz też zaimplementować inne działania po usunięciu konta
                    alert('Konto zostało usunięte.')
                    this.clearLocalStorage();
                    this.$router.push({ name: 'logowanie' });
                })
                .catch(error => {
                    console.error('Błąd usuwania konta:', error);
                    // Tutaj możesz obsłużyć błędy, np. wyświetlić komunikat użytkownikowi
                });
        },
        clearLocalStorage() {
            // Wyczyść wszystkie dane z local storage
            localStorage.clear();
        },
        checkUserRole() {
            const userRole = localStorage.getItem('userRole'); // Zakładam, że rola użytkownika jest przechowywana w local storage

            if (userRole !== 'user') {
                // Jeżeli użytkownik nie ma roli user, przekieruj go na stronę logowania
                this.$router.push('/logowanie');
            }
        },
},
mounted() {
    this.checkUserRole();
    this.fetchData();
}
}
</script>
  
<style lang="scss" scoped>
    .home {
        .home-content:first-child {
            padding-top: 7rem;
        }
        .home-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
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
                            margin-bottom: 1rem;
                        }
                        a {
                            font-size: 20px;
                            color: var(--black);
                            text-underline-offset: 4px;
                            transition: 0.5s;
                            &:hover {
                                color: var(--dark-beige);
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
                    .home-box-content {
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        padding-top: 1rem;
                        display: flex;
                        flex-direction: column;
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
                        a {
                            font-size: 20px;
                            margin-bottom: 1rem;
                            color: var(--black);
                            text-underline-offset: 4px;
                            transition: 0.5s;
                            &:hover {
                                color: var(--dark-beige);
                            }
                        }
                    }
                }
                .home-left-box:not(:last-child) {
                    margin-bottom: 2rem
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
                    margin-bottom: 2rem;
                    .home-left-box {
                        .home-box-content {
                            h2 {
                                font-size: 24px
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

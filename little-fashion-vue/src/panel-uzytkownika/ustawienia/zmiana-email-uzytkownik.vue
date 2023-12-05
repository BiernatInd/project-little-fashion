<template>
    <UserHeader />
    <div class="change-email">
        <div class="change-email-content">
            <div class="change-email-main">
                <div class="change-email-left">
                    <div class="change-email-left-content">
                    </div>
                </div>
                <div class="change-email-right">
                    <div class="change-email-right-content">
                        <h1>Zmiana E-mail</h1>
                        <input v-model="nowyEmail" type="email" placeholder="Wprowadź nowy E-mail">
                            <input v-model="haslo" type="password" placeholder="Wprowadź hasło">
                            <button @click="zmienEmail" class="change-email-btn">Zmień e-mail</button>
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
            nowyEmail: '',
            haslo: '',
        }
    },
    methods: {
        zmienEmail() {
            // Walidacja: Sprawdź, czy oba pola są wypełnione
            if (!this.nowyEmail || !this.haslo) {
                alert('Wszystkie pola muszą zostać wypełnione.');
                return;
            }

            const userId = this.$route.params.id;
            axios.put(`http://localhost:8000/api/zmien-email-uzytkownika/${userId}`, {
                nowy_email: this.nowyEmail,
                haslo: this.haslo
            })
            .then(response => {
                console.log(response.data.message);
                alert("Adres E-mail został pomyślnie zmieniony.")
            })
            .catch(error => {
                console.error(error.response.data.error);

                if (error.response.status === 401) {
                    alert('Wprowadź poprawne hasło.'); // Możesz dostosować komunikat według potrzeb
                }
            });
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
    }
}
</script>
  
<style lang="scss" scoped>
    .change-email {
        .change-email-content {
            padding-top: 7rem;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 2rem;
            .change-email-main {
                display: flex;
                width: 800px;
                margin-left: auto;
                margin-right: auto;
                border-radius: 10px;
                border: 1px solid var(--dark-beige);
                .change-email-left {
                    width: 30%;
                    padding-top: 2rem;
                    padding-bottom: 2rem;
                    border-top-right-radius: 10px;
                    border-bottom-right-radius: 10px;
                    border-right: 1px solid var(--dark-beige);
                    background: url('../../assets/authorize-logo.png');
                    background-size: 80%;
                    background-repeat: no-repeat;
                    background-position: center;
                    .change-email-left-content {
                        width: 90%;
                        margin-left: auto;
                        margin-right: auto;
                        display: flex;
                        flex-direction: column;
                        .change-email-link {
                            color: var(--black);
                            text-underline-offset: 4px;
                            margin-bottom: 1rem;
                            transition: 0.5s;
                            &:hover {
                                color: var(--dark-beige);
                            }
                        }
                        .change-email-link.active {
                            color: var(--dark-beige);
                        }
                    }
                }
                .change-email-right {
                    width: 70%;
                    padding-top: 2rem;
                    padding-bottom: 2rem;
                    .change-email-right-content {
                        width: 90%;
                        margin-left: auto;
                        margin-right: auto;
                        display: flex;
                        flex-direction: column;
                        h1 {
                            font-size: 32px;
                            color: var(--black);
                            margin-bottom: 1rem;
                        }
                        input {
                            height: 30px;
                            font-size: 16px;
                            border: none;
                            border-bottom: 1px solid var(--dark-beige);
                            background-color: var(--transparent);
                            margin-bottom: 1rem;
                        }
                        .change-email-btn {
                            height: 30px;
                            background-color: var(--dark-beige);
                            font-size: 16px;
                            color: var(--white);
                            border: 1px solid var(--dark-beige);
                            cursor: pointer;
                            transition: 0.5s;
                            border-radius: 5px;
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

    @media screen and (max-width: 1024px) {
        .change-email {
            .change-email-content {
                padding-top: 7rem;
                .change-email-main {
                    width: 100%;
                }
            }
        }
    }

    @media screen and (max-width: 468px) {
        .change-email {
            .change-email-content {
                .change-email-main {
                    width: 100%;
                    flex-direction: column;
                    .change-email-left {
                        width: 100%;
                        border-radius: 0;
                        border-bottom: 1px solid var(--dark-beige);
                        background-size: 20%;
                        border-right: none;
                    }
                    .change-email-right {
                        width: 100%;
                        .change-email-right-content {
                            h1 {
                                font-size: 24px;
                            }
                        }
                    }
                }
            }
        }
    }
</style>
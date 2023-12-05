<template>
    <MainHeader />
    <div class="reset-password">
        <div class="reset-password-content">
            <div class="reset-password-main">
                <div class="reset-password-left">
                    <div class="reset-password-left-content">
                        <router-link to="/logowanie" class="reset-password-link">Logowanie</router-link>
                        <router-link to="/rejestracja" class="reset-password-link">Rejestracja</router-link>
                        <router-link to="/odzyskiwanie-hasla" class="reset-password-link active">Odzyskiwanie hasła</router-link>
                    </div>
                </div>
                <div class="reset-password-right">
                    <div class="reset-password-right-content">
                        <h1>Resetowanie hasła</h1>
                        <input v-model="password" type="password" placeholder="Wprowadź hasło">
                        <input v-model="confirmPassword" type="password" placeholder="Zresetuj hasło">
                        <button type="submit" class="reset-password-btn" @click="resetPassword">Zresetuj hasło</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <MainFooterTop />
    <MainFooterBottom /> 
</template>

<script>
import MainHeader from '../components/main/main-header.vue'
import MainFooterTop from '../components/main/main-footer-top.vue'
import MainFooterBottom from '../components/main/main-footer-bottom.vue'
import axios from 'axios';

export default {
    components: {
        MainHeader,
        MainFooterTop,
        MainFooterBottom
    },
    data() {
        return {
            password: '',
            confirmPassword: '',
            token: null
        };
    },
    methods: {
        resetPassword() {

            if (!this.password || !this.confirmPassword) {
                // Jeśli pole jest puste, wyświetl alert i zakończ funkcję
                alert('Wszysktie pola muszą zostać wypełnione.');
                return;
            }

            // Weryfikacja, czy hasła są takie same
            if (this.password !== this.confirmPassword) {
                alert('Hasła nie są takie same');
                return;
            }

            // Upewnij się, że token istnieje przed wysłaniem zapytania
            if (!this.token) {
                alert('Nieprawidłowy token');
                return;
            }

            // Wysłanie zapytania do Laravela
            axios.post(`http://localhost:8000/api/reset-password/${this.token}`, {
                password: this.password
            })
            .then(response => {
                // Reakcja na poprawną odpowiedź z serwera
                alert(response.data.message);
            })
            .catch(error => {
                // Reakcja na błąd
                alert('Wystąpił błąd: ' + error.response.data.message);
            });
        }
    },
    mounted() {
        // Pobranie tokenu z routera
        this.token = this.$route.params.token;
        console.log(this.token); // Dodaj to, aby sprawdzić wartość tokenu w konsoli
    }
}
</script>
  
<style lang="scss" scoped>
    .reset-password {
        .reset-password-content {
            padding-top: 7rem;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .reset-password-main {
                display: flex;
                width: 800px;
                margin-left: auto;
                margin-right: auto;
                border-radius: 10px;
                border: 1px solid var(--dark-beige);
                .reset-password-left {
                    width: 30%;
                    padding-top: 2rem;
                    padding-bottom: 2rem;
                    border-top-right-radius: 10px;
                    border-bottom-right-radius: 10px;
                    border-right: 1px solid var(--dark-beige);
                    background: url('../assets/authorize-logo.png');
                    background-size: 80%;
                    background-repeat: no-repeat;
                    background-position: center;
                    .reset-password-left-content {
                        width: 90%;
                        margin-left: auto;
                        margin-right: auto;
                        display: flex;
                        flex-direction: column;
                        .reset-password-link {
                            color: var(--black);
                            text-underline-offset: 4px;
                            margin-bottom: 1rem;
                            transition: 0.5s;
                            &:hover {
                                color: var(--dark-beige);
                            }
                        }
                        .reset-password-link.active {
                            color: var(--dark-beige);
                        }
                    }
                }
                .reset-password-right {
                    width: 70%;
                    padding-top: 2rem;
                    padding-bottom: 2rem;
                    .reset-password-right-content {
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
                        .reset-password-btn {
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
        .reset-password {
            .reset-password-content {
                padding-top: 7rem;
                .reset-password-main {
                    width: 100%;
                }
            }
        }
    }

    @media screen and (max-width: 468px) {
        .reset-password {
            .reset-password-content {
                .reset-password-main {
                    width: 100%;
                    flex-direction: column;
                    .reset-password-left {
                        width: 100%;
                        border-radius: 0;
                        border-bottom: 1px solid var(--dark-beige);
                        background-size: 50%;
                        border-right: none;
                    }
                    .reset-password-right {
                        width: 100%;
                        .reset-password-right-content {
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
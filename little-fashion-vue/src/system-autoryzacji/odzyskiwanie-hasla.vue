<template>
    <MainHeader />
    <div class="recover-password">
        <div class="recover-password-content">
            <div class="recover-password-main">
                <div class="recover-password-left">
                    <div class="recover-password-left-content">
                        <router-link to="/logowanie" class="recover-password-link">Logowanie</router-link>
                        <router-link to="/rejestracja" class="recover-password-link">Rejestracja</router-link>
                        <router-link to="/odzyskiwanie-hasla" class="recover-password-link active">Odzyskiwanie hasła</router-link>
                    </div>
                </div>
                <div class="recover-password-right">
                    <div class="recover-password-right-content">
                        <h1>Odzyskiwanie hasła</h1>
                        <input v-model="email" type="email" placeholder="Wprowadź E-mail">
                        <button type="submit" class="recover-password-btn" @click="recoverPassword">Odzyskaj hasło</button>
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
            email: '',
        };
    },
    methods: {
        async recoverPassword() {
            if (!this.email.trim()) {
                // Jeśli pole jest puste, wyświetl alert i zakończ funkcję
                alert('Pole musi zostać wypełnione.');
                return;
            }

            try {
                const response = await axios.post('http://localhost:8000/api/recover-password', {
                    email: this.email,
                });

                // Console.log dla celów debugowania - możesz to później usunąć
                console.log(response.data);

                // Opcjonalnie: przekieruj użytkownika na inną stronę po pomyślnym odzyskaniu hasła
                // this.$router.push('/');

            } catch (error) {
                // Console.error dla celów debugowania - możesz to później usunąć
                console.error(error.response.data);
            }
        },
    },
};
</script>

  
<style lang="scss" scoped>
    .recover-password {
        .recover-password-content {
            padding-top: 7rem;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .recover-password-main {
                display: flex;
                width: 800px;
                margin-left: auto;
                margin-right: auto;
                border-radius: 10px;
                border: 1px solid var(--dark-beige);
                .recover-password-left {
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
                    .recover-password-left-content {
                        width: 90%;
                        margin-left: auto;
                        margin-right: auto;
                        display: flex;
                        flex-direction: column;
                        .recover-password-link {
                            color: var(--black);
                            text-underline-offset: 4px;
                            margin-bottom: 1rem;
                            transition: 0.5s;
                            &:hover {
                                color: var(--dark-beige);
                            }
                        }
                        .recover-password-link.active {
                            color: var(--dark-beige);
                        }
                    }
                }
                .recover-password-right {
                    width: 70%;
                    padding-top: 2rem;
                    padding-bottom: 2rem;
                    .recover-password-right-content {
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
                        .recover-password-btn {
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
        .recover-password {
            .recover-password-content {
                padding-top: 7rem;
                .recover-password-main {
                    width: 100%;
                }
            }
        }
    }

    @media screen and (max-width: 468px) {
        .recover-password {
            .recover-password-content {
                .recover-password-main {
                    width: 100%;
                    flex-direction: column;
                    .recover-password-left {
                        width: 100%;
                        border-radius: 0;
                        border-bottom: 1px solid var(--dark-beige);
                        background-size: 50%;
                        border-right: none;
                    }
                    .recover-password-right {
                        width: 100%;
                        .recover-password-right-content {
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
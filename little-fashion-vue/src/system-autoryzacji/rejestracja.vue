<template>
    <MainHeader />
    <div class="register">
        <div class="register-content">
            <div class="register-main">
                <div class="register-left">
                    <div class="register-left-content">
                        <router-link to="/logowanie" class="register-link">Logowanie</router-link>
                        <router-link to="/rejestracja" class="register-link active">Rejestracja</router-link>
                        <router-link to="/odzyskiwanie-hasla" class="register-link">Odzyskiwanie hasła</router-link>
                    </div>
                </div>
                <div class="register-right">
                    <div class="register-right-content">
                        <h1>Rejestracja</h1>
                        <input v-model="name" type="text" placeholder="Wprowadź nazwę użytkownika" required>
                        <input v-model="email" type="email" placeholder="Wprowadź E-mail" required>
                        <input v-model="password" type="password" placeholder="Wprowadź hasło" required>
                        <input v-model="password_confirmation" type="password" placeholder="Powtórz hasło" required>
                        <button type="submit" class="register-btn" @click="register">Zarejestruj się</button>
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
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        };
    },
    methods: {
        async register() {

            if (!this.name || !this.email || !this.password || !this.password_confirmation) {
                // Jeśli pole jest puste, wyświetl alert i zakończ funkcję
                alert('Wszystkie pola muszą zostać wypełnione.');
                return;
            }

        // Walidacja hasła
        const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (!passwordRegex.test(this.password)) {
            // Hasło nie spełnia wymagań, możesz obsłużyć to odpowiednim komunikatem
            alert('Hasło musi mieć co najmniej 8 znaków, zawierać dużą literę, liczbę i jeden znak specjalny.');
            return;
        }

        try {
            const response = await axios.post('http://localhost:8000/api/register', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            });

            this.$router.push('/logowanie');
            // Tutaj możesz obsłużyć odpowiedź serwera (np. wyświetlić komunikat o sukcesie)
            console.log(response.data);
        } catch (error) {
            // Tutaj możesz obsłużyć błędy (np. wyświetlić komunikat o błędzie)
            console.error(error.response.data);
        }
    }
    }
}
</script>
  
<style lang="scss" scoped>
    .register {
        .register-content {
            padding-top: 7rem;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .register-main {
                display: flex;
                width: 800px;
                margin-left: auto;
                margin-right: auto;
                border-radius: 10px;
                border: 1px solid var(--dark-beige);
                .register-left {
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
                    .register-left-content {
                        width: 90%;
                        margin-left: auto;
                        margin-right: auto;
                        display: flex;
                        flex-direction: column;
                        .register-link {
                            color: var(--black);
                            text-underline-offset: 4px;
                            margin-bottom: 1rem;
                            transition: 0.5s;
                            &:hover {
                                color: var(--dark-beige);
                            }
                        }
                        .register-link.active {
                            color: var(--dark-beige);
                        }
                    }
                }
                .register-right {
                    width: 70%;
                    padding-top: 2rem;
                    padding-bottom: 2rem;
                    .register-right-content {
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
                        .register-btn {
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
        .register {
            .register-content {
                padding-top: 7rem;
                .register-main {
                    width: 100%;
                }
            }
        }
    }

    @media screen and (max-width: 468px) {
        .register {
            .register-content {
                .register-main {
                    width: 100%;
                    flex-direction: column;
                    .register-left {
                        width: 100%;
                        border-radius: 0;
                        border-bottom: 1px solid var(--dark-beige);
                        background-size: 50%;
                        border-right: none;
                    }
                    .register-right {
                        width: 100%;
                        .register-right-content {
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
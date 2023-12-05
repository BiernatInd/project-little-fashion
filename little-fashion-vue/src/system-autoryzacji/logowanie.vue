<template>
    <MainHeader />
    <div class="login">
        <div class="login-content">
            <div class="login-main">
                <div class="login-left">
                    <div class="login-left-content">
                        <router-link to="/logowanie" class="login-link active">Logowanie</router-link>
                        <router-link to="/rejestracja" class="login-link">Rejestracja</router-link>
                        <router-link to="/odzyskiwanie-hasla" class="login-link">Odzyskiwanie hasła</router-link>
                    </div>
                </div>
                <div class="login-right">
                    <div class="login-right-content">
                        <h1>Logowanie</h1>
                        <input v-model="email" type="email" placeholder="Wprowadź E-mail" required>
                        <input v-model="password" type="password" placeholder="Wprowadź hasło" required>
                        <button class="login-btn" @click="login">Zaloguj się</button>
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
            password: '',
            userRole: '',
            userName: '',
        };
    },
    methods: {
        async login() {

            if (!this.email || !this.password) {
                // Jeśli pole jest puste, wyświetl alert i zakończ funkcję
                alert('Wszystkie pola muszą zostać wypełnione.');
                return;
            }

    try {
        const response = await axios.post('http://localhost:8000/api/login', {
            email: this.email,
            name: this.name,
            password: this.password,
        });

        // Po udanym zalogowaniu, zapisz informacje o zalogowanym użytkowniku w localStorage
        localStorage.setItem('isLoggedIn', 'true');
        
        // Zapisz rolę użytkownika w localStorage
        localStorage.setItem('userRole', response.data.user.role);
        localStorage.setItem('userName', response.data.user.name)

        // Tutaj możesz obsłużyć odpowiedź serwera (np. przechować token sesji)
        console.log('Zalogowano pomyślnie:', response.data);

        // Przekieruj użytkownika w zależności od roli
        if (response.data.user.role === 'admin') {
            this.$router.push('/lista-zamowien-administrator');
        } else if (response.data.user.role === 'user') {
            this.$router.push('/lista-zamowien-uzytkownik')
        }
        else {
        }
    } catch (error) {
        // Tutaj możesz obsłużyć błędy (np. wyświetlić komunikat o błędzie logowania)
        alert("Nieprawidłowe dane logowania. Spróbuj ponownie.")
        console.error('Błąd logowania:', error.response.data);
    }
}

    }
}
</script>
  
<style lang="scss" scoped>
    .login {
        .login-content {
            padding-top: 7rem;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .login-main {
                display: flex;
                width: 800px;
                margin-left: auto;
                margin-right: auto;
                border-radius: 10px;
                border: 1px solid var(--dark-beige);
                .login-left {
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
                    .login-left-content {
                        width: 90%;
                        margin-left: auto;
                        margin-right: auto;
                        display: flex;
                        flex-direction: column;
                        .login-link {
                            color: var(--black);
                            text-underline-offset: 4px;
                            margin-bottom: 1rem;
                            transition: 0.5s;
                            &:hover {
                                color: var(--dark-beige);
                            }
                        }
                        .login-link.active {
                            color: var(--dark-beige);
                        }
                    }
                }
                .login-right {
                    width: 70%;
                    padding-top: 2rem;
                    padding-bottom: 2rem;
                    .login-right-content {
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
                        .login-btn {
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
        .login {
            .login-content {
                padding-top: 7rem;
                .login-main {
                    width: 100%;
                }
            }
        }
    }

    @media screen and (max-width: 468px) {
        .login {
            .login-content {
                .login-main {
                    width: 100%;
                    flex-direction: column;
                    .login-left {
                        width: 100%;
                        border-radius: 0;
                        border-bottom: 1px solid var(--dark-beige);
                        background-size: 50%;
                        border-right: none;
                    }
                    .login-right {
                        width: 100%;
                        .login-right-content {
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
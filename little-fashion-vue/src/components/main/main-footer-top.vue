<template>
    <div class="footer-top">
        <div class="footer-top-content">
            <div class="footer-col">
                <div class="footer-col-content">
                    <h2>Główne menu</h2>
                    <router-link to="/">Strona główna</router-link>
                    <router-link to="/o-naszej-firmie">O naszej firmie</router-link>
                    <router-link to="/faq">Faq</router-link>
                    <router-link to="/sklep">Nasz sklep</router-link>
                    <router-link to="/blog">Blog</router-link>
                    <router-link to="/galeria">Galeria</router-link>
                    <router-link to="/kontakt">Kontakt</router-link>
                </div>
            </div>
            <div class="footer-col">
                <div class="footer-col-content">
                    <h2>Informacje dla klienta</h2>
                    <router-link to="/polityka-prywatnosci">Polityka prywatności</router-link>
                    <router-link to="/polityka-cookies">Polityka cookies</router-link>
                    <router-link to="/regulamin">Regulamin</router-link>
                </div>
            </div>
            <div class="footer-col">
                <div class="footer-col-content">
                    <h2>Moje konto</h2>
                    <router-link to="/rejestracja">Zarejestruj się</router-link>
                    <router-link to="/logowanie">Zaloguj się</router-link>
                    <router-link to="/odzyskiwanie-hasla">Odzyskaj hasło</router-link>
                    <router-link to="/logowanie">Moje zamówienia</router-link>
                    <router-link to="/logowanie">Status zamówienia</router-link>
                    <router-link to="/odstapienie">Formularz odstąpienia od umowy</router-link>
                </div>
            </div>
            <div class="footer-col">
                <div class="footer-col-content">
                    <h2>Firma</h2>
                    <p>Nazwa firmy: KAROL BIERNAT VIBEWEBS</p>
                    <p>NIP: 8641964486</p>
                    <p>Adres E-mail: biuro@little-fashion.pl</p>
                </div>
            </div>
            <div class="footer-col">
                <div class="footer-col-content">
                    <h2>Obsługa klienta</h2>
                    <a href="tel:+48 733 001 533">+48 733 001 533</a>
                    <p>Pon. - Pt. 8:00 - 18:00</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

</script>
  
<style lang="scss" scoped>
    .footer-top {
        padding-top: 4rem;
        padding-bottom: 2rem;
        .footer-top-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            .footer-col {
                width: 20%;
                .footer-col-content {
                    width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                    display: flex;
                    flex-direction: column;
                    h2 {
                        margin-bottom: 1rem;
                        font-size: 24px;
                    }
                    a {
                        margin-bottom: 1rem;
                        color: var(--black);
                        text-underline-offset: 4px;
                        transition: 0.5s;
                        font-size: 16px;
                        &:hover {
                            color: var(--dark-beige);
                        }
                    }
                    p {
                        margin-bottom: 1rem;
                        color: var(--black);
                        font-size: 16px;
                    }
                }
            }
            .footer-col:first-child {
                border-left: 2px solid var(--dark-beige);
            }
            .footer-col:last-child {
                border-right: 2px solid var(--dark-beige);
            }
            .footer-col:not(:last-child) {
                border-right: 2px solid var(--dark-beige);
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .footer-top {
            padding-top: 2rem;
            padding-bottom: 2rem;
            .footer-top-content {
                flex-direction: column;
                .footer-col {
                    width: 100%;
                    padding-top: 1rem;
                    .footer-col-content {
                        width: 100%;
                    }
                }
                .footer-col:first-child {
                    border-left: none;
                    border-top: 1px solid var(--black);
                }
                .footer-col:last-child {
                    border-right: none;
                    border-bottom: 1px solid var(--black);
                }
                .footer-col:not(:last-child) {
                    border-right: none;
                    border-bottom: 1px solid var(--black);
                }
            }
        }
    }

</style>
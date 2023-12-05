<template>
    <MainHeader />
    <div class="home">
        <div class="home-columns">
            <div class="home-left">
                <h1>Witaj w <span>Little-Fashion</span> - Twoim magicznym sklepie pełnym uroczego <span>stylu dla lalek!</span></h1>
                <p>Oferujemy szeroki wybór niezwykłych ubranek i akcesoriów dla lalek typu Baby Born oraz nie tylko.</p>
                <p>Nasze ubranka dla lalek są stworzone z najwyższą dbałością o detale, zapewniając im wyjątkowy styl i elegancję.</p>
                <div class="home-button">
                    <router-link to="/sklep/ubranka-dla-lalek/1">
                        <button class="home-btn">
                            Zobacz nasze produkty
                            <div><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/></svg></div>
                        </button>
                    </router-link>
                </div>
            </div>
            <div class="home-right">
                <img src="../assets/1.png" alt="">
            </div>
        </div>
    </div>
    <div class="aboutus">
        <div class="aboutus-columns">
            <div class="aboutus-left">
                <img src="../assets/2.png" alt="">
            </div>
            <div class="aboutus-right">
                <h3>Poznaj naszą historię</h3>
                <h2>O naszej firmie</h2>
                <hr>
                <p>Nasza firma jest obecna na rynku już od ponad dekady i jesteśmy pełni pasji w tworzeniu wyjątkowych ubranek dla lalek, turbanów oraz scrunchie. Nasza działalność wywodzi się z miłości do twórczości i pięknych detali.</p>
                <p>Każda kolekcja, którą proponujemy, jest starannie projektowana i wykonywana z największą starannością, z uwzględnieniem najdrobniejszych szczegółów. Nasze ubranka dla lalek wyróżniają się wyjątkowością, przy jednoczesnym celu tworzenia pięknych wspomnień oraz wyjątkowych doznań podczas zabawy.</p>
                <p>Naszym priorytetem jest trzymanie się najnowszych trendów w modzie. Regularnie uzupełniamy naszą ofertę o świeże wzory i style, aby spełniać oczekiwania naszych klientów.</p>
                <div class="aboutus-button">
                    <router-link to="/o-naszej-firmie">
                        <button class="aboutus-btn">
                            Czytaj więcej
                            <div><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/></svg></div>
                        </button>
                    </router-link>
                    </div>
            </div>
        </div>
    </div>
    <div class="materials">
        <div class="materials-columns">
            <div class="materials-left">
                <h3>Z czego tworzymy?</h3>
                <h2>Nasze materiały</h2>
                <hr>
                <p>Nasze ubranka dla lalek, turbany oraz scrunchies to wyjątkowe produkty, które wyróżniają się ręcznym wykonaniem i dbałością o szczegóły. Każdy element jest starannie szyty, aby zapewnić najwyższą jakość.</p>
                <p>Produkty zostają specjalnie zaprojektowane z myślą o lalkach w wymiarach 43 cm, zapewniając idealne dopasowanie i styl. Co więcej, używamy materiałów najwyższej jakości, z których 92% stanowi bawełna i 8% elastan.</p>
                <p>Pasja, którą wkładamy w tworzenie ubranek oraz troska o każdy detal sprawiają, że nasze produkty są wyjątkowe i spełniają oczekiwania nawet najbardziej wymagających klientów.</p>
                <div class="materials-button">
                    <router-link to="/artykul/baby-born-elegance">
                        <button class="materials-btn">
                            Czytaj więcej
                            <div><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/></svg></div>
                        </button>
                    </router-link>
                </div>
            </div>
            <div class="materials-right">
                <img src="../assets/3.png" alt="">
            </div>
        </div>
    </div>
    <div class="newsletter">
        <div class="newsletter-columns">
            <div class="newsletter-left">
                <h3>Odbierz 10% zniżki na pierwsze zakupy</h3>
                <h2>Zapisz się do Newslettera</h2>
                <h4>W każdej chwili możesz zrezygnować, rabat jest jednorazowy i obejmuje tylko produkty, które są nieprzecenione.</h4>
            </div>
            <div class="newsletter-right">
                <div class="newsletter-form">
        <div class="newsletter-top">
            <input v-model="email" type="email" placeholder="Wprowadź adres e-mail" required>
            <div class="newsletter-button">
                <button class="newsletter-btn" @click="subscribeNewsletter" :disabled="!isCheckboxChecked">
                    Dołącz
                    <div><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/></svg></div>
                </button>
            </div>
        </div>
        <div class="newsletter-bottom">
            <input type="checkbox" v-model="isCheckboxChecked">
            <p>Zapoznałem/am się z <a href="#">polityką prywatności</a> i zgadzam się na otrzymywanie informacji handlowych drogą elektroniczną.</p>
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
import axios from 'axios'

export default {
    components: {
        MainHeader,
        MainFooterTop,
        MainFooterBottom,
    },
    data() {
        return {
            email: '',
            isCheckboxChecked: false,
        };
    },
    computed: {
        // Disable button when the checkbox is not checked
        isButtonDisabled() {
            return !this.isCheckboxChecked;
        },
    },
    methods: {
        subscribeNewsletter() {
        if (this.isCheckboxChecked) {
            axios.post('http://localhost:8000/api/newsletter', { email: this.email })
                .then(response => {
                    alert("Dziękuje za zasubskrybowanie newslettera, wkrótce otrzymasz kod rabatowy na podany adres  E-mail.")
                })
                .catch(error => {
                });
        }
    },
    },
    mounted() {
    // Sprawdź, czy użytkownik jest zalogowany po załadowaniu komponentu
    this.isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';

    // Pobierz rolę użytkownika z localStorage
    this.userRole = localStorage.getItem('userRole') || '';
    this.userName = localStorage.getItem('userName') || '';

    // Wyświetl wynik w konsoli
    if (this.isLoggedIn) {
        console.log('Użytkownik jest zalogowany');
        console.log('Rola użytkownika:', this.userRole);
        console.log('nazwa uzytkownika:', this.userName);
    } else {
        console.log('Użytkownik nie jest zalogowany');
    }
},



}

</script>
  
<style lang="scss" scoped>
.home {
    background: url('../assets/background-elements/1.png');
    background-repeat: no-repeat;
    background-position: bottom;
    .home-columns {
        display: flex;
        width: 100%;
        justify-content: space-between;
        padding-top: 10.5rem;
        padding-bottom: 5.5rem;
        align-items: center;
        background-size: contain;
        .home-left {
            width: 46%;
            margin-left: 3rem;
            h1 {
                font-size: 40px;
                margin-bottom: 2rem;
                color: var(--black);
                span {
                    color: var(--dark-beige);
                }
            }
            p {
                font-size: 24px;
                color: var(--black);
                margin-bottom: 2rem;
            }
            .home-button {
                a {
                    text-decoration: none;
                    .home-btn {
                        width: 40%;
                        height: 40px;
                        display: flex;
                        justify-content: space-between;
                        padding-left: 1rem;
                        align-items: center;
                        font-size: 20px;
                        border: 1px solid var(--dark-beige);
                        background-color: var(--dark-beige);
                        color: var(--white);
                        font-weight: 400;
                        cursor: pointer;
                        transition: 0.5s;
                        div {
                            background-color: var(--transparent);
                            height: 40px;
                            width: 40px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-left: 1px solid rgb(255, 255, 255, 0.5);
                            transition: 0.5s;
                            svg {
                                stroke: var(--white);
                                background-color: var(--transparent);
                                transition: 0.5s;
                            }
                        }
                        &:hover {
                            background-color: var(--white);
                            color: var(--dark-beige);
                            div {
                                background-color: var(--white);
                                border-top: 1px solid var(--dark-beige);
                                border-bottom: 1px solid var(--dark-beige);
                                border-left: 1px solid var(--dark-beige);
                                svg {
                                    background-color: var(--transparent);
                                    stroke: var(--dark-beige);
                                }
                            }
                        }
                    }
                }
            }
        }
        .home-right {
            width: 48%;
            height: 100%;
            img {
                display: block;
                width: 100%;
            }
        }
    }
}

.aboutus {
    padding-top: 5.3rem;
    padding-bottom: 5.3rem;
    .aboutus-columns {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        align-items: center;
        justify-content: space-around;
        .aboutus-left {
            width: 30%;
            img {
                display: block;
                width: 100%;
            }
        }
        .aboutus-right {
            width: 50%;
            h3 {
                font-size: 32px;
                margin-bottom: 1rem;
                color: var(--dark-beige);
            }
            h2 {
                font-size: 40px;
                color: var(--black);
                margin-bottom: 1rem;
            }
            hr {
                background-color: var(--dark-beige);
                height: 3px;
                border: none;
                border-radius: 10px;
                width: 150px;
                margin-bottom: 1rem;
            }
            p {
                font-size: 24px;
                margin-bottom: 1rem;
                color: var(--black);
            }
            .aboutus-button {
                a {
                    text-decoration: none;
                    .aboutus-btn {
                        width: 40%;
                        height: 40px;
                        display: flex;
                        justify-content: space-between;
                        padding-left: 1rem;
                        align-items: center;
                        font-size: 20px;
                        border: 1px solid var(--dark-beige);
                        background-color: var(--dark-beige);
                        color: var(--white);
                        font-weight: 400;
                        cursor: pointer;
                        transition: 0.5s;
                        text-align: center;
                        div {
                            background-color: var(--transparent);
                            height: 40px;
                            width: 40px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-left: 1px solid rgb(255, 255, 255, 0.5);
                            transition: 0.5s;
                            svg {
                                stroke: var(--white);
                                background-color: var(--transparent);
                                transition: 0.5s;
                            }
                        }
                        &:hover {
                            background-color: var(--white);
                            color: var(--dark-beige);
                            div {
                                background-color: var(--white);
                                border-top: 1px solid var(--dark-beige);
                                border-bottom: 1px solid var(--dark-beige);
                                border-left: 1px solid var(--dark-beige);
                                svg {
                                    background-color: var(--transparent);
                                    stroke: var(--dark-beige);
                                }
                            }
                    }
                }
                }
            }
        }
    }
}

.materials {
    padding-bottom: 5.3rem;
    .materials-columns {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        .materials-left {
            width: 50%;
            h3 {
                font-size: 32px;
                margin-bottom: 1rem;
                color: var(--dark-beige);
            }
            h2 {
                font-size: 40px;
                color: var(--black);
                margin-bottom: 1rem;
            }
            hr {
                background-color: var(--dark-beige);
                height: 3px;
                border: none;
                border-radius: 10px;
                width: 150px;
                margin-bottom: 1rem;
            }
            p {
                font-size: 24px;
                margin-bottom: 1rem;
                color: var(--black);
            }
            .materials-button {
                a {
                    text-decoration: none;
                    .materials-btn {
                        width: 40%;
                        height: 40px;
                        display: flex;
                        justify-content: space-between;
                        padding-left: 1rem;
                        align-items: center;
                        font-size: 20px;
                        border: 1px solid var(--dark-beige);
                        background-color: var(--dark-beige);
                        color: var(--white);
                        font-weight: 400;
                        cursor: pointer;
                        transition: 0.5s;
                        text-align: center;
                        div {
                            background-color: var(--transparent);
                            height: 40px;
                            width: 40px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-left: 1px solid rgb(255, 255, 255, 0.5);
                            transition: 0.5s;
                            svg {
                                stroke: var(--white);
                                background-color: var(--transparent);
                                transition: 0.5s;
                            }
                        }
                        &:hover {
                            background-color: var(--white);
                            color: var(--dark-beige);
                            div {
                                background-color: var(--white);
                                border-top: 1px solid var(--dark-beige);
                                border-bottom: 1px solid var(--dark-beige);
                                border-left: 1px solid var(--dark-beige);
                                svg {
                                    background-color: var(--transparent);
                                    stroke: var(--dark-beige);
                                }
                            }
                        }
                    }
                }
            }
        }
        .materials-right {
            width: 45%;
            img {
                display: block;
                width: 100%;
            }
        }
    }
}

.newsletter {
    padding-bottom: 5.3rem;
    padding-top: 5.3rem;
    background-color: var(--light-beige);
    .newsletter-columns {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        .newsletter-left {
            width: 48%;
            h2 {
                font-size: 40px;
                color: var(--black);
                margin-bottom: 2rem;
            }
            h3 {
                font-size: 24px;
                margin-bottom: 2rem;
                color: var(--black);
                font-weight: 400;
            }
            h4 {
                font-size: 20px;
                color: var(--black);
                font-weight: 400;
            }
        }
        .newsletter-right {
            width: 48%;
            .newsletter-form {
                .newsletter-top {
                    display: flex;
                    margin-bottom: 2rem;
                    input {
                        width: 80%;
                        height: 40px;
                        border: none;
                        background-color: var(--transparent);
                        border-bottom: 2px solid var(--black);
                        font-size: 20px;
                    }
                    .newsletter-button {
                            .newsletter-btn {
                                width: 200px;
                            height: 40px;
                            display: flex;
                            justify-content: space-between;
                            padding-left: 1rem;
                            align-items: center;
                            font-size: 20px;
                            border: 1px solid var(--black);
                            background-color: var(--black);
                            color: var(--white);
                            font-weight: 400;
                            cursor: pointer;
                            transition: 0.5s;
                            text-align: center;
                            div {
                                background-color: var(--transparent);
                                height: 40px;
                                width: 40px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                border-left: 1px solid rgb(255, 255, 255, 0.5);
                                transition: 0.5s;
                                svg {
                                    stroke: var(--white);
                                    background-color: var(--transparent);
                                    transition: 0.5s;
                                }
                            }
                            &:hover {
                                background-color: var(--light-beige);
                                color: var(--black);
                                div {
                                    background-color: var(--light-beige);
                                    border-top: 1px solid var(--black);
                                    border-bottom: 1px solid var(--black);
                                    border-left: 1px solid var(--black);
                                    svg {
                                        background-color: var(--transparent);
                                        stroke: var(--black);
                                    }
                                }
                            }
                        }
                    }
                }
                .newsletter-bottom {
                    display: flex;
                    input {
                        width: 20px;
                    }
                    input[type="checkbox"] {
                        cursor: pointer;
                        accent-color: var(--black);
                    }
                    p {
                        margin-left: 1rem;
                        font-size: 20px;
                        a {
                            color: var(--black);
                            text-underline-offset: 4px;
                        }
                    }
                }
            }
        }
    }
}

@media screen and (max-width: 1600px) {
    .home {
        .home-columns {
            .home-left {
                width: 50%;
                h1 {
                    font-size: 32px;
                }
                .home-button {
                    a {
                        .home-btn {
                            width: 300px;
                        }
                    }
                }
            }
            .home-right {
                width: 40%;
            }
        }
    }
    .aboutus {
        .aboutus-columns {
            .aboutus-left {
                width: 20%;
            }
            .aboutus-right {
                width: 70%;
                h2 {
                    font-size: 32px;
                }
                h3 {
                    font-size: 24px;
                }
                p {
                    font-size: 20px;
                }
                .aboutus-button {
                    a {
                        .aboutus-btn {
                            width: 300px;
                        }
                    }
                }
            }
        }
    }
    .materials {
        .materials-columns {
            .materials-right {
                width: 45%;
            }
            .materials-left {
                width: 50%;
                h2 {
                    font-size: 32px;
                }
                h3 {
                    font-size: 24px;
                }
                p {
                    font-size: 20px;
                }
                .materials-button {
                    a {
                        .materials-btn {
                            width: 300px;
                        }
                    }
                }
            }
        }
    }
    .newsletter {
        .newsletter-columns {
            .newsletter-left {
                h2 {
                    font-size: 32px;
                }
                h3 {
                    font-size: 20px;
                }
            }
        }
    }
}

@media screen and (max-width: 1024px) {
    .home {
        background-size: contain;
        .home-columns {
            flex-direction: column;
            padding-top: 7rem;
            padding-bottom: 2rem;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .home-left {
                width: 100%;
                margin-left: 0;
                .home-button {
                    margin-bottom: 2rem;
                }
            }
            .home-right {
                width: 70%;
            }
        }
    }
    .aboutus {
        padding-top: 2rem;
        padding-bottom: 2rem;
        .aboutus-columns {
            flex-direction: column;
            width: 95%;
                .aboutus-left {
                    width: 50%;
                    margin-bottom: 2rem;
                }
                .aboutus-right {
                    width: 100%;
                }
        }
    }
    .materials {
        padding-top: 0;
        padding-bottom: 2rem;
        .materials-columns {
            flex-direction: column;
            width: 95%;
                .materials-right {
                    width: 80%;
                }
                .materials-left {
                    margin-bottom: 2rem;
                    width: 100%;
                }
        }
    }
    .newsletter {
        padding-top: 2rem;
        padding-bottom: 2rem;
        .newsletter-columns {
            flex-direction: column;
            .newsletter-left {
                width: 100%;
                padding-bottom: 1rem;
                h3 {
                    margin-bottom: 1rem;
                }
                h2 {
                    margin-bottom: 1rem;
                }
            }
            .newsletter-right {
                width: 100%;
                .newsletter-form {
                    .newsletter-top {
                        margin-bottom: 1rem;
                    }
                }
            }
        }
    }
}

@media screen and (max-width: 468px) {
    .home {
        .home-columns {
            padding-top: 6rem;
            .home-left {
                h1 {
                    font-size: 24px;
                    margin-bottom: 1rem;
                }
                p {
                    font-size: 16px;
                    margin-bottom: 1rem;
                }
                .home-button {
                    margin-bottom: 1rem;
                    a {                        
                        .home-btn {
                            width: 100%;
                            font-size: 16px;
                        }
                    }
                }
            }
        }
    }
    .aboutus {
        .aboutus-columns {
            .aboutus-right {
                h3 {
                    font-size: 20px;
                }
                h2 {
                    font-size: 24px;
                }
                p {
                    font-size: 16px;
                }
                .aboutus-button {
                    a {
                        .aboutus-btn {
                            width: 100%;
                            font-size: 16px;
                        }
                    }
                }
            }
        }
    }
    .materials {
        .materials-columns {
            .materials-left {
                h3 {
                    font-size: 20px;
                }
                h2 {
                    font-size: 24px;
                }
                p {
                    font-size: 16px;
                }
                .materials-button {
                    a {
                        .materials-btn {
                            width: 100%;
                            font-size: 16px;
                        }
                    }
                }
            }
        }
    }
    .newsletter {
        .newsletter-columns {
            .newsletter-left {
                h2 {
                    font-size: 24px;
                }
                h3 {
                    font-size: 16px;
                }
                h4 {
                    font-size: 16px;
                }
            }
            .newsletter-right {
                .newsletter-form {
                    .newsletter-top {
                        flex-direction: column;
                        input {
                            width: 100%;
                            height: 30px;
                            font-size: 16px;
                        }
                        .newsletter-button {
                            .newsletter-btn {
                                margin-top: 1rem;
                                width: 100%;
                                height: 30px;
                                font-size: 16px;
                            }
                        }
                    }
                    .newsletter-bottom {
                        p {
                            font-size: 16px;
                        }
                    }
                }
            }
        }
    }
}
</style>
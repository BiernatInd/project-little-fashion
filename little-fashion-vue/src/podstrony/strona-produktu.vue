<template>
    <MainHeader />
    <div class="product-page">
        <div class="product-page-content">
            <div class="product-page-heading">
               <p v-if="product">Strona główna / {{product.kategoria}}  / {{ product.nazwa}}</p>
            </div>
            <div class="product-page-columns">
                <div class="product-page-left">
                    <div class="product-page-img-top">
                        <img :src="selectedImage" alt="">
        </div>
        <div class="product-page-img-bottom">
             <img v-for="(image, index) in productImages" :key="index" :src="image" @click="changeImage(index)" alt="">
        </div>
                </div>
                <div class="product-page-right">
                    <h1 v-if="product">{{ product.nazwa }}</h1>
                    <h2 v-if="product">{{ product.kategoria }}</h2>
                    <img src="../assets/8.png" alt="">
                    <h3 class="price" :class="{ 'active': product.cena_promocyjna }" v-if="product">{{ product.cena }}</h3>
                     <h3 class="promoted-price" :class="{ 'active': product.cena_promocyjna }" v-if="product">{{ product.cena_promocyjna}}</h3>
                     <div class="availability" v-if="product && product.stan_magazynowy > 0">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="10" cy="10" r="9" stroke="#33363F" stroke-width="2"/>
                            <path d="M6 10L9 13L14 7" stroke="#33363F" stroke-width="2"/>
                        </svg>
                        <h4>Dostępny w magazynie</h4>
                    </div>
                    <div class="availability" v-else>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="10" r="9" stroke="#33363F" stroke-width="2"/>
                        <path d="M7 13L13 7" stroke="#33363F" stroke-width="2"/>
                        <path d="M13 13L7 7" stroke="#33363F" stroke-width="2"/>
                    </svg>

                        <h4>Brak na stanie magazynowym</h4>
                    </div>
                    <div class="magazine-quantity">
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 19V11M8 19L1.83752 14.5982C1.42695 14.305 1.22166 14.1583 1.11083 13.943C1 13.7276 1 13.4753 1 12.9708V6M8 19L14.1625 14.5982C14.573 14.305 14.7783 14.1583 14.8892 13.943C15 13.7276 15 13.4753 15 12.9708V6M8 11L1 6M8 11L15 6M1 6L6.83752 1.83034C7.39886 1.42938 7.67953 1.2289 8 1.2289C8.32047 1.2289 8.60114 1.42938 9.16248 1.83034L15 6" stroke="#33363F" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                        <h4 v-if="product && product.stan_magazynowy !== undefined">Ilość sztuk w magazynie: {{ product.stan_magazynowy }}</h4>
                    </div>
                    <div class="description">
                        <p>Ręcznie szyte ubranko dla lalki Baby Born to wyjątkowy dodatek, który doda uroku i stylu do zabawy z Twoją lalką. Każde ubranko jest starannie wykonane z najwyższej jakości materiałów, aby zapewnić trwałość.</p>
                        <p>Podczas tworzenia tego ubranka zwracaliśmy szczególną uwagę na trwałość i jakość materiałów. Wykorzystaliśmy wysokiej jakości tkaniny, które są odporne na ścieranie i łatwe w czyszczeniu. Naszym celem było stworzenie ubranka, które będzie bardziej wytrzymałe, aby sprostać intensywnej zabawie dziecka z lalką.</p>
                    </div>
                    <div class="product-page-button">
                        <button class="product-page-btn"  @click="addToCartAndActivateShoppingBag(product)"  :disabled="product && product.stan_magazynowy === 0">
                            Dodaj do koszyka
                            <div>
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.37988 10.4121L6.37988 5.58816C6.37988 3.05438 8.43392 1.00035 10.9677 1.00035V1.00035C13.5015 1.00035 15.5555 3.05438 15.5555 5.58816L15.5555 10.4121" stroke-linecap="round"/>
                                <path d="M1.49283 10.5589C1.63456 8.81437 1.70543 7.9421 2.27984 7.41245C2.85426 6.88281 3.7294 6.88281 5.47969 6.88281H16.4545C18.2048 6.88281 19.08 6.88281 19.6544 7.41245C20.2288 7.9421 20.2997 8.81437 20.4414 10.5589L21.114 18.8385C21.1963 19.8503 21.2374 20.3562 20.9403 20.6783C20.6433 21.0005 20.1357 21.0005 19.1206 21.0005H2.81361C1.79847 21.0005 1.29091 21.0005 0.99389 20.6783C0.696872 20.3562 0.737973 19.8503 0.820174 18.8385L1.49283 10.5589Z" />
                            </svg>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-description">
        <div class="product-description-content">
            <div class="product-description-top">
                <h2>Opis produktu</h2>
            </div>
            <div class="product-description-bottom">
                <p>Ręcznie szyte ubranko dla lalki Baby Born to doskonały wybór dla wszystkich dzieci, które kochają zabawę lalkami i pragną dodać im jeszcze więcej stylu. Jego unikalny design, doskonałe dopasowanie, trwałość i wysoka jakość sprawiają, że jest to ubranko, które będzie służyć Twojej lalce przez długi czas. Daj swojej lalce Baby Born szansę na nową modową przygodę dzięki temu pięknie wykonanemu ubranku!</p>
                <p>Ubranka są tworzone na lalkę 43cm.</p>
                <p>92% bawełna, 8% elastan.</p>
                <p>Układ wzoru może się różnić w zależności od wycięcia.</p>
                <p>Kolor może się różnić w zależności od rodzaju wyświetlacza.</p>
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
import { mapState, mapActions } from 'vuex';

import axios from 'axios'

export default {
    components: {
        MainHeader,
        MainFooterTop,
        MainFooterBottom
    },
    data() {
        return {
            product: null,
            productImages: [],
            selectedImage: null,
        };
      },
    methods: {
        changeImage(index) {
            // Sprawdź, czy productImages jest zdefiniowane
            if (this.productImages && this.productImages.length > index) {
                // Zmiana obrazu po kliknięciu
                this.selectedImage = this.productImages[index];
            }
        },
        fetchProduct() {
            const productId = this.$route.params.id;

            axios.get(`http://localhost:8000/api/produkty/${productId}`)
                .then(response => {
                    this.product = response.data.product;

                    // Oczekaj na załadowanie głównego obrazu, zanim utworzysz tablicę productImages
                    this.$nextTick(() => {
                        this.productImages = [
                            this.product.zdjecie_produktu_1,
                            this.product.zdjecie_produktu_2,
                            this.product.zdjecie_produktu_3,
                        ];
                        this.selectedImage = this.product.zdjecie_produktu_1; // Ustaw domyślny obraz na główne zdjęcie
                    });

                    console.log('Dane produktu:', this.product);
                })
                .catch(error => {
                    console.error('Błąd pobierania produktu', error);
                });
        },
    ...mapActions(['addToCart', 'setShoppingBagActive']),
    addToCartAndActivateShoppingBag(product) {
    // Call the addToCart action directly
    this.addToCart(product);
       this.setShoppingBagActive(true);
},
    },
    mounted() {
        // Pobieranie produktu po załadowaniu komponentu
        this.fetchProduct();
      },
}
</script>
  
<style lang="scss" scoped>
.product-page {
    padding-top: 7rem;
    padding-bottom: 2rem;
    .product-page-content {
        width: 75%;
        margin-left: auto;
        margin-right: auto;
        .product-page-heading {
            font-size: 20px;
            margin-bottom: 2rem;
        }
        .product-page-columns {
            display: flex;
            justify-content: space-between;
            .product-page-left {
                width: 20%;
                .product-page-img-top {
                    margin-bottom: 2rem;
                    img {
                        display: block;
                        border-radius: 10px;
                        width: 290px;
                        height: 480px;
                    }
                }
                .product-page-img-bottom {
                    display: flex;
                    justify-content: space-between;
                    img {
                        cursor: pointer;
                        width: 80px;
                        height: 80px;
                        display: block;
                        border-radius: 10px;
                    }
                }
            }
            .product-page-right {
                width: 75%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                h1 {
                    font-size: 32px;
                    color: var(--black);
                    font-weight: 500;
                }
                h2 {
                    font-size: 24px;
                    color: var(--black);
                    font-weight: 400;
                }
                img {
                    width: 125px;
                }
                .promoted-price {
                    font-size: 24px;
                    font-weight: 400;
                    display: none;
                    &.active {
                        display: block;
                    }
                }
                .price {
                    font-weight: 400;
                    font-size: 24px;
                    &.active {
                        text-decoration: line-through;
                    }
                }
                .availability {
                    display: flex;
                    align-items: center;
                    svg {
                        margin-right: 1rem;
                    }
                    h4 {
                        font-size: 24px;
                        font-weight: 400;
                    }
                }
                .magazine-quantity {
                    display: flex;
                    align-items: center;
                    svg {
                        margin-right: 1rem;
                        font-weight: 400;
                    }
                    h4 {
                        font-size: 24px;
                        font-weight: 400;
                    }
                }
                .description {
                    p {
                        font-size: 24px;
                        margin-bottom: 1rem;
                    }
                }
                .product-page-button {
                    .product-page-btn {
                        width: 280px;
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
    }
}

.product-description {
    .product-description-content {
        .product-description-top {
            padding-top: 1rem;
            padding-bottom: 1rem;
            width: 75%;
            margin-left: auto;
            margin-right: auto;
            border-top: 1px solid var(--dark-beige);
            border-bottom: 1px solid var(--dark-beige);
            margin-bottom: 2rem;
            h2 {
                font-size: 32px;
                font-weight: 400;
            }
        }
        .product-description-bottom {
            width: 75%;
            margin-left: auto;
            margin-right: auto;
            p {
                margin-bottom: 1rem;
                font-size: 24px;
            }
        }
    }
}

@media screen and (max-width: 1600px) {
    .product-page {
        .product-page-content {
            width: 95%;
        }
    }
    .product-description {
        .product-description-content {
            .product-description-top {
                width: 95%;
            }
            .product-description-bottom {
                width: 95%;
            }
        }
    }
}

@media screen and (max-width: 1250px) {
    .product-page {
        padding-top: 7rem;
        padding-bottom: 2rem;
        .product-page-content {
            .product-page-columns {
                flex-direction: column;
                .product-page-left {
                    width: 40%;
                    margin-bottom: 2rem;
                }
                .product-page-right {
                    h1 {
                        margin-bottom: 1rem;
                    }
                    h2 {
                        margin-bottom: 1rem;
                        font-size: 20px;
                    }
                    img {
                        margin-bottom: 1rem;
                    }
                    .promoted-price {
                        margin-bottom: 1rem;
                        font-size: 20px;
                    }
                    .price {
                        margin-bottom: 1rem;
                        font-size: 20px;
                    }
                    .availability {
                        margin-bottom: 1rem;
                        h4 {
                            font-size: 20px;
                        }
                    }
                    .magazine-quantity {
                        margin-bottom: 1rem;
                        h4 {
                            font-size: 20px;
                        }
                    }
                    .description {
                        p {
                            margin-bottom: 1rem;
                            font-size: 20px;
                        }
                    }
                }
            }
        }
    }
    .product-description {
        .product-description-content {
            .product-description-bottom {
                p {
                    font-size: 20px;
                }
            }
        }
    }
}

@media screen and (max-width: 468px) {
    .product-page {
        .product-page-content {
            .product-page-columns {
                .product-page-left {
                    width: 60%;
                    .product-page-img-top {
                        img {
                            width: 200px;
                            height: 300px;
                        }
                    }
                    .product-page-img-bottom {
                        img {
                            width: 60px;
                            height: 60px;
                        }
                    }
                }
                .product-page-right {
                    width: 100%;
                    h1 {
                        font-size: 24px;
                    }
                    h2 {
                        font-size:20px;
                    }
                    .price {
                        font-size: 20px;
                    }
                    .promoted-price {
                        font-size: 20px;
                    }
                    .availability {
                        margin-bottom: 1rem;
                        h4 {
                            font-size:20px;
                        }
                    }
                    .magazine-quantity {
                        margin-bottom: 1rem;
                        h4 {
                            font-size:20px;
                        }
                    }
                    .description {
                        p {
                            margin-bottom: 1rem;
                            font-size: 16px;
                        }
                    }
                    .product-page-button {
                        .product-page-btn {
                            font-size: 16px;
                            width: 100%;
                        }
                    }
                }
            }
        }
    }
    .product-description {
        .product-description-content {
            .product-description-top {
                h2 {
                    font-size: 24px;
                }
            }
            .product-description-bottom {
                p {
                    font-size: 16px;
                }
            }
        }
    }
}
</style>
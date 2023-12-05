<template>
    <MainHeader />
    <div class="shopping-bag">
        <div class="shopping-bag-content">
            <div class="shopping-bag-heading">
                <div class="shopping-bag-top">
                    <h2>Kontynuuj zamówienie</h2>
                </div>
                <div class="shopping-bag-mid">
                    <div class="shopping-bag-left">
                        <h1>Koszyk</h1>
                    </div>
                    <div class="shopping-bag-right">
                        <p @click="clearCart">Wyczyść koszyk</p>
                        <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.14233 15.2188L8.14233 11.6972" stroke-linecap="round"/>
                            <path d="M13.7118 15.2188L13.7118 11.6972" stroke-linecap="round"/>
                            <path d="M0.901855 5.82812H20.9522V5.82812C19.165 5.82812 18.2714 5.82812 17.6967 6.35878C17.6577 6.39477 17.6202 6.4323 17.5842 6.47128C17.0535 7.04594 17.0535 7.93956 17.0535 9.72681V17.0883C17.0535 18.9739 17.0535 19.9168 16.4678 20.5025C15.882 21.0883 14.9392 21.0883 13.0535 21.0883H8.80054C6.91492 21.0883 5.97211 21.0883 5.38633 20.5025C4.80054 19.9168 4.80054 18.9739 4.80054 17.0883V9.72681C4.80054 7.93956 4.80054 7.04594 4.26989 6.47128C4.23389 6.4323 4.19636 6.39477 4.15738 6.35878C3.58273 5.82812 2.6891 5.82812 0.901855 5.82812V5.82812Z" stroke-linecap="round"/>
                            <path d="M8.14224 2.30696C8.14224 2.30696 8.6992 1.13281 10.927 1.13281C13.1548 1.13281 13.7118 2.30667 13.7118 2.30667" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
                <div class="shopping-bag-bottom">
                    <hr>
                </div>
            </div>
            <div class="shopping-bag-cart">
                <div class="shopping-bag-cart-left">
                    <div class="shopping-bag-table">
                        <div class="shopping-bag-table-content" v-for="(product, index) in addedProducts" :key="index">
                            <div class="shopping-bag-table-left">
                                <img :src="product.zdjecie_produktu_1 || 'Brak zdjęcia'" alt="">
                                <p>{{ product.nazwa }}</p>
                            </div>
                            <div class="shopping-bag-table-right">
                                <p>Cena: {{ product.cena }} zł</p>
                                <p class="quantity" :class="{ 'active': isQuantityActive }">Ilość: {{ product.quantity }}</p>
                                <input v-model="product.quantity" type="number" class="input-number" min="1" :max="product.stan_magazynowy" @input="updateQuantity(product)" :class="{ 'active': isInputActive }"/>
                                <div class="shopping-bag-icons">
                                    <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg" @click="removeProductFromCart">
                                        <path d="M8.14233 15.2188L8.14233 11.6972" stroke-linecap="round"/>
                                        <path d="M13.7118 15.2188L13.7118 11.6972" stroke-linecap="round"/>
                                        <path d="M0.901855 5.82812H20.9522V5.82812C19.165 5.82812 18.2714 5.82812 17.6967 6.35878C17.6577 6.39477 17.6202 6.4323 17.5842 6.47128C17.0535 7.04594 17.0535 7.93956 17.0535 9.72681V17.0883C17.0535 18.9739 17.0535 19.9168 16.4678 20.5025C15.882 21.0883 14.9392 21.0883 13.0535 21.0883H8.80054C6.91492 21.0883 5.97211 21.0883 5.38633 20.5025C4.80054 19.9168 4.80054 18.9739 4.80054 17.0883V9.72681C4.80054 7.93956 4.80054 7.04594 4.26989 6.47128C4.23389 6.4323 4.19636 6.39477 4.15738 6.35878C3.58273 5.82812 2.6891 5.82812 0.901855 5.82812V5.82812Z" stroke-linecap="round"/>
                                        <path d="M8.14224 2.30696C8.14224 2.30696 8.6992 1.13281 10.927 1.13281C13.1548 1.13281 13.7118 2.30667 13.7118 2.30667" stroke-linecap="round"/>
                                    </svg>
                                    <svg width="16" height="4" viewBox="0 0 16 4" fill="none" xmlns="http://www.w3.org/2000/svg" @click="toggleInputActive">
                                        <circle cx="8" cy="2" r="1" stroke="" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="2" cy="2" r="1" stroke="" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="14" cy="2" r="1" stroke="" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div v-if="addedProducts.length === 0" class="shopping-bag-table-content">
                            <p>Nie ma produktów w koszyku.</p>
                        </div>
                    </div>
                </div>
                <div class="shopping-bag-cart-right">
                    <div class="shopping-bag-table">
                        <div class="shopping-bag-top">
                            <p>Łączna kwota</p>
                            <p>{{ totalPrice }} zł</p>
                        </div>
                        <div class="shopping-bag-button">
                            <router-link :to="addedProducts.length > 0 ? '/strona-zamowienia' : ''">
  <button class="shopping-bag-btn" @click="goToOrderPage">
    Przejdź do dostawy
    <div>
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/>
      </svg>
    </div>
  </button>
</router-link>
                        </div>
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
import { mapState, mapActions } from 'vuex';

export default {
  components: {
    MainHeader,
    MainFooterTop,
    MainFooterBottom
  },
  data() {
    return {
      isInputActive: false,
      isQuantityActive: false,
    };
  },
  
  computed: {
    ...mapState(['addedProducts', 'totalPrice']),
  },
  methods: {
    toggleInputActive() {
      this.isInputActive = !this.isInputActive;
      this.isQuantityActive = !this.isQuantityActive;
    },
    updateQuantity(product) {
      console.log('Product data:', product);

      // Sprawdź czy wprowadzona wartość mieści się w zakresie od 1 do stan_magazynowy
      if (product.quantity < 1) {
        product.quantity = 1;
      } else if (product.stan_magazynowy !== undefined && product.quantity > product.stan_magazynowy) {
        console.log('Przekroczono dostępny stan magazynowy!');
        product.quantity = product.stan_magazynowy;
      }

      // Aktualizuj cenę łączną
      this.$store.commit('CALCULATE_TOTAL_PRICE');
      
      // Dodaj warunek sprawdzający, czy stan_magazynowy jest zdefiniowany
      if (product.stan_magazynowy !== undefined) {
        console.log('Stan magazynowy:', product.stan_magazynowy);
        
        // Możesz użyć wartości product.stan_magazynowy tutaj w kodzie
        // na przykład przypisz ją do zmiennej lub obiektu
        // const stanMagazynowy = product.stan_magazynowy;
      } else {
        console.log('Stan magazynowy niezdefiniowany.');
      }
    },
    removeProductFromCart() {
    // Assuming you have a selectedProduct data property representing the product to be removed
    const selectedProduct = this.addedProducts[0]; // Adjust this based on your logic

    if (selectedProduct) {
      this.$store.commit('REMOVE_FROM_CART', selectedProduct);

      // Update the total price after removal
      this.$store.commit('CALCULATE_TOTAL_PRICE');

      // Save updated data to localStorage
      localStorage.setItem('addedProducts', JSON.stringify(this.addedProducts));
      localStorage.setItem('totalPrice', this.totalPrice);
    }
},
clearCart() {
      // Wywołaj akcję clearCart z Vuex
      this.$store.dispatch('clearCart');

      // Opcjonalnie możesz zaktualizować dane w localStorage
      localStorage.removeItem('addedProducts');
      localStorage.removeItem('totalPrice');
    },

    goToOrderPage() {

    // Sprawdź, czy koszyk nie jest pusty
    if (this.addedProducts.length === 0) {
      alert('Nie ma produktów w koszyku.');
    } else {
      // Przejdź do podstrony "strona-zamowienia" tylko jeśli koszyk nie jest pusty
      this.$router.push('/strona-zamowienia');
    }
  },
}
};
</script>

  
<style lang="scss" scoped>
    .shopping-bag {
        .shopping-bag-content {
            padding-top: 7rem;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .shopping-bag-heading {
                .shopping-bag-top {
                    h2 {
                        font-size: 32px;
                        color: var(--dark-beige);
                        margin-bottom: 1rem;
                    }
                }
                .shopping-bag-mid {
                    display: flex;
                    justify-content: space-between;
                    .shopping-bag-right {
                        display: flex;
                        align-items: center;
                        justify-content: flex-end;
                        cursor: pointer;
                        svg {
                            stroke: var(--black);
                            transition: 0.5s;
                        }
                        p {
                            font-size: 24px;
                            margin-right: 1rem;
                            transition: 0.5s;
                        }
                        &:hover {
                            p {
                                color: var(--dark-beige);
                            }
                            svg {
                                stroke: var(--dark-beige);
                            }
                        }
                    }
                    .shopping-bag-left {
                        h1 {
                            font-size: 40px;
                            color: var(--black);
                            margin-bottom: 1rem;
                        }
                    }
                }
                .shopping-bag-bottom {
                    hr {
                        width: 150px;
                        height: 3px;
                        background-color: var(--dark-beige);
                        border: none;
                        border-radius: 10px;
                        margin-bottom: 2rem;
                    }
                }
            }
            .shopping-bag-cart {
                display: flex;
                justify-content: space-between;
                .shopping-bag-cart-left {
                    width: 70%;
                    .shopping-bag-table {
                        border: 1px solid var(--dark-beige);
                        border-radius: 10px;
                        .shopping-bag-table-content:not(:first-child) {
                            border-top: 1px solid var(--dark-beige);
                        }
                        .shopping-bag-table-content {
                            width: 95%;
                            margin-left: auto;
                            margin-right: auto;
                            padding-top: 1rem;
                            padding-bottom: 1rem;
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                            .shopping-bag-table-left {
                                display: flex;
                                align-items: center;
                                img {
                                    margin-right: 1rem;
                                    border-radius: 10px;
                                    width: 80px;
                                    height: 100px;
                                }
                                p {
                                    font-size: 20px;
                                }
                            }
                            .shopping-bag-table-right {
                                display: flex;
                                align-items: center;
                                p {
                                    font-size: 20px;
                                    margin-right: 2rem;
                                }
                                .quantity {
                                    &.active {
                                        display: none;
                                    }
                                }
                                .input-number {
                                    padding: 0.2rem;
                                    border: none;
                                    font-size: 16px;
                                    width: 46px;
                                    margin-right: 1rem;
                                    border: none;
                                    border-bottom: 1px solid var(--black);
                                    display: none;
                                    &.active {
                                        display: block;
                                    }
                                }
                                .shopping-bag-icons {
                                    display: flex;
                                    align-items: center;
                                    svg:nth-child(1) {
                                        margin-right: 2rem;
                                    }
                                    svg:nth-child(2) {
                                        position: relative;
                                        top: 2px;
                                        z-index: 0;
                                    }
                                    svg {
                                        user-select: none;
                                        cursor: pointer;
                                        transition: 0.5s;
                                        stroke: var(--black);
                                        &:hover {
                                            stroke: var(--dark-beige);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                .shopping-bag-cart-right {
                    width: 25%;
                    height: 100%;
                    border: 1px solid var(--dark-beige);
                    border-radius: 10px;
                    .shopping-bag-table {
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        padding-top: 1rem;
                        padding-bottom: 1rem;
                        p {
                            font-size: 20px;
                        }
                        .shopping-bag-top {
                            display: flex;
                            justify-content: space-between;
                            margin-bottom: 1rem;
                        }
                        .shopping-bag-button {
                            a {
                                text-decoration: none;
                                .shopping-bag-btn {
                        width: 100%;
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
        }
    }

    @media screen and (max-width: 1600px) {
        .shopping-bag {
            .shopping-bag-content {
                .shopping-bag-heading {
                    .shopping-bag-top {
                        h2 {
                            font-size: 24px;
                        }
                    }
                    .shopping-bag-mid {
                        .shopping-bag-left {
                            h1 {
                                font-size: 32px;
                            }
                        }
                        .shopping-bag-right {
                            p {
                                font-size: 24px;
                            }
                        }
                    }
                }
                .shopping-bag-cart {
                    .shopping-bag-cart-left {
                        width: 65%;
                    }
                    .shopping-bag-cart-right {
                        width: 30%;
                    }
                }
            }
        }
    }

        @media screen and (max-width: 1024px) {
        .shopping-bag {
            .shopping-bag-content {
                padding-top: 7rem;
                .shopping-bag-heading {
                    .shopping-bag-bottom {
                        hr {
                            width: 30%;
                        }
                    }
                }
                .shopping-bag-cart {
                    flex-direction: column;
                    .shopping-bag-cart-left {
                        width: 100%;
                        margin-bottom: 2rem;
                        .shopping-bag-table {
                            .shopping-bag-table-content {
                                flex-direction: column;
                                .shopping-bag-table-left {
                                    width: 100%;
                                    justify-content: space-between;
                                    text-align: end;
                                }
                                .shopping-bag-table-right {
                                    width: 100%;
                                    justify-content: flex-end;
                                }
                            }
                        }
                    }
                    .shopping-bag-cart-right {
                        width: 100%;
                    }
                }
            }
        }
    }


    @media screen and (max-width: 468px) {
        .shopping-bag {
            .shopping-bag-content {
                .shopping-bag-heading {
                    .shopping-bag-top {
                        h2 {
                            font-size: 20px;
                        }
                    }
                    .shopping-bag-mid {
                        .shopping-bag-left {
                            h1 {
                                font-size: 24px;
                            }
                        }
                        .shopping-bag-right {
                            p {
                                font-size: 20px;
                            }
                        }
                    }
                }
                .shopping-bag-cart {
                    .shopping-bag-cart-left {
                        .shopping-bag-table {
                            .shopping-bag-table-content {
                                .shopping-bag-table-left {
                                    flex-direction: column;
                                    text-align: left;
                                    display: block;
                                    img {
                                        margin-bottom: 1rem;
                                    }
                                    p {
                                        margin-bottom: 1rem;
                                    }
                                }
                                .shopping-bag-table-right {
                                    flex-direction: column;
                                    display: block;
                                    text-align: left;
                                    p {
                                        margin-bottom: 1rem;
                                    }
                                    .input-number {
                                        margin-bottom: 1rem;
                                    }
                                    .shopping-bag-icons {
                                        flex-direction: column;
                                        align-items: flex-start;
                                        svg:nth-child(1) {
                                            margin-right: 0rem;
                                        }
                                        svg:nth-child(2) {
                                            margin-top: 1rem;
                                            left: 5px;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    .shopping-bag-cart-right {
                        .shopping-bag-table {
                            .shopping-bag-button {
                                .shopping-bag-btn {
                                    font-size: 16px;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

</style>
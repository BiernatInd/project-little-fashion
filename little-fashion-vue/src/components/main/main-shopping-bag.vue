<template>
    <div class="shopping-bag" :class="{ active: shoppingBagActive, sticky: isBagSticky }">
        <div class="shopping-bag-content" :class="{ 'scrollable': addedProducts.length > maxVisibleItems }">
            <div class="shopping-bag-top">
                <div class="shopping-bag-main">
                    <p>Koszyk ({{ $store.getters.cartProducts.length }})</p>
                    <img src="../../assets/icons/6.svg" alt="" @click="removeActiveClass">
                </div>
               <div class="shopping-cart-mid">
                        <div class="shopping-bag-cart" v-for="product in addedProducts" :key="product.id"  v-if="addedProducts.length > 0">
                        <div class="shopping-bag-cart-left">
                            <img :src="getProductImage(product)" alt="">
                        </div>
                        <div class="shopping-bag-cart-right">
                            <div class="shopping-bag-cart-top">
                                <p>{{ product.nazwa }}</p>
                                <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg" @click="removeFromCart(product)">
                                    <path d="M8.14233 15.2188L8.14233 11.6972" stroke-linecap="round"/>
                                    <path d="M13.7118 15.2188L13.7118 11.6972" stroke-linecap="round"/>
                                    <path d="M0.901855 5.82812H20.9522V5.82812C19.165 5.82812 18.2714 5.82812 17.6967 6.35878C17.6577 6.39477 17.6202 6.4323 17.5842 6.47128C17.0535 7.04594 17.0535 7.93956 17.0535 9.72681V17.0883C17.0535 18.9739 17.0535 19.9168 16.4678 20.5025C15.882 21.0883 14.9392 21.0883 13.0535 21.0883H8.80054C6.91492 21.0883 5.97211 21.0883 5.38633 20.5025C4.80054 19.9168 4.80054 18.9739 4.80054 17.0883V9.72681C4.80054 7.93956 4.80054 7.04594 4.26989 6.47128C4.23389 6.4323 4.19636 6.39477 4.15738 6.35878C3.58273 5.82812 2.6891 5.82812 0.901855 5.82812V5.82812Z" stroke-linecap="round"/>
                                    <path d="M8.14224 2.30696C8.14224 2.30696 8.6992 1.13281 10.927 1.13281C13.1548 1.13281 13.7118 2.30667 13.7118 2.30667" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="shopping-bag-cart-bottom">
                                <p>{{ product.cena }}</p>
                                <p>x{{ product.quantity }}</p>
                            </div> 
                        </div>
                    </div>
                    <div class="shopping-bag-without-products" v-else>
                        <p>Brak produktów w koszyku</p>
                    </div>
                    <div class="shopping-bag-edit">
                        <router-link to="/strona-koszyka">Edytuj</router-link>
                    </div>
                </div>
            </div>
            <div class="shopping-bag-bottom">
                <div class="shopping-bag-top">
                    <p>Do zapłaty:</p>
                    <p>{{ totalPrice }} zł</p>
                </div>
                <div class="shopping-bag-button">
                    <router-link to="/strona-koszyka" @click="toggleShoppingBag">
                        <button class="shopping-bag-btn">
                            Przejdź do koszyka
                            <div><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/></svg></div>
                        </button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions, mapGetters } from 'vuex';

export default {
  computed: {
    ...mapState(['addedProducts', 'totalPrice', 'shoppingBagActive']),
    ...mapGetters(['cartProducts']),

    visibleProducts() {
      return this.addedProducts.slice(0, this.maxVisibleItems);
    },
  },
  data() {
      return {
        isBagSticky: false,
        maxVisibleItems: 5,
      }
    },
  methods: {
    ...mapActions(['removeFromCart', 'setShoppingBagActive']),
  toggleShoppingBag() {
    this.setShoppingBagActive(!this.shoppingBagActive);
  },
  getProductImage(product) {
    // Użyj odpowiedniego pola zdjęcia, np. zdjecie_produktu
    return product.hasOwnProperty('zdjecie_produktu_1') ? product.zdjecie_produktu_1 : '/default-image.jpg';
},
    removeActiveClass() {
      this.setShoppingBagActive(false);
      const shoppingBagElement = document.querySelector('.shopping-bag');
      if (shoppingBagElement) {
        shoppingBagElement.classList.remove('active');
      }
    },
    handleScroll() {
      const scrollY = window.scrollY;
      // Ustaw wysokość, po której chcesz dodać klasę "sticky"
      const scrollThreshold = 1;
      
      if (scrollY > scrollThreshold && !this.isBagSticky) {
        this.isBagSticky = true;
      } else if (scrollY <= scrollThreshold && this.isBagSticky) {
        this.isBagSticky = false;
      }
    },
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
  },
  destroyed() {
    window.removeEventListener('scroll', this.handleScroll);
  },
};
</script>

  
<style lang="scss" scoped>
    .shopping-bag {
        position: fixed;
        top: 52px;
        right: -100%;
        width: 400px;
        height: 100%;
        border-left: 1px solid rgb(42, 41, 40, 0.3);
        transition: 0.5s;
        background-color: var(--white);
        z-index: 998;

        &.active {
            right: 0;
        }
        &.sticky {
            top: 0;
            .shopping-bag-content {
                height: 100%;
            }
        }
        .shopping-bag-content {
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            height: calc(100% - 52px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: 0.5s;
            &.scrollable {
                overflow-y: auto;
            }
            .shopping-bag-top {
                .shopping-bag-main {
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    border-bottom: 1px solid rgb(42, 41, 40, 0.3);  
                    p {
                        font-size: 20px;
                        color: var(--black);
                    }
                    img {
                        cursor: pointer;
                        user-select: none;
                    }
                }
                .shopping-cart-mid {
                    .shopping-bag-cart {
                        display: flex;
                        justify-content: space-between;
                        padding-top: 1rem;
                        padding-bottom: 1rem;
                        border-bottom: 1px solid rgb(42, 41, 40, 0.3);
                        .shopping-bag-cart-left {
                            width: 20%;
                            img {
                                display: block;
                                width: 80px;
                                height: 100px;
                                border-radius: 5px;
                            }
                        }
                        .shopping-bag-cart-right {
                            display: flex;
                            flex-direction: column;
                            justify-content: space-between;
                            width: 70%;
                            .shopping-bag-cart-top {
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                
                                p {
                                    margin-right: 1rem;
                                }
                                svg {
                                    cursor: pointer;
                                    user-select: none;
                                    stroke: var(--black);
                                    transition: 0.5s;
                                    &:hover {
                                        stroke: var(--dark-beige);
                                    }
                                }
                            }
                            .shopping-bag-cart-bottom {
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                            }
                        }
                    }
                    .shopping-bag-without-products {
                        padding-top: 1rem;
                        padding-bottom: 1rem;
                        border-bottom: 1px solid rgb(42, 41, 40, 0.3);
                        p {
                            font-size: 16px;
                            color: var(--black);
                        }
                    }
                    .shopping-bag-edit {
                        display: flex;
                        justify-content: flex-end;
                        padding-top: 1rem;
                        margin-bottom: 1rem;
                        a {
                            color: var(--black);
                            text-underline-offset: 4px;
                            font-size: 16px;
                            transition: 0.5s;
                            &:hover {
                                color: var(--dark-beige);
                            }
                        }
                    }
                }
            }
            .shopping-bag-bottom {
                padding-bottom: 1rem;
                .shopping-bag-top {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 1rem;
                    p {
                        font-size: 20px;
                    }
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
                            font-size: 16px;
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

    @media screen and (max-width: 1024px) {
        .shopping-bag {
            width: 60%;
            top: 0px;
            height: 100%;
            .shopping-bag-content {
                height: 100%;
                .shopping-bag-top {
                    .shopping-cart-mid {
                        .shopping-bag-cart {
                            .shopping-bag-cart-left {
                                display: flex;
                                align-items: center;
                                img {
                                    width: 60px;
                                    height: 80px;
                                }
                            }
                        }
                    }
                    
                }
            }
        }
    }

    @media screen and (max-width: 468px) {
        .shopping-bag {
            width: 80%;
            .shopping-bag-content {
                .shopping-bag-top {
                    .shopping-bag-cart {
                        .shopping-bag-cart-top {
                            margin-bottom: 1rem;
                        }
                    }
                }
                .shopping-bag-bottom {
                    .shopping-bag-top {
                        p {
                            font-size: 16px;
                        }
                    }
                    .shopping-bag-button {
                        .shopping-bag-btn {
                            font-size: 16px;
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 320px) {
        .shopping-bag {
            width: 100%;
        }
    }
</style>
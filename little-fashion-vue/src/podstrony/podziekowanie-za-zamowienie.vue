<template>
    <MainHeader />
    <div class="home">
        <div class="home-content">
            <div class="home-heading">
                <h1>Podziękowanie za zamówienie</h1>
                <hr>
            </div>
            <div class="home-top">
                <div class="home-flex">
                    <h2>Szczegóły:</h2>
                </div>
                <div class="home-flex">
                    <h2>Numer zamówienia:</h2>
                    <p>{{ orderData.numer_zamowienia}}</p>
                </div>
                <div class="home-flex">
                    <h2>Produkty:</h2>
                    <p>{{ orderData.zakupione_produkty}}</p>
                </div>
                <div class="home-flex">
                    <h2>Metoda dostawy:</h2>
                    <p>{{ orderData.dostawa }}</p>
                </div>
                <div class="home-flex">
                    <h2>Metoda płatności:</h2>
                    <p>{{ orderData.platnosc }}</p>
                </div>
                <div class="home-flex">
                    <h2>Łączna kwota:</h2>
                    <p>{{ orderData.laczna_kwota }} zł</p>
                </div>
            </div>
            <div class="home-bottom" v-if="orderData.platnosc === 'Przelew bankowy'">
                <div class="home-flex">
                    <h2>Dane do przelewu:</h2>
                </div>
                <div class="home-flex">
                    <h2>Numer konta:</h2>
                    <p>88 1020 4926 0000 1202 0190 1537</p>
                </div>
                <div class="home-flex">
                    <h2>Umieść w tytule przelewu:</h2>
                    <p>{{ orderData.numer_zamowienia }}</p>
                </div>
            </div>
            <router-link to="/strona-glowna" @click="goToHomePage">Przejdź do strony głównej</router-link>
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

    methods: {
    ...mapActions(['clearCart']),

    goToHomePage() {
      // Wywołaj akcję clearCart z Vuex do wyczyszczenia koszyka
      this.clearCart();

      // Przekieruj użytkownika do strony głównej
      this.$router.push('/');
    }
  },
      
    computed: {
    ...mapState(['orderData']),
  },
  
}
</script>
  
<style lang="scss" scoped>
.home {
    .home-content {
        padding-top: 7rem;
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        .home-heading {
            h1 {
                font-size: 40px;
                color: var(--black);
                margin-bottom: 1rem;
            }
            hr {
                width: 150px;
                height: 3px;
                background-color: var(--dark-beige);
                border: none;
                margin-bottom: 1rem;
                border-radius: 10px;
            }
        }
        .home-top {
            width: 60%;
            margin-bottom: 2rem;
            .home-flex:first-child {
                border-top: 1px solid var(--dark-beige);
            }
            .home-flex {
                border-bottom: 1px solid var(--dark-beige);
                padding-bottom: 1rem;
                padding-top: 1rem;
                display: flex;
                justify-content: space-between;
                h2 {
                    font-size: 24px;
                    width: 30%;
                }
                p {
                    font-size: 24px;
                    width: 70%;
                    text-align: right;
                }
            }
        }
        .home-bottom {
            width: 60%;
            margin-bottom: 2rem;
            .home-flex:first-child {
                border-top: 1px solid var(--dark-beige);
            }
            .home-flex {
                border-bottom: 1px solid var(--dark-beige);
                padding-bottom: 1rem;
                padding-top: 1rem;
            }
            .home-flex {
                border-bottom: 1px solid var(--dark-beige);
                display: flex;
                justify-content: space-between;
                h2 {
                    font-size: 24px;
                    width: 50%;
                    width: 30%;
                }
                p {
                    font-size: 24px;
                    width: 70%;
                    text-align: right;
                }
            }
        }
        a {
                font-size: 20px;
                color: var(--black);
                text-underline-offset: 4px;
                transition: 0.5s;
                &:hover {
                    color: var(--dark-beige);
                }
        }
    }
}
    @media screen and (max-width: 1600px) {
      .home {
        .home-content {
            .home-heading {
                h1 {
                    font-size: 32px;
                }
            }
            .home-top {
                width: 100%;
            }
            .home-bottom {
                width: 100%;
            }
        }
      }
    }

    @media screen and (max-width: 1024px) {
        .home {
            .home-content {
                .home-top {
                    .home-flex {
                        flex-direction: column;
                        h2 {
                            width: 100%;
                            width: 100%;
                        }
                        p {
                            margin-top: 1rem;
                            width: 100%;
                            text-align: left;
                            width: 100%;
                        }
                    }
                }
                .home-bottom {
                    .home-flex {
                        flex-direction: column;
                        h2 {
                            width: 100%;
                        }
                        p {
                            margin-top: 1rem;
                            text-align: left;
                            width: 100%;
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 468px) {
        .home {
            .home-content {
                .home-heading {
                    h1 {
                        font-size: 24px;
                    }
                }
                .home-top {
                    .home-flex {
                        h2 {
                            font-size: 20px;
                        }
                        p {
                            font-size: 20px;
                        }
                    }
                }
                .home-bottom {
                    .home-flex {
                        h2 {
                            font-size: 20px;
                        }
                        p {
                            font-size: 20px;
                        }
                    }
                }
            }
        }
    }

</style>
<template>
    <div>
        <UserHeader />
        <AdminLoginSidebar />
        <div class="home">
            <div class="home-content">
                <div class="home-left">
                    <div class="home-left-box">
                        <div class="home-box-content">
                            <h2>Twoje zamówienie</h2>
                            <hr>
                            <p>Numer zamówienia: {{ numerZamowienia }}</p>
                            <p>Status: {{ orderStatus ? orderStatus.status_zamowienia : 'Brak danych' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <MainFooterBottom />
    </div>
</template>

<script>
import UserHeader from '../../components/user/user-header.vue'
import MainFooterBottom from '../../components/main/main-footer-bottom.vue'
import axios from 'axios'

export default {
    components: {
        UserHeader,
        MainFooterBottom
    },
    data() {
        return {
            numerZamowienia: null,
            orderStatus: null
        }
    },
    methods: {
        fetchData() {
            this.numerZamowienia = this.$route.params.numerZamowienia;
            console.log('Numer zamówienia:', this.numerZamowienia);

            axios.get(`http://localhost:8000/api/status-zamowienia/${this.numerZamowienia}`)

                .then(response => {
                    console.log('Odpowiedź z serwera:', response.data);
                    this.orderStatus = response.data.order || {};
                })
                .catch(error => {
                    console.error('Błąd pobierania danych zamówienia:', error);
                });
        },
    },
    mounted() {
        console.log('Komponent zamówienia zamontowany.');
        this.fetchData();
    }
}
</script>

  
<style lang="scss" scoped>
    .home {
        .home-content:first-child {
            padding-top: 7rem;
        }
        .home-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            .home-left {
                width: 50%;
                .home-left-box {
                    border: 1px solid var(--dark-beige);
                    border-radius: 10px;
                    .home-box-content {
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        padding-top: 1rem;
                        h2 {
                            font-size: 32px;
                            margin-bottom: 1rem;
                        }
                        hr {
                            width: 150px;
                            height: 3px;
                            border: none;
                            border-radius: 10px;
                            background-color: var(--light-beige);
                            margin-bottom: 1rem;
                        }
                        p {
                            font-size: 20px;
                            margin-bottom: 1rem;
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
                .home-left-box:not(:last-child) {
                    margin-bottom: 2rem
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .home {
            .home-content {
                flex-direction: column;
                .home-left {
                    width: 100%;
                    margin-bottom: 2rem;
                    .home-left-box {
                        .home-box-content {
                            h2 {
                                font-size: 24px
                            }
                        }
                    }
                }
            }
        }
    }
</style>

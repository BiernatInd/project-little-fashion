<template>
    <MainHeader />
    <div class="aboutus">
        <div class="aboutus-columns">
            <div class="aboutus-left">
                <img src="../assets/4.png" alt="">
            </div>
            <div class="aboutus-right">
                <h1>Historia naszej firmy</h1>
                <p>Moja firma zaczęła swoją niezwykłą podróż dokładnie 10 lat temu, kiedy to zrodził się pomysł na tworzenie ręcznie szytych ubranek dla lalek, uroczych turbanów oraz niezwykłych scrunchie. To był początek naszej pasji i zaangażowania w tworzenie małych dzieł sztuki, które odmieniają świat lalek i ich właścicieli.</p>
                <p>Wtedy to, siedząc przy małym stole w skromnym mieszkaniu, zaczęliśmy wyrabiać nasze pierwsze produkty. Każda sztuka ubranka dla lalki, turbanu czy scrunchie była wyjątkowa, bo tworzyliśmy nasze produkty z sercem. To nie była tylko produkcja, to była nasza miłość do rękodzieła, która kształtowała naszą firmę.</p>
                <div class="aboutus-button">
                    <button class="aboutus-btn" @click="showHistory">
                        Czytaj więcej
                        <div><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/></svg></div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="history" :class="{ 'active': historyActive }" ref="history">
        <div class="history-content">
            <div class="history-top">
                <div class="history-top-left">
                    <h2>Historia naszej firmy</h2>
                    <hr>
                </div>
                <div class="history-top-right">
                    <img src="../assets/icons/6.svg" alt="" @click="hideHistory">
                </div>
            </div>
            <div class="history-bottom">
                <p>Moja firma zaczęła swoją niezwykłą podróż dokładnie 10 lat temu, kiedy to zrodził się pomysł na tworzenie ręcznie szytych ubranek dla lalek, uroczych turbanów oraz niezwykłych scrunchie. To był początek naszej pasji i zaangażowania w tworzenie małych dzieł sztuki, które odmieniają świat lalek i ich właścicieli.</p>
                <p>Wtedy to, siedząc przy małym stole w skromnym mieszkaniu, zaczęliśmy wyrabiać nasze pierwsze produkty. Każda sztuka ubranka dla lalki, turbanu czy scrunchie była wyjątkowa, bo tworzyliśmy nasze produkty z sercem. To nie była tylko produkcja, to była nasza miłość do rękodzieła, która kształtowała naszą firmę.</p>
                <p>Początki były trudne, ale nasza determinacja i zaangażowanie tylko nas napędzały. Nasze produkty zdobywały uznanie klientów, a z czasem zaczęliśmy otrzymywać zamówienia nie tylko z Polski, ale również z Czech. Nasza mała pracownia musiała się rozwijać, aby sprostać rosnącym oczekiwaniom.</p>
                <p>W miarę jak rok po roku upływał, eksplorowaliśmy nowe pomysły i wzory. Wprowadzaliśmy coraz to nowe kolekcje, które odzwierciedlały naszą pasję i kreatywność. Nasza firma przekształcała się i rozwijała, ale zawsze pozostawaliśmy wierni naszemu pierwotnemu celowi: tworzyć wyjątkowe i piękne rzeczy, które przynosiły radość naszym klientom.</p>
                <p>Dziś, po 10 latach istnienia, nasza firma stała się rozpoznawalną marką na rynku. Nasze ubranka dla lalek zdobią kolekcje wielu małych dziewczynek. Nasze produkty trafiają do domów na terenie całej Polski i Czech, przynosząc uśmiech na twarzach naszych klientów.</p>
                <p>Jesteśmy dumni z tego, co osiągnęliśmy w ciągu ostatniej dekady, ale wiemy, że nasza historia jest jeszcze daleka od zakończenia. Nasza firma nadal rośnie, nadal inspiruje nasza pasja do tworzenia, a nasza lojalna klientela sprawia, że codziennie czujemy się docenieni.</p>
                <p>Patrząc w przyszłość, wiemy, że będziemy kontynuować naszą misję, tworząc piękne, ręcznie wykonane produkty, które przynoszą radość i kolor życia każdemu, kto do nich się zbliży.</p>
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

export default {
    components: {
        MainHeader,
        MainFooterTop,
        MainFooterBottom
    },
    data() {
        return {
            historyActive: false
        };
    },
    methods: {
        showHistory() {
            this.historyActive = !this.historyActive;
            document.body.classList.toggle('active', this.historyActive);
        },
        hideHistory() {
            this.historyActive = false;
            document.body.classList.remove('active');
        }
    }
}
</script>
  
<style lang="scss" scoped>
.aboutus {
    padding-top: 10.3rem;
    padding-bottom: 5.3rem;
    .aboutus-columns {
        display: flex;
        align-items: center;
        background-color: var(--light-beige);
        height: 520px;
        justify-content: space-around;
        .aboutus-left {
            width: 22%;
            img {
                display: block;
                width: 100%;
            }
        }
        .aboutus-right {
            width: 48%;
            h1 {
                font-size: 40px;
                margin-bottom: 2rem;
            }
            p {
                font-size: 24px;
                margin-bottom: 2rem;
            }
            .aboutus-button {
                .aboutus-btn {
                    width: 300px;
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
                            stroke: var(--light-beige);
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
    }
}

.history {
    position: fixed;
    height: 100%;
    width: 100%;
    max-width: 1920px;
    top: -1000px;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.5s;
    z-index: 999;
    &.active {
        top: 0;
    }
    .history-content {
        width: 80%;
        background-color: var(--white);
        border-radius: 10px;
        padding-top: 2rem;
        padding-bottom: 2rem;
        .history-top {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            .history-top-left {
                h2 {
                    font-size: 32px;
                    color: var(--black);
                    margin-bottom: 1rem;
                }
                hr {
                    width: 50%;
                    height: 3px;
                    border: none;
                    border-radius: 10px;
                    background-color: var(--light-beige);
                }
            }
            .history-top-right {
                img {
                    user-select: none;
                    cursor: pointer;
                }
            }
        }
        .history-bottom {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            p {
                font-size: 20px;
            }
            p:first-child {
                margin-top: 1rem;
            }
            p:not(:last-child) {
                margin-bottom: 1rem;
            }
        }
    }
}

@media screen and (max-width: 1600px) {
    .aboutus {
        padding-top: 7rem;
        padding-bottom: 2rem;
        .aboutus-columns {
            padding-top: 2rem;
            padding-bottom: 2rem;
            height: 100%;
            .aboutus-right {
                width: 60%;
                h1 {
                    font-size: 32px;
                }
            }
        }
    }
}

@media screen and (max-width: 1024px) {
    .aboutus {
        padding-top: 7rem;
        padding-bottom: 0;
        .aboutus-columns {
            flex-direction: column;
            padding-top: 2rem;
            padding-bottom: 2rem;
            .aboutus-left {
                width: 60%;
                margin-bottom: 2rem;
            }
            .aboutus-right {
                width: 95%;
                margin-left: auto;
                margin-right: auto;
                h1 {
                    font-size: 32px;
                }
                p {
                    font-size: 20px;
                }
            }
        }
    }
    .history {
        .history-content {
            width: 95%;
            height: 80%;
            overflow-y: scroll;
        }
    }
}

@media screen and (max-width: 468px) {
    .aboutus {
        .aboutus-columns {
            .aboutus-right {
                h1 {
                    font-size: 24px;
                    margin-bottom: 1rem;
                }
                p {
                   font-size: 16px;
                   margin-bottom: 1rem;
                }
                .aboutus-button {
                    .aboutus-btn {
                        font-size: 16px;
                        width: 100%;
                    }
                }
            }
        }
    }
    .history {
        .history-content {
            .history-top {
                width: 90%;
                .history-top-left {
                    h2 {
                        font-size: 24px;
                    }
                }
            }
            .history-bottom {
                width: 90%;
                p {
                    font-size: 16px;
                }
            }
        }
    }
}
</style>
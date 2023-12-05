<template>
    <MainHeader />
    <div class="faq">
        <div class="faq-content">
            <div class="faq-heading">
                <h2>Najczęściej zadawane pytania</h2>
                <h1>Faq</h1>
            </div>
            <div class="faq-box-container">
      <div class="faq-box" v-for="(faq, index) in faqList" :key="index">
        <div class="faq-box-top" @click="toggleFaq(index)" :class="{ 'active': faq.active }">
          <p>{{ faq.question }}</p>
          <img src="../assets/icons/16.svg" alt=""  :class="{ 'active': faq.active }">
        </div>
        <div class="faq-box-bottom" :class="{ 'active': faq.active }">
          <p>{{ faq.answer }}</p>
          <p>{{ faq.answer2 }}</p>
          <p>{{ faq.answer3 }}</p>
          <p>{{ faq.answer4 }}</p>
          <p>{{ faq.answer5 }}</p>
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


export default {
  components: {
    MainHeader,
    MainFooterTop,
    MainFooterBottom
  },
  data() {
    return {
      faqList: [
        {
          question: "Do jakich lalek są dostosowane ubranka?",
          answer: "Ubranka, które oferujemy, są dostosowane do lalek o wysokości 43 cm. Starannie projektujemy i szyjemy je tak, aby idealnie pasowały do tych lalek, zapewniając najwyższą jakość i precyzję wykonania.",
          active: true,
        },
        {
          question: "Z czego są produktowane ubranka?",
          answer: "Nasze produkty wykonane są z wysokiej jakości materiałów. Skład naszych materiałów to 92% bawełny i 8% elastanu. Dzięki tej mieszance tkanin nasze ubranka są zarówno miękkie, jak i wytrzymałe.",
          active: false,
        },
        {
          question: "Jakich wykrojów używamy?",
          answer: "Używamy wykrojów, które zostały specjalnie zaprojektowane przez nasz zespół projektantów. Nasze wykroje są unikalne i dostosowane do potrzeb lalek o wysokości 43 cm.",
          active: false,
        },
        {
          question: "Jak działa proces zwrotu towaru w przypadku wadliwego lub uszkodzonego produktu?",
          answer: "Jeśli otrzymasz produkt uważany za wadliwy lub uszkodzony, prosimy o natychmiastowy kontakt z naszym zespołem obsługi klienta. Możesz to zrobić poprzez e-mail, formularz kontaktowy na stronie internetowej lub telefonicznie.",
          answer2: "W trakcie kontaktu z nami, opisz dokładnie, jaki problem wystąpił z produktem. To pomoże nam lepiej zrozumieć sytuację.",
          answer3: "Po potwierdzeniu problemu, dostarczymy Ci dokładne instrukcje dotyczące procedury zwrotu. To obejmuje informacje na temat adresu do zwrotu, sposobu opakowania produktu i ewentualnych dokumentów wymaganych do przetworzenia zwrotu.",
          answer4: "Prosimy o przygotowanie produktu do zwrotu zgodnie z dostarczonymi instrukcjami i odesłanie go na podany adres.",
          answer5: "Po otrzymaniu zwróconego produktu przeprowadzimy ocenę, aby potwierdzić wadę lub uszkodzenie. Jeśli wada zostanie potwierdzona, zwrócimy Ci pieniądze na konto za pomocą oryginalnej metody płatności.",
          active: false,
        },
        {
          question: "Jakie metody płatności obsługujemy?",
          answer: "Oferujemy trzy wygodne metody płatności w naszym sklepie internetowym: Przelewy24, PayPal oraz tradycyjny przelew bankowy. Niestety, w tej chwili nie akceptujemy płatności kartami płatniczymi, ale nasze dostępne opcje płatności pozwalają na bezpieczne i wygodne dokonywanie transakcji. Jesteśmy otwarci na dostosowanie naszych usług w przyszłości, aby jeszcze lepiej sprostać oczekiwaniom naszych klientów.",
          active: false,
        },
        {
          question: "Jakie metody dostawy obsługujemy?",
          answer: "Oferujemy dwie wygodne metody dostawy w naszym sklepie internetowym: za pośrednictwem firmy kurierskiej DPD oraz za pomocą usługi Paczkomat InPost. Dzięki tym opcjom nasi klienci mogą wybrać preferowaną formę dostarczenia zamówienia, dostosowaną do swoich potrzeb i preferencji.",
          active: false,
        },
      ],
    };
  },
  methods: {
    toggleFaq(index) {
      this.faqList[index].active = !this.faqList[index].active;
    },
},
};

</script>
  
<style lang="scss" scoped>
    .faq {
        padding-top: 7rem;
        .faq-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .faq-heading {
                padding-top: 1rem;
                padding-bottom: 1rem;
                border-top: 1px solid var(--dark-beige);
                border-bottom: 1px solid var(--dark-beige);
                text-align: center;
                h2 {
                    margin-bottom: 1rem;
                    font-size: 32px;
                    color: var(--dark-beige);
                }
                h1 {
                    font-size: 40px;
                    color: var(--black);
                    text-transform: uppercase;
                }
            }
            .faq-box-container {
                margin-top: 2rem;
                .faq-box {
                    width: 80%;
                    margin-left: auto;
                    margin-right: auto;
                    border-radius: 10px;
                    border: 1px solid var(--dark-beige);
                    .faq-box-top {
                        display: flex;
                        justify-content: space-between;
                        padding-top: 1rem;
                        padding-bottom: 1rem;
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        cursor: pointer;
                        img {
                            transition: 0.5s;
                            user-select: none;
                            z-index: 0;
                        }
                        p {
                            font-size: 24px;
                        }
                        &.active {
                            img {
                                transform: rotate(180deg);
                            }
                        }
                    }
                    .faq-box-bottom {
                        border-top: 1px solid var(--dark-beige);
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        padding-top: 1rem;
                        display: none;
                        p {
                            font-size: 20px;
                            margin-bottom: 1rem;
                        }
                        &.active {
                            display: block;
                        }
                    }
                }
                .faq-box:not(:last-child) {
                    margin-bottom: 2rem;
            }
            }
        }
    }

    @media screen and (max-width: 1600px) {
        .faq {
            .faq-content {
                .faq-heading {
                    h1 {
                        font-size: 32px;
                    }
                    h2 {
                        font-size: 24px;
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .faq {
            padding-top: 7rem;
            .faq-content {
                .faq-box-container {
                    margin-top: 2rem;
                    .faq-box {
                        width: 100%;
                    }
                }
            }
        }
    }

    @media screen and (max-width: 468px) {
        .faq {
            .faq-content {
                .faq-heading {
                    h1 {
                        font-size: 24px;
                    }
                    h2 {
                        font-size: 20px;
                    }
                }
                .faq-box-container {
                    .faq-box {
                        width: 100%;
                        .faq-box-top {
                            p {
                                font-size: 20px;
                            }
                            img {
                                width: 25px;
                            }
                        }
                        .faq-box-bottom {
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
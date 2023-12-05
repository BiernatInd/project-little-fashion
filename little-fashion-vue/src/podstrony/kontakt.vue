<template>
    <MainHeader />
    <div class="contact">
        <div class="contact-content">
            <div class="contact-heading">
                <h2>Napisz do nas!</h2>
                <h1>Kontakt</h1>
                <hr>
            </div>
            <form class="contact-form" @submit.prevent="sendEmail">
                <div class="contact-left">
                    <div class="contact-left-content">
                        <h3>Informacje</h3>
                        <p><span>Nazwa firmy:</span> KAROL BIERNAT VIBEWEBS</p>
                        <p><span>Adres:</span> Sandomierz, 27-600, ul. Partyzantów 4c</p>
                        <p><span>NIP:</span> 8641964486</p>
                        <p><span>Kontakt telefoniczny:</span> +48 733 001 533</p>
                        <p><span>E-mail:</span> biuro@little-fashion.pl</p>
                    </div>
                </div>
                <div class="contact-right">
                    <div class="contact-right-content">
                        <h3>Skontaktuj się z nami!</h3>
                        <div class="input-flex">
                            <input type="text" v-model="formData.name" placeholder="Imię" required>
                              <input type="text" v-model="formData.surname" placeholder="Nazwisko" required>
                        </div>
                        <div class="input-flex">
                            <input type="email" v-model="formData.email" placeholder="E-mail" required>
                              <input type="number" v-model="formData.phone" placeholder="Numer telefonu" required>
                        </div>
                        <div class="input-full-width">
                            <textarea v-model="formData.message" placeholder="Wiadomość i inne ważne informacje"></textarea>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" v-model="formData.acceptTerms">
                            <p>Akceptuję <a href="#">politykę prywatności</a> i <a href="#">regulamin</a> sklepu. <span>(Wymagane)</span></p>
                        </div>
                        <div class="contact-buttons">
                            <button class="contact-btn" type="submit">
                                Wyślij wiadomość
                                <div><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/></svg></div>
                            </button>
                            <button class="contact-btn" type="reset">
                                Zresetuj
                                <div><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/></svg></div>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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
        MainFooterBottom
    },
    data() {
      return {
        isMenuActive: false,
        formData: {
        name: '',
        surname: '',
        email: '',
        phone: '',
        message: '',
        acceptTerms: false, 
      }
      };
    },
    methods: {
        handleMenuToggle(menuActive) {
      this.isMenuActive = menuActive;
    },
    sendEmail() {
      if (this.formData.acceptTerms) {
        // Checkbox zaznaczony, możemy wysłać formularz
        axios.post('http://localhost:8000/api/wyslij-formularz', this.formData)
          .then(response => {
            alert("Wiadomość została wysłana. Wkrótce się z tobą skontaktujemy!");
          })
          .catch(error => {
            console.error(error);
          });
      } else {
        // Checkbox niezaznaczony, wyświetl komunikat lub podejmij odpowiednie działania
        alert("Musisz zaakceptować politykę prywatności i regulamin sklepu.");
      }
    }
    },
}
</script>
  
<style lang="scss" scoped>
   .contact {
        padding-top: 7rem;
        .contact-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .contact-heading {
                h1 {
                    font-size: 40px;
                    color: var(--black);
                    margin-bottom: 1rem;
                }
                h2 {
                    font-size: 32px;
                    margin-bottom: 1rem;
                    color: var(--dark-beige);
                }
                hr {
                background-color: var(--dark-beige);
                height: 3px;
                border: none;
                border-radius: 10px;
                width: 100px;
                margin-bottom: 2rem;
                }
            }
            .contact-form {
                margin-left: auto;
                margin-right: auto;
                width: 1400px;
                display: flex;
                border-radius: 10px;
                border: 1px solid var(--dark-beige);
                .contact-left {
                    width: 50%;
                    border-right: 1px solid var(--dark-beige);
                    .contact-left-content {
                        margin-top: 2rem;
                        width: 90%;
                        margin-left: auto;
                        margin-right: auto;
                        h3 {
                            font-size: 24px;
                            color: var(--dark-beige);
                            margin-bottom: 2rem;
                        }
                        p {
                            font-size: 20px;
                            color: var(--black);
                            span {
                                color: var(--dark-beige);
                            }
                        }
                        p:not(:last-child) {
                            margin-bottom: 2rem;
                        }
                    }
                }
                .contact-right {
                    padding-bottom: 2rem;
                    width: 50%;
                    .contact-right-content {
                        width: 90%;
                        margin-left: auto;
                        margin-right: auto;
                        margin-top: 2rem;
                        h3 {
                            font-size: 24px;
                            color: var(--dark-beige);
                            margin-bottom: 2rem;
                        }
                        .input-flex {
                            display: flex;
                            justify-content: space-between;
                            margin-bottom: 2rem;
                            input {
                                width: 48%;
                                height: 30px;
                                font-size: 20px;
                                border: none;
                                background-color: var(--transparent);
                                border-bottom: 1px solid var(--dark-beige);
                            }
                        }
                        .input-full-width {
                            margin-bottom: 2rem;
                            textarea {
                                width: 100%;
                                height: 140px;
                                font-size: 20px;
                                background-color: var(--transparent);
                                border: none;
                                border-bottom: 1px solid var(--dark-beige);
                                resize: none;
                            }
                        }
                        .checkbox {
                            margin-bottom: 2rem;
                            display: flex;
                            align-items: center;
                            input {
                                width: 15px;
                                height: 15px;
                                margin-right: 1rem;
                                }
                            input[type="checkbox"] {
                                cursor: pointer;
                                accent-color: var(--black);
                            }
                            p {
                                font-size: 20px;
                                color: var(--black);
                                a {
                                    color: var(--black);
                                    text-underline-offset: 4px;
                                }
                            }
                        }
                        .contact-buttons {
                            display: flex;
                            .contact-btn {
                                margin-right: 1rem;
                    width: 50%;
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

    @media screen and (max-width: 1600px) {
        .contact {
            .contact-content {
                .contact-heading {
                    h1 {
                        font-size: 32px;
                    }
                    p {
                        font-size: 24px;
                    }
                }
                .contact-form {
                    width: 100%;
                }
            }
        }
    }

    @media screen and (max-width: 1400px) {
        .contact {
            .contact-content {
                .contact-form {
                    .contact-left {
                        .contact-left-content {
                            h3 {
                                font-size: 20px;
                            }
                            p {
                                font-size: 16px;
                            }
                        }
                    }
                    .contact-right {
                        .contact-right-content {
                            h3 {
                                font-size: 20px;
                            }
                            .input-flex {
                                input {
                                    font-size: 16px;
                                }
                            }
                            .input-full-width {
                                textarea {
                                    font-size: 16px;
                                }
                            }
                            .checkbox {
                                p {
                                    font-size: 16px;
                                }
                            }
                            .contact-buttons {
                                flex-direction: column;
                                .contact-btn {
                                    font-size: 16px;
                                    height: 30px;
                                    width: 100%;
                                    div {
                                        height: 30px;
                                    }
                                }
                                .contact-btn:not(:last-child) {
                                    margin-bottom: 2rem;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .contact {
            padding-top: 7rem;
            .contact-content {
                .contact-form {
                    flex-direction: column;
                    .contact-left {
                        width: 100%;
                        border-right: none;
                        border-bottom: 1px solid var(--dark-beige);
                        padding-bottom: 2rem;
                    }
                    .contact-right {
                        width: 100%;
                        .contact-right-content {
                            .input-flex {
                                flex-direction: column;
                                margin-bottom: 0;
                                input {
                                    width: 100%;
                                    margin-bottom: 2rem;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 468px) {
        .contact {
            .contact-content {
                .contact-heading {
                    h1 {
                        font-size: 24px;
                    }
                    h2 {
                        font-size: 20px;
                    }
                }
            }
        }
    }
</style>
<template>
    <MainHeader />
    <div class="order">
        <div class="order-content">
            <div class="order-heading">
                <h2>Dostawa do 24 godzin!</h2>
                <h1>Wybierz sposób dostawy</h1>
                <hr>
            </div>
            <div class="order-columns">
                <div class="order-left">
                    <div class="order-delivery">
                        <div v-for="(delivery, index) in deliveryOptions" :key="index" class="order-delivery-box" :class="{ active: delivery.selected }" @click="selectDelivery(index)">
                            <div class="order-delivery-box-content">
                                <div class="checkbox">
                                  <input type="checkbox" v-model="delivery.selected" :disabled="delivery.selected">
                                </div>
                                <p>{{ delivery.name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="order-heading">
                        <h2>Kupujesz jako</h2>
                        <hr>
                    </div>
                    <div class="order-option">
                        <div v-for="(option, index) in orderOptions" :key="index" class="order-option-box" :class="{ active: option.isActive }" @click="selectOrderOption(index)">
                            <div class="order-option-content">
                              <p>{{ option.name }}</p>
                            </div>
                        </div>
                    </div>
                    <form class="form-private" :class="{ active: orderOptions[0].isActive }">
                        <div class="order-heading">
                            <h2>Adres dostawy</h2>
                            <hr>
                        </div>
                        <div class="order-inputs">
                            <input type="text" v-model="formDataPrivate.imie" placeholder="Imię" :required="orderOptions[0].isActive">
                            <input type="text" v-model="formDataPrivate.nazwisko" placeholder="Nazwisko" :required="orderOptions[0].isActive">
                        </div>
                        <div class="order-inputs">
                            <input type="email" v-model="formDataPrivate.email" placeholder="Adres E-mail" :required="orderOptions[0].isActive">
                            <input type="text" v-model="formDataPrivate.telefon" placeholder="Numer Telefonu" :required="orderOptions[0].isActive" @input="validateTelephonePrivate">
                        </div>
                        <div class="order-full-width">
                            <select v-model="formDataPrivate.kraj" :required="orderOptions[0].isActive">
                                <option value="Polska">Polska</option>
                                <option value="Austria">Austria</option>
                                <option value="Belgia">Belgia</option>
                                <option value="Bułgaria">Bułgaria</option>
                                <option value="Chorwacja">Chorwacja</option>
                                <option value="Cypr">Cypr</option>
                                <option value="Czechy">Czechy</option>
                                <option value="Dania">Dania</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Finlandia">Finlandia</option>
                                <option value="Francja">Francja</option>
                                <option value="Grecja">Grecja</option>
                                <option value="Hiszpania">Hiszpania</option>
                                <option value="Holandia">Holandia</option>
                                <option value="Irlandia">Irlandia</option>
                                <option value="Litwa">Litwa</option>
                                <option value="Luksemburg">Luksemburg</option>
                                <option value="Łotwa">Łotwa</option>
                                <option value="Malta">Malta</option>
                                <option value="Niemcy">Niemcy</option>
                                <option value="Portugalia">Portugalia</option>
                                <option value="Rumunia">Rumunia</option>
                                <option value="Słowacja">Słowacja</option>
                                <option value="Słowenia">Słowenia</option>
                                <option value="Szwecja">Szwecja</option>
                                <option value="Węgry">Węgry</option>
                                <option value="Włochy">Włochy</option>
                            </select>
                        </div>
                        <div class="order-inputs">
                            <input type="text" v-model="formDataPrivate.ulica_i_numer_domu" placeholder="Ulica i numer domu / mieszkania" :required="orderOptions[0].isActive">
                            <input type="text" v-model="formDataPrivate.miejscowosc" placeholder="Miejscowość" :required="orderOptions[0].isActive">
                        </div>
                        <div class="order-full-width">
                            <input type="text" v-model="formDataPrivate.kod_pocztowy" placeholder="Kod pocztowy" :required="orderOptions[0].isActive" @input="validatePostalCodePrivate">
                        </div>
                        <div class="order-heading">
                            <h2>Dane do faktury</h2>
                            <hr>
                            <p>W naszym sklepie internetowym dowodem zakupu jest faktura. Standardowo wystawiamy ją na dane z adresu dostawy.</p>
                        </div>
                        <div class="invoice">
                            <div class="invoice-checkbox">
                              <input type="checkbox" v-model="showInvoiceForm">
                              <p>Chcę podać inne dane do faktury</p>
                            </div>
                            <div :class="{ 'active': showInvoiceForm }" class="invoice-form">
                              <div class="order-inputs">
                                <input type="text" placeholder="Imię" v-model="formDataPrivate.faktura_imie" :required="showInvoiceForm">
                                <input type="text" placeholder="Nazwisko" v-model="formDataPrivate.faktura_nazwisko" :required="showInvoiceForm">
                              </div>
                              <div class="order-inputs">
                                <input type="text" placeholder="Ulica i numer domu / mieszkania" v-model="formDataPrivate.faktura_ulica_i_numer_domu" :required="showInvoiceForm">
                                <input type="text" placeholder="Miejscowość" v-model="formDataPrivate.faktura_miejscowosc" :required="showInvoiceForm">
                              </div>
                              <div class="order-full-width">
                                <input type="text" v-model="formDataPrivate.faktura_kod_pocztowy" placeholder="Kod pocztowy" :required="showInvoiceForm" @input="validatePostalCodeInvoicePrivate">
                              </div>
                            </div>
                        </div>
                    </form>
                    <form class="form-invoice" :class="{ active: showInvoiceForm && orderOptions[1].isActive }">
                        <div class="order-heading">
                            <h2>Dane do faktury</h2>
                            <hr>
                        </div>
                        <div class="order-inputs">
                            <input type="text" placeholder="NIP" v-model="formDataCompany.nip" :required="showInvoiceForm && orderOptions[1].isActive">
                            <input type="text" placeholder="Nazwa firmy" v-model="formDataCompany.nazwa_firmy" :required="showInvoiceForm && orderOptions[1].isActive">
                        </div>
                        <div class="order-inputs">
                            <input type="email" placeholder="Ulica i numer domu / mieszkania" v-model="formDataCompany.ulica_i_numer_domu" :required="showInvoiceForm && orderOptions[1].isActive">
                            <input type="text" placeholder="Miejscowość" v-model="formDataCompany.miejscowosc" :required="showInvoiceForm && orderOptions[1].isActive">
                        </div>
                        <div class="order-full-width">
                            <input type="text" placeholder="Kod pocztowy" v-model="formDataCompany.kod_pocztowy" :required="showInvoiceForm && orderOptions[1].isActive" @input="validatePostalCodeCompany">
                        </div>
                        <div class="order-heading">
                            <h2>Adres dostawy</h2>
                            <hr>
                        </div>
                        <div class="order-inputs">
                            <input type="text" placeholder="Imię" v-model="formDataCompany.faktura_imie" :required="showInvoiceForm && orderOptions[1].isActive">
                            <input type="text" placeholder="Nazwisko" v-model="formDataCompany.faktura_nazwisko" :required="showInvoiceForm && orderOptions[1].isActive">
                        </div>
                        <div class="order-inputs">
                            <input type="email" placeholder="Adres E-mail" v-model="formDataCompany.faktura_email" :required="showInvoiceForm && orderOptions[1].isActive">
                            <input type="text" placeholder="Numer Telefonu" v-model="formDataCompany.faktura_telefon" :required="showInvoiceForm && orderOptions[1].isActive" @input="validateTelephoneCompany">
                        </div>
                        <div class="order-full-width">
                            <select v-model="formDataCompany.faktura_kraj" :required="orderOptions[0].isActive">
                                <option value="Polska">Polska</option>
                                <option value="Austria">Austria</option>
                                <option value="Belgia">Belgia</option>
                                <option value="Bułgaria">Bułgaria</option>
                                <option value="Chorwacja">Chorwacja</option>
                                <option value="Cypr">Cypr</option>
                                <option value="Czechy">Czechy</option>
                                <option value="Dania">Dania</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Finlandia">Finlandia</option>
                                <option value="Francja">Francja</option>
                                <option value="Grecja">Grecja</option>
                                <option value="Hiszpania">Hiszpania</option>
                                <option value="Holandia">Holandia</option>
                                <option value="Irlandia">Irlandia</option>
                                <option value="Litwa">Litwa</option>
                                <option value="Luksemburg">Luksemburg</option>
                                <option value="Łotwa">Łotwa</option>
                                <option value="Malta">Malta</option>
                                <option value="Niemcy">Niemcy</option>
                                <option value="Portugalia">Portugalia</option>
                                <option value="Rumunia">Rumunia</option>
                                <option value="Słowacja">Słowacja</option>
                                <option value="Słowenia">Słowenia</option>
                                <option value="Szwecja">Szwecja</option>
                                <option value="Węgry">Węgry</option>
                                <option value="Włochy">Włochy</option>
                            </select>
                        </div>
                        <div class="order-inputs">
                            <input type="text" placeholder="Ulica i numer domu / mieszkania" v-model="formDataCompany.faktura_ulica_i_numer_domu" :required="showInvoiceForm && orderOptions[1].isActive">
                            <input type="text" placeholder="Miejscowość" v-model="formDataCompany.faktura_miejscowosc" :required="showInvoiceForm && orderOptions[1].isActive">
                        </div>
                        <div class="order-full-width">
                            <input type="text" placeholder="Kod pocztowy" v-model="formDataCompany.faktura_kod_pocztowy" :required="showInvoiceForm && orderOptions[1].isActive" @input="validatePostalCodeSecondCompany">
                        </div>
                    </form>
                    <div class="order-heading">
                        <h2>Płatność</h2>
                        <hr>
                    </div>
                    <div class="order-delivery">
                        <div v-for="(payment, index) in paymentOptions" :key="index" class="order-delivery-box" :class="{ active: payment.selected }" @click="selectPayment(index)">
                            <div class="order-delivery-box-content">
                                <div class="checkbox">
                                    <input type="checkbox" v-model="payment.selected" :disabled="payment.selected">
                                </div>
                                <p>{{ payment.name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="order-heading">
                        <h2>Zgody i oświadczenia</h2>
                        <hr>
                    </div>
                    <div class="accept-statement">
                        <div class="checkbox">
                            <input type="checkbox" v-model="privacyPolicyAccepted" required>
                            <p>Akceptuję <a href="#">politykę prywatności</a> i <a href="#">regulamin sklepu.</a> <span>(Wymagane)</span></p>
                        </div>
                    </div>
                </div>
                <div class="order-right">
                    <div class="order-cart">
                        <div class="order-cart-content">
                            <div class="order-cart-top">
                                <h3>Wpisz kod promocyjny</h3>
                            </div>
                            <div class="order-cart-promote">
                                <input type="text" placeholder="Wprowadź kod" v-model="discountCode">
  <button class="order-btn" @click="checkDiscountCode">
                                    Aktywuj
                                    <div><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/></svg></div>
                                </button>
                            </div>
                            <div class="order-cart-info">
                                <p>Koszyk</p>
                                <p>{{ productsTotal }} zł</p>
                            </div>
                            <div v-if="deliveryOptions.some(delivery => delivery.selected)" class="order-cart-info">
                                <p>Dostawa</p>
                                <p>{{ deliveryOptions.find(delivery => delivery.selected)?.name }}</p>
                            </div>
                            <div class="order-cart-info">
                                <p>Podatek (23% VAT)</p>
                                <p>{{ tax.toFixed(2) }} zł</p>
                            </div> 
                            <div class="order-cart-price">
                                <p>Łączna kwota</p>
                                <p>{{ totalPrice }} zł</p>
                            </div>
                            <div class="order-cart-button">
                                <button class="order-cart-btn" @click="submitForm">
                                    Przejdź do zapłaty
                                    <div><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/></svg></div>
                                </button>
                            </div>
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
import MainFooterTop from '../components/main/main-footer-top.vue';
import MainFooterBottom from '../components/main/main-footer-bottom.vue';

import axios from 'axios'

import { mapState, mapGetters } from 'vuex';

export default {
    components: {
        MainHeader,
        MainFooterTop,
        MainFooterBottom
    },
    
    data() {
    return {
formDataPrivate: {
        imie: '',
        nazwisko: '',
        email: '',
        telefon: '',
        kraj: 'Polska',
        ulica_i_numer_domu: '',
        miejscowosc: '',
        kod_pocztowy: '',
        faktura_imie: '',
        faktura_nazwisko: '',
        faktura_ulica_i_numer_domu: '',
        faktura_miejscowosc: '',
        faktura_kod_pocztowy: '',
        numer_zamowienia: '',
        wprowadzony_kod_promocyjny: '',
        znizka: 0,
        nazwa_uzytkownika: '',
    },
    formDataCompany: {
        nip: '',
        nazwa_firmy: '',
        ulica_i_numer_domu: '',
        miejscowosc: '',
        kod_pocztowy: '',
        faktura_imie: '',
        faktura_nazwisko: '',
        faktura_email: '',
        faktura_telefon: '',
        faktura_kraj: 'Polska',
        faktura_ulica_i_numer_domu: '',
        faktura_miejscowosc: '',
        faktura_kod_pocztowy: '',
        numer_zamowienia: '',
        wprowadzony_kod_promocyjny: '',
        znizka: 0,
        nazwa_uzytkownika: '',
    },
    tax: 0,
    productsTotal: 0,
    privacyPolicyAccepted: false,
      deliveryOptions: [
      { name: "Dostawa kurierem InPost - 15,00 zł", selected: true, price: 15.00 },
      { name: "Dostawa paczkomat InPost - 14,00 zł", selected: false, price: 14.00 },
      { name: "Odbiór osobisty", selected: false, price: 0.00 },
      ],
      orderOptions: [
        { name: "Osoba prywatna", isActive: true },
        { name: "Firma", isActive: false },
      ],
      paymentOptions: [
        // { name: "Przelewy24", selected: true },
        { name: "PayPal", selected: false },
        { name: "Przelew bankowy", selected: false },
      ],
      showInvoiceForm: false,
      discountCode: '',
    };
  },
  methods: {
    checkDiscountCode() {
        const wprowadzony_kod_promocyjny = this.discountCode;

    console.log('Sending request to check discount code...');

    axios.post('http://localhost:8000/api/obsluga-rabatu', { kod_rabatowy: wprowadzony_kod_promocyjny })
        .then(response => {
            console.log('Response from server:', response.data);

            if (response.data.success) {
                // Convert discount value to a percentage (e.g., 15.00 to 0.15)
                const discountPercentage = response.data.znizka / 100;

                // Calculate the discounted amount
                this.formDataPrivate.znizka = discountPercentage * this.totalPrice;

                this.formDataCompany.znizka = discountPercentage * this.totalPrice;

                // Update the total price
                this.totalPrice = this.calculateTotalPrice();

                // Wysyłamy kod promocyjny do kolumny wprowadzony_kod_promocyjny
                this.formDataPrivate.wprowadzony_kod_promocyjny = wprowadzony_kod_promocyjny;
            }
        })
        .catch(error => {
            console.error('Error while checking discount code:', error);
            alert('Wystąpił błąd podczas sprawdzania kodu rabatowego.');
        });
},

        //ustawiamy tutaj ilosc produktow ktore zamowion
        getProductsWithQuantities() {
          return this.addedProducts.map(product => `${product.nazwa} - x${product.quantity}`).join(', ');
      },

    //validate errors
    handleValidationErrors(errors) {
        alert('Wprowadź poprawne dane dla wszystkich pól.');
},
    //input validate
    validateTelephonePrivate() {
        this.formDataPrivate.telefon = this.formDataPrivate.telefon.replace(/[^0-9]/g, '');
    },
    validatePostalCodePrivate() {
      this.formDataPrivate.kod_pocztowy = this.formDataPrivate.kod_pocztowy.replace(/[^0-9-]/g, '');
    },
    validatePostalCodeInvoicePrivate() {
      this.formDataPrivate.faktura_kod_pocztowy = this.formDataPrivate.faktura_kod_pocztowy.replace(/[^0-9-]/g, '');
    },
    validateTelephoneCompany() {
        this.formDataCompany.faktura_telefon = this.formDataCompany.faktura_telefon.replace(/[^0-9]/g, '');
    },
    validatePostalCodeCompany() {
      this.formDataCompany.kod_pocztowy = this.formDataCompany.kod_pocztowy.replace(/[^0-9-]/g, '');
    },
    validatePostalCodeSecondCompany() {
        this.formDataCompany.faktura_kod_pocztowy = this.formDataCompany.faktura_kod_pocztowy.replace(/[^0-9-]/g, '');
    },
    submitForm() {
    if (!this.privacyPolicyAccepted) {
      alert('Zaakceptuj politykę prywatności i regulamin sklepu.');
      return;
    }

    if (this.orderOptions[0].isActive) {
      // Opcja: Osoba prywatna
      this.submitPrivateForm();
    } else if (this.orderOptions[1].isActive) {
      // Opcja: Firma
      this.submitCompanyForm();
      this.checkDiscountCode();
      this.formDataPrivate.wprowadzony_kod_promocyjny = this.discountCode;
    }
  },
  updateWarehouseStock() {
  const productsToUpdate = this.addedProducts.map(product => ({
    product: product.nazwa,
    quantity: product.quantity,
  }));

  axios.post('http://localhost:8000/api/aktualizacja-stanu', {
    quantity: this.totalQuantity(),
    products: productsToUpdate,
  })
  .then(response => {
    console.log(response.data);
  })
  .catch(error => {
    console.error(error.response.data);
  });
},
    submitPrivateForm() {
    this.formDataPrivate.dostawa = this.deliveryOptions.find(delivery => delivery.selected)?.name || '';
    this.formDataPrivate.podatek_vat = this.tax;
    this.formDataPrivate.laczna_kwota = this.totalPrice;
    this.formDataPrivate.platnosc = this.paymentOptions.find(payment => payment.selected)?.name || '';

    this.formDataPrivate.zakupione_produkty = this.getProductsWithQuantities();

    const userName = localStorage.getItem("userName");

    this.formDataPrivate.nazwa_uzytkownika = userName;    

    this.$store.dispatch('setOrderData', this.formDataPrivate);

    console.log('Dane do wstawienia:', this.formDataPrivate.zakupione_produkty);

    this.formDataPrivate.numer_zamowienia = this.generateOrderNumber();

    if (!this.formDataPrivate.platnosc) {
        console.error('laczna_kwota nie jest ustawiony!');
        return;
    }

    console.log('Data to be sent for company:', this.formDataPrivate);

    axios.post('http://localhost:8000/api/zamowienia-osoba-prywatna', this.formDataPrivate)
        .then(response => {
            this.$router.push('/podziekowanie-za-zamowienie'); 
            this.updateWarehouseStock();
            console.log(response.data);
            this.$store.dispatch('clearCart');
        })
        .catch(error => {
        if (error.response && error.response.status === 422) {
          // Obsługa błędów walidacji
          const validationErrors = error.response.data.errors;
          this.handleValidationErrors(validationErrors);
        } else {
          // Obsługa innych błędów
          console.error(error.response.data);
        }
      });
},

totalQuantity() {
      return this.addedProducts.reduce((total, product) => total + product.quantity, 0);
    },
    // funkcja do obsługi formularza dla firmy
    submitCompanyForm() {
        this.formDataCompany.dostawa = this.deliveryOptions.find(delivery => delivery.selected)?.name || '';
        this.formDataCompany.podatek_vat = this.tax;
        this.formDataCompany.laczna_kwota = this.totalPrice;
        this.formDataCompany.platnosc = this.paymentOptions.find(payment => payment.selected)?.name || '';

        this.formDataCompany.zakupione_produkty = this.getProductsWithQuantities();

        this.formDataCompany.numer_zamowienia = this.generateOrderNumber();
        this.formDataCompany.wprowadzony_kod_promocyjny = this.discountCode;
        
        const userName = localStorage.getItem("userName");
        this.formDataCompany.nazwa_uzytkownika = userName;   
        
        this.$store.dispatch('setOrderData', this.formDataCompany);


        console.log('Dane do wstawienia:', this.formDataCompany.zakupione_produkty);

        axios.post('http://localhost:8000/api/zamowienia-firma', this.formDataCompany)
        .then(response => {
            this.$router.push('/podziekowanie-za-zamowienie'); 
            this.updateWarehouseStock();
          console.log(response.data);
          this.$store.dispatch('clearCart');
        })
        .catch(error => {
        if (error.response && error.response.status === 422) {
          // Obsługa błędów walidacji
          const validationErrors = error.response.data.errors;
          this.handleValidationErrors(validationErrors);
        } else {
          // Obsługa innych błędów
          console.error(error.response.data);
        }
    });
    },
    selectDelivery(index) {
      // Sprawdź, czy opcja dostawy jest już zaznaczona
      if (!this.deliveryOptions[index].selected) {
        this.deliveryOptions.forEach((delivery, i) => {
          delivery.selected = i === index;
        });

        // Aktualizuj łączną cenę w zależności od wybranej opcji dostawy
        this.totalPrice = this.calculateTotalPrice();
      }
    },
    calculateTotalPrice() {
        // Oblicz sumę cen produktów
        this.productsTotal = this.addedProducts.reduce((total, product) => {
            return total + product.cena * product.quantity;
        }, 0);

        // Sumuj ceny dostawy tylko dla wybranej opcji
        const deliveryPrice = this.deliveryOptions.find((delivery) => delivery.selected)?.price || 0;

        // Dodaj 23% do całkowitej ceny (produkty + dostawa)
        const tax = 0.23 * (this.productsTotal + deliveryPrice);

        // Dodaj 15% zniżki, jeśli wprowadzono kod rabatowy
        const discount = this.formDataPrivate.znizka > 0 ? this.formDataPrivate.znizka : 0;

        // Odlicz zniżkę od całkowitej ceny
        const totalPrice = this.productsTotal + deliveryPrice + tax - discount;

        this.tax = parseFloat(tax.toFixed(2));

        // Wyświetl informacje w konsoli
        console.log('Products Total:', this.productsTotal);
        console.log('Delivery Price:', deliveryPrice);
        console.log('Tax (23%):', tax);
        console.log('Discount:', discount);
        console.log('Total Price:', totalPrice.toFixed(2));

        return parseFloat(totalPrice.toFixed(2));
    },
  
selectOrderOption(index) {
  this.orderOptions.forEach((option, i) => {
    option.isActive = i === index;
  });

  if (this.orderOptions[index].isActive) {
    if (index === 0) {
      // Jeśli osoba prywatna, utwórz nowy obiekt formularza prywatnego
      this.formDataPrivate = {
        imie: '',
        nazwisko: '',
        email: '',
        telefon: '',
        kraj: 'Polska',
        ulica_i_numer_domu: '',
        miejscowosc: '',
        kod_pocztowy: '',
        faktura_imie: '',
        faktura_nazwisko: '',
        faktura_ulica_i_numer_domu: '',
        faktura_miejscowosc: '',
        faktura_kod_pocztowy: '',
      };
      this.showInvoiceForm = false;
    } else {
      // Jeśli firma, utwórz nowy obiekt formularza firmowego
      this.formDataCompany = {
        nip: '',
        nazwa_firmy: '',
        ulica_i_numer_domu: '',
        miejscowosc: '',
        kod_pocztowy: '',
        faktura_imie: '',
        faktura_nazwisko: '',
        faktura_email: '',
        faktura_telefon: '',
        faktura_kraj: 'Polska',
        faktura_ulica_i_numer_domu: '',
        faktura_miejscowosc: '',
        faktura_kod_pocztowy: '',
      };
      this.showInvoiceForm = true;
    }
  }
},
    selectPayment(index) {
      this.paymentOptions.forEach((payment, i) => {
        payment.selected = i === index;
      });
    },

    selectPayment(index) {
      // Sprawdź, czy opcja dostawy jest już zaznaczona
      if (!this.paymentOptions[index].selected) {
        this.paymentOptions.forEach((delivery, i) => {
          delivery.selected = i === index;
        });

        // Aktualizuj łączną cenę w zależności od wybranej opcji dostawy
        this.totalPrice = this.calculateTotalPrice();
      }
    },

    generateOrderNumber() {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
    const day = currentDate.getDate().toString().padStart(2, '0');

    const randomString = this.generateRandomString(12).toUpperCase();

    // Zmiana formatu daty
    return `${randomString}/${day}-${month}-${year}`;
},

  generateRandomString(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    const charactersLength = characters.length;

    for (let i = 0; i < length; i++) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }

    return result;
  }
    
  },
  
  //Vuex
  computed: {
    ...mapState(['addedProducts', 'totalPrice']),
    ...mapGetters(['cartProducts', 'totalPrice']),
  totalPrice() {
      return this.calculateTotalPrice();
    },
    formattedProductNames() {
      return this.cartProducts.map(product => product.nazwa).join(', ');
    },
    isPrivacyPolicyAccepted() {
    return this.privacyPolicyAccepted;
  },
},
}
</script>
  
<style lang="scss" scoped>
    .order {
        padding-top: 7rem;
        .order-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .order-heading {
                h2 {
                    font-size: 32px;
                    color: var(--dark-beige);
                    margin-bottom: 1rem;
                }
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
                    border-radius: 10px;
                    margin-bottom: 2rem;
                }
            }
            .order-columns {
                display: flex;
                justify-content: space-between;
                .order-left {
                    width: 70%;
                    .form-private {
                        display: none;
                        &.active {
                            display: block;
                        }
                    }
                    .form-invoice {
                        display: none;
                        &.active {
                            display: block;
                        }
                    }
                    .order-delivery {
                        .order-delivery-box:not(:first-child) {
                            border-left: 1px solid var(--dark-beige);
                            border-right: 1px solid var(--dark-beige);
                            border-bottom: 1px solid var(--dark-beige);
                        }
                        .order-delivery-box:last-child {
                            border-bottom-left-radius: 10px;
                            border-bottom-right-radius: 10px;
                        }
                        .order-delivery-box:first-child {
                            border-left: 1px solid var(--dark-beige);
                            border-right: 1px solid var(--dark-beige);
                            border-top: 1px solid var(--dark-beige);
                            border-bottom: 1px solid var(--dark-beige);
                            border-top-left-radius: 10px;
                            border-top-right-radius: 10px;
                        }
                        .order-delivery-box {
                            cursor: pointer;
                            &.active {
                                border-left: 2px solid var(--dark-beige);
                            border-right: 2px solid var(--dark-beige);
                            border-top: 2px solid var(--dark-beige);
                            border-bottom: 2px solid var(--dark-beige);
                            p {
                                font-weight: 600;
                            }
                            }
                            .order-delivery-box-content {
                                width: 95%;
                                margin-left: auto;
                                margin-right: auto;
                                display: flex;
                                align-items: center;
                                padding-top: 1rem;
                                padding-bottom: 1rem;
                                .checkbox {
                                    input {
                                        width: 15px;
                                        height: 15px;
                                        margin-right: 1rem;
                                    }
                                    input[type="checkbox"] {
                                        cursor: pointer;
                                        accent-color: var(--black);
                                    }
                                }
                                p {
                                    font-size: 20px;
                                }
                            }
                        }
                    }
                    .order-heading {
                        margin-top: 2rem;
                        h2 {
                            font-size: 40px;
                            color: var(--black);
                        }
                        p {
                           font-size: 20px; 
                           margin-bottom: 1rem;
                        }
                        hr {
                            width: 150px;
                            height: 3px;
                            background-color: var(--dark-beige);
                            border: none;
                            border-radius: 10px;
                            margin-bottom: 1rem;
                        }
                    }
                    .order-option {
                        display: flex;
                        justify-content: space-between;
                        .order-option-box {
                            width: 48%;
                            padding-top: 1rem;
                            padding-bottom: 1rem;
                            border: 1px solid var(--dark-beige);
                            border-radius: 10px;
                            cursor: pointer;
                            &.active {
                                border: 2px solid var(--dark-beige);
                                p {
                                    font-weight: 600;
                                }
                            }
                            .order-option-content {
                                width: 95%;
                                margin-left: auto;
                                margin-right: auto;
                                p {
                                    font-size: 20px;
                                    color: var(--black);
                                }
                            }
                        }
                    }
                    .order-inputs {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 2rem;
                        input {
                            width: 48%;
                            padding-top: 0.5rem;
                            padding-bottom: 0.5rem;
                            font-size: 20px;
                            background-color: none;
                            border: none;
                            border-bottom: 1px solid var(--dark-beige);
                        }
                    }
                    .order-full-width {
                        margin-bottom: 2rem;
                        select {
                            width: 100%;
                            padding-top: 0.5rem;
                            padding-bottom: 0.5rem;
                            font-size: 20px;
                            background-color: none;
                            border: none;
                            border-bottom: 1px solid var(--dark-beige);
                        }
                        input {
                            width: 100%;
                            padding-top: 0.5rem;
                            padding-bottom: 0.5rem;
                            font-size: 20px;
                            background-color: none;
                            border: none;
                            border-bottom: 1px solid var(--dark-beige);
                        }
                    }
                    .invoice {
                        .invoice-checkbox {
                            display: flex;
                            align-items: center;
                            margin-bottom: 2rem;
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
                            }
                        }
                        .invoice-form {
                            display: none;
                            &.active {
                                display: block;
                            }
                        }
                    }
                    .accept-statement {
                        .checkbox {
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
                                }
                                p {
                                    font-size: 20px;
                                    a {
                                        color: var(--black);
                                    }
                                    span {
                                        color: var(--dark-beige);
                                    }
                                }
                    }
                }
                .order-right {
                    width: 25%;
                    .order-cart {
                        border-radius: 10px;
                        border: 1px solid var(--dark-beige);
                        .order-cart-content {
                            width: 95%;
                            margin-left: auto;
                            margin-right: auto;
                            padding-top: 1rem;
                            padding-bottom: 1rem;
                            .order-cart-top {
                                h3 {
                                    font-size: 20px;
                                    font-weight: 400;
                                    margin-bottom: 1rem;
                                }
                            }
                            .order-cart-promote {
                                display: flex;
                                input {
                        width: 80%;
                        height: 30px;
                        border: none;
                        background-color: var(--transparent);
                        border-bottom: 1px solid var(--dark-beige);
                        font-size: 16px;
                        margin-bottom: 1rem;
                    }
                        .order-btn {
                            width: 200px;
                        height: 30px;
                        display: flex;
                        justify-content: space-between;
                        padding-left: 1rem;
                        align-items: center;
                        font-size: 16px;
                        border: 1px solid var(--dark-beige);
                        background-color: var(--white);
                        color: var(--dark-beige);
                        font-weight: 400;
                        cursor: pointer;
                        transition: 0.5s;
                        text-align: center;
                        div {
                            background-color: var(--transparent);
                            height: 30px;
                            width: 40px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-left: 1px solid var(--dark-beige);
                            transition: 0.5s;
                            svg {
                                stroke: var(--dark-beige);
                                background-color: var(--transparent);
                                transition: 0.5s;
                            }
                        }
                        &:hover {
                            background-color: var(--dark-beige);
                            color: var(--white);
                            div {
                                background-color: var(--dark-beige);
                                border-top: 1px solid var(--dark-beige);
                                border-bottom: 1px solid var(--dark-beige);
                                border-left: 1px solid var(--white);
                                svg {
                                    background-color: var(--transparent);
                                    stroke: var(--white);
                                }
                            }
                        }
                    }
                            }
                            .order-cart-info {
                                display: flex;
                                justify-content: space-between;
                                margin-bottom: 1rem;
                                p {
                                    font-size: 16px;
                                }
                            }
                            .order-cart-price {
                                display: flex;
                                justify-content: space-between;
                                margin-bottom: 1rem;
                                p {
                                    font-size: 20px;
                                }
                            }
                            .order-cart-button {
                                .order-cart-btn {
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
        .order {
            .order-content {
                .order-heading {
                    h2 {
                        font-size: 24px;
                    }
                    h1 {
                            font-size: 32px;
                    }
                }
                .order-columns {
                .order-left {
                    width: 60%;
                    .order-heading {
                        h2 {
                            font-size: 32px;
                        }
                    }
                }
                .order-right {
                    width: 35%;
                }
            }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .order {
            padding-top: 7rem;
        .order-content {
            .order-heading {
                hr {
                    width: 30%;
                }
            }
            .order-columns {
                flex-direction: column;
                .order-left {
                    width: 100%;
                    .order-option {
                        flex-direction: column;
                        .order-option-box {
                            width: 100%;
                        }
                        .order-option-box:first-child {
                            margin-bottom: 2rem;
                        }
                    }
                    .order-inputs {
                        flex-direction: column;
                        margin-bottom: 0;
                        input {
                            margin-bottom: 2rem;
                            width: 100%;
                        }
                    }
                }
                .order-right {
                    width: 100%;
                }
            }
        }
    }
    }

    @media screen and (max-width: 468px) {
        .order {
        .order-content {
            .order-heading {
                h2 {
                    font-size: 20px;
                }
                h1 {
                    font-size: 24px;
                }
                hr {
                    width: 30%;
                }
            }
            .order-columns {
                flex-direction: column;
                .order-left {
                    width: 100%;
                    .order-heading {
                        h2 {
                            font-size: 24px;
                        }
                    }
                }
                .order-right {
                    width: 100%;
                    .order-cart {
                        .order-cart-content {
                            .order-cart-button {
                                .order-cart-btn {
                                    font-size: 16px;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    }
</style>
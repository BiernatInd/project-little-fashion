import { createStore } from 'vuex';
import axios from 'axios'

const savedProducts = JSON.parse(localStorage.getItem('addedProducts'));
const savedTotalPrice = parseFloat(localStorage.getItem('totalPrice')) || 0;

const initialState = {
  // ... other initial state properties
  addedProducts: savedProducts || [],
  totalPrice: savedTotalPrice,
};

const store = createStore({
    state: {
      products: [],
      addedProducts: [],
      totalPrice: 0,
      //header
      userMenuActive: false,
      shoppingBagActive: false,
      mainMenuActive: false,
      shopSubMenuActive: false,
      ...initialState,
      orderData: {},
    },
    mutations: {
      SET_PRODUCTS(state, products) {
        state.products = products;
      },
      ADD_TO_CART(state, product) {
        const existingProduct = state.addedProducts.find(p => p.id === product.id);
      
        if (existingProduct) {
          if (existingProduct.quantity < existingProduct.stan_magazynowy) {
            existingProduct.quantity++;
          } else {
            console.warn('Nie można dodać więcej produktów, niż jest dostępne w magazynie.');
          }
        } else {
          const magazynowy = product.stan_magazynowy || 0; // Domyślnie przyjmuje 0, jeśli stan_magazynowy nie jest zdefiniowany.
          state.addedProducts.push({
            id: product.id,
            nazwa: product.nazwa,
            cena: product.cena,
            quantity: 1,
            stan_magazynowy: magazynowy,
          });
        }
      },
      REMOVE_FROM_CART(state, product) {
        const index = state.addedProducts.findIndex(p => p.id === product.id);
  
        if (index !== -1) {
          state.addedProducts.splice(index, 1);
        }
      },
      CALCULATE_TOTAL_PRICE(state) {
        const total = state.addedProducts.reduce((total, product) => {
          return total + product.cena * product.quantity;
        }, 0);
        // Zaokrąglanie do dwóch miejsc po przecinku
        state.totalPrice = parseFloat(total.toFixed(2));
      },
         //header
    setUserMenuActive(state, isActive) {
        state.userMenuActive = isActive;
        if (isActive) {
          state.shoppingBagActive = false;
          state.mainMenuActive = false;
        }
      },
      setShoppingBagActive(state, isActive) {
        state.shoppingBagActive = isActive;
        if (isActive) {
          state.userMenuActive = false;
          state.mainMenuActive = false;
        }
      },
      setMainMenuActive(state, isActive) {
        state.mainMenuActive = isActive;
        if (isActive) {
          state.userMenuActive = false;
          state.shoppingBagActive = false;
        }
      },
      setShopSubMenuActive(state, isActive) {  // Nowa mutacja dla aktywacji podmenu sklepu
          state.shopSubMenuActive = isActive;
        },
        //Przekazywanie danych do strona-koszyka
        //Czyszczenie koszyka
        CLEAR_CART(state) {
          state.addedProducts = [];
          state.totalPrice = 0;
        },

        //przekazywanie do podziekowanie-za-zamowienie.vue
        setOrderData(state, data) {
          state.orderData = data;
      },
    },
    actions: {
      async fetchProducts({ commit }) {
        try {
          const response = await axios.get('http://localhost:8000/api/produkty');
          console.log('Fetched products:', response.data.products);
          commit('SET_PRODUCTS', response.data.products);
        } catch (error) {
          console.error('Error fetching products:', error);
        }
      },
      addToCart({ commit, state }, product) {
        const existingProduct = state.addedProducts.find(p => p.id === product.id);
    
        if (existingProduct) {
          if (existingProduct.quantity < existingProduct.stan_magazynowy) {
            existingProduct.quantity++;
          } else {
            console.warn('Nie można dodać więcej produktów, niż jest dostępne w magazynie.');
          }
        } else {
          const magazynowy = product.stan_magazynowy || 0;
          const priceToAdd = product.cena_promocyjna !== null && product.cena_promocyjna !== undefined
            ? product.cena_promocyjna
            : product.cena;
    
          const imageToAdd = product.zdjecie_produktu_1 || '/default-image.jpg';
    
          state.addedProducts.push({
            id: product.id,
            nazwa: product.nazwa,
            cena: priceToAdd,
            quantity: 1,
            stan_magazynowy: magazynowy,
            zdjecie_produktu_1: imageToAdd, // Dodajemy właściwość zdjęcia do produktu
          });
        }
    
        commit('CALCULATE_TOTAL_PRICE');
    
        localStorage.setItem('addedProducts', JSON.stringify(state.addedProducts));
        localStorage.setItem('totalPrice', state.totalPrice);
      },
          removeFromCart({ commit, state }, product) {
            commit('REMOVE_FROM_CART', product);
            commit('CALCULATE_TOTAL_PRICE');
        
            // Zapisz dane do localStorage
            localStorage.setItem('addedProducts', JSON.stringify(state.addedProducts));
            localStorage.setItem('totalPrice', state.totalPrice);

            console.log('Dane zapisane do localStorage:', state.addedProducts, state.totalPrice);
          },
             //header
    setUserMenuActive({ commit }, isActive) {
        commit('setUserMenuActive', isActive);
      },
      setShoppingBagActive({ commit }, isActive) {
        commit('setShoppingBagActive', isActive);
      },
      setMainMenuActive({ commit }, isActive) {
        commit('setMainMenuActive', isActive);
      },
      setShopSubMenuActive({ commit }, isActive) {  // Nowa akcja dla aktywacji podmenu sklepu
          commit('setShopSubMenuActive', isActive);
        },
        //przekazanie danych do strona-koszyka
        setShoppingBagActive({ commit }, isActive) {
          commit('setShoppingBagActive', isActive);
        },
        //Czyszczenie koszyka
        clearCart({ commit }) {
          commit('CLEAR_CART');
        },

        setOrderData({ commit }, data) {
          commit('setOrderData', data);
      },
        },
      
    getters: {
        cartProducts: state => state.addedProducts,
        totalPrice: state => state.totalPrice,
    },
  });
  
  export default store;
<template>
    <MainHeader :addedProducts="addedProducts" :totalPrice="totalPrice" :removeFromCart="removeFromCart" />
     <div class="shop">
         <div class="shop-columns">
             <div class="shop-left">
                 <h2>Zobacz nasze produkty</h2>
                 <h1>Nasz sklep</h1>
                 <hr>
                 <router-link v-for="category in categories" :key="category.id" :to="'/sklep/' + category.sciezka_kategorii + '/1'"  :class="{ 'active': isCategoryActive(category.sciezka_kategorii) }" class="shop-left-link">{{ category.nazwa_kategorii }}</router-link>
             </div>
             <div class="shop-right">
                <div class="shop-right-box-container" v-for="(chunk, index) in chunkedProducts" :key="index">
                    <div class="shop-right-box" v-for="product in chunk" :key="product.id" @click="redirectToProductPage(product)">
                         <div class="shop-right-box-content">
                             <div class="shop-right-box-content-img">
                                <img :src="product.zdjecie_produktu_1" alt="">
                             </div>
                                <p>{{ product.nazwa }}</p>
                                <p class="price" :class="{ 'active': hasPromotionalPrice(product) }">
                                    {{ product.cena }} zł
                                </p>
                                <p class="promoted-price" v-if="hasPromotionalPrice(product)">
                                    {{ product.cena_promocyjna }} zł
                                </p>
                            <p v-if="product.stan_magazynowy === 0">Brak na stanie magazynowym</p>
                             <div class="shop-right-box-button">
                                <button class="shop-right-box-btn" @click.stop="addToCartAndActivateShoppingBag(product)" :disabled="product.stan_magazynowy === 0">
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
                 <div class="pagination">
                    <div class="pagination-col" v-for="(page, pageIndex) in pageCount" :key="pageIndex + 1" :class="{ active: isPageActive(pageIndex) }">
                        <router-link :to="'/sklep/' + getCategoryNameFromPath() + '/' + (pageIndex + 1)" @click="handlePageClick(pageIndex)">
                          <p>{{ pageIndex + 1 }}</p>
                        </router-link>
                    </div>
                 </div>
             </div>
            <div class="shop-right-no-products" v-if="chunkedProducts.length === 0">
               <p>Niestety aktualnie nie posiadamy produktów z kategorii: {{ currentCategory }}</p>
            </div>
         </div>
     </div>
     <MainFooterTop />
     <MainFooterBottom />
 </template>
 
 <script>
 import MainHeader from '../components/main/main-header.vue';
 import MainFooterTop from '../components/main/main-footer-top.vue';
 import MainFooterBottom from '../components/main/main-footer-bottom.vue';
 import { mapState, mapActions } from 'vuex';

 import axios from 'axios';
 
 export default {
   components: {
     MainHeader,
     MainFooterTop,
     MainFooterBottom,
   },
   data() {
    return {
      categories: [],
      products: [],
      currentPage: 1,
    };
  },
   methods: {
    redirectToProductPage(product) {
        // Use the router to navigate to the product page
        this.$router.push('/strona-produktu/' + product.id );
    },
    hasPromotionalPrice(product) {
      return product.cena_promocyjna !== null && product.cena_promocyjna !== undefined;
    },
    displayedPrice(product) {
      return this.hasPromotionalPrice(product) ? product.cena_promocyjna : product.cena;
    },
    isCategoryActive(categoryPath) {
      // Sprawdź, czy aktualna ścieżka routingu pasuje do ścieżki kategorii
      return this.$route.path.includes('/sklep/' + categoryPath);
    },
    isPageActive(pageIndex) {
    return pageIndex + 1 === parseInt(this.$route.params.page);
  },

  handlePageClick(pageIndex) {
    this.$router.push('/sklep/' + this.getCategoryNameFromPath() + '/' + (pageIndex + 1));
  },
    ...mapActions(['fetchProducts', 'addToCart', 'removeFromCart', 'setShoppingBagActive']),
     addToCartAndActivateShoppingBag(product) {
       this.addToCart(product);
       this.setShoppingBagActive(true);
     },
     async fetchCategories() {
   try {
      const response = await axios.get('http://localhost:8000/api/lista-kategorii');
      this.categories = response.data.kategorie; // Poprawka: przypisanie konkretnego pola z odpowiedzi
      console.log('Categories:', this.categories);
   } catch (error) {
      console.error('Error fetching categories:', error);
   }
},
chunkArray(array, size) {
    const chunkedArray = [];
    for (let i = 0; i < array.length; i += size) {
      chunkedArray.push(array.slice(i, i + size));
    }
    return chunkedArray;
  },
  getCategoryNameFromPath() {
        const pathSegments = this.$route.path.split('/');
        const categorySegmentIndex = pathSegments.indexOf('sklep') + 1;

        // Sprawdź, czy indeks kategorii jest poprawny i czy kategoria istnieje w danych
        if (categorySegmentIndex < pathSegments.length && this.categories.length > 0) {
            const categoryName = pathSegments[categorySegmentIndex];
            return categoryName;
        }

        return null;
    },
   },
   computed: {

    pageCount() {
    const filteredProducts = this.currentCategory
        ? this.$store.state.products.filter(product => product.kategoria === this.currentCategory)
        : this.$store.state.products;

    const totalProducts = filteredProducts.length;
    const productsPerPage = 12;
    const pages = Math.ceil(totalProducts / productsPerPage);

    // Zwróć tablicę indeksów stron w zależności od dostępnych stron
    return Array.from({ length: pages }, (_, index) => index + 1);
},

    ...mapState(['products', 'addedProducts', 'totalPrice']),
    
    chunkedProducts() {
    const filteredProducts = this.currentCategory
      ? this.$store.state.products.filter(product => product.kategoria === this.currentCategory)
      : this.$store.state.products;
      
      // Get the current page from the route params or default to 1
      const currentPage = parseInt(this.$route.params.page) || 1;

      // Calculate the start and end indices for the products based on the current page
      const startIdx = (currentPage - 1) * 12;
      const endIdx = currentPage * 12;

      // Slice the products array based on the calculated indices
      const slicedProducts = filteredProducts.slice(startIdx, endIdx);

      // Podziel produkty na grupy po maksymalnie 4 w jednej grupie
      return this.chunkArray(slicedProducts, 4);
    },

    currentCategory() {
    const pathSegments = this.$route.path.split('/');
    const categorySegmentIndex = pathSegments.indexOf('sklep') + 1;

    // Sprawdź, czy indeks kategorii jest poprawny i czy kategoria istnieje w danych
    if (categorySegmentIndex < pathSegments.length && this.categories.length > 0) {
      const categoryName = pathSegments[categorySegmentIndex];

      // Znajdź kategorię po nazwie
      const selectedCategory = this.categories.find(category => category.sciezka_kategorii === categoryName);

      return selectedCategory ? selectedCategory.nazwa_kategorii : null;
    }

    return null;
  },

    products() {
    return this.$store.state.products;
  },
  addedProducts() {
    return this.$store.state.addedProducts;
  },
  totalPrice() {
    return this.$store.state.totalPrice;
  },
   },
   mounted() {
    // Pobierz kategorie po załadowaniu komponentu
    this.fetchCategories();
   this.fetchProducts();
   console.log('Vuex state:', this.products, this.addedProducts, this.totalPrice);
  },
  
 };
 </script>
  
<style lang="scss" scoped>
    .shop {
        padding-top: 7rem;
        .shop-columns {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            .shop-left {
                width: 20%;
                display: flex;
                flex-direction: column;
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
                    margin-bottom: 1rem;
                    border-radius: 10px;
                }
                .shop-left-link {
                    margin-bottom: 1rem;
                    font-size: 24px;
                    color: var(--black);
                    text-decoration: none;
                    transition: 0.5s;
                    &:hover {
                        color: var(--dark-beige);
                    }
                    &.active {
                        color: var(--dark-beige);
                        text-decoration: underline;
                        text-underline-offset: 4px;
                    }
                }
            }
            .shop-right-no-products {
                width: 75%;
                display: flex;
                justify-content: flex-end;
                p {
                    font-size: 32px;
                    text-decoration: underline;
                    text-underline-offset: 4px;
                }
            }
            .shop-right {
                width: 75%;
                .shop-right-box-container {
                    display: flex;
                    justify-content: space-between;
                    .shop-right-box {
                        width: 22%;
                        height: 100%;
                        border: 1px solid var(--dark-beige);
                        border-radius: 10px;
                        cursor: pointer;
                        .shop-right-box-content {
                            width: 90%;
                            margin-left: auto;
                            margin-right: auto;
                            padding-bottom: 1rem;
                            .shop-right-box-content-img {
                                display: flex;
                                justify-content: center;
                                padding-top: 1rem;
                                padding-bottom: 1rem;
                                img {
                                    width: 175px;
                                    height: 280px;
                                    border-radius: 5px;
                                }
                            }
                            p {
                                font-size: 20px;
                                margin-bottom: 1rem;
                            }
                            .price {
                                font-size: 20px;
                                margin-bottom: 1rem;
                                &.active {
                                    text-decoration: line-through;
                                }
                            }
                            .promoted-price {
                                font-size: 20px;
                                margin-bottom: 1rem;
                            }
                            .shop-right-box-button {
                                .shop-right-box-btn {
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
                .shop-right-box-container:not(:last-child) {
                margin-bottom: 2rem;
            }
            .pagination {
                display: flex;
                .pagination-col:last-child {
                    border-right: 1px solid var(--dark-beige);
                }
                .pagination-col {
                    width: 40px;
                    height: 40px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: 0.5s;
                    text-decoration: none;
                    border-left: 1px solid var(--dark-beige);
                    border-top: 1px solid var(--dark-beige);
                    border-bottom: 1px solid var(--dark-beige);
                    a {
                        text-decoration: none;
                    }
                    &.active {
                        background-color: var(--dark-beige);
                        a {
                            p {
                                color: var(--white);
                            }
                        }
                    }
                    svg {
                        stroke: var(--dark-beige);
                    }
                    p {
                        font-size: 20px;
                        color: var(--dark-beige);
                    }
                    &:hover {
                        background-color: var(--dark-beige);
                        p {
                            color: var(--white);
                        }
                        svg {
                            stroke: var(--white);
                        }
                    }
                }
            }
            }
        }
    }
    
    @media screen and (max-width: 1600px) {
        .shop {
            .shop-columns {
                .shop-left {
                    width: 15%;
                    h2 {
                        font-size: 24px;
                    }
                    h1 {
                        font-size: 32px;
                    }
                    .shop-left-link 
                    {
                        font-size: 20px;
                    }
                }
                .shop-right-no-products {
                    width: 80%;
                }
                .shop-right {
                    width: 80%;
                    .shop-right-box-container {
                        .shop-right-box {
                            .shop-right-box-content {
                                .shop-right-box-button {
                                    .shop-right-box-btn {
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

    @media screen and (max-width: 1400px) {
        .shop {
            padding-top: 7rem;
            .shop-columns {
                flex-direction: column;
                .shop-left {
                    width: 100%;
                    padding-bottom: 1rem;
                }
                .shop-right-no-products {
                    width: 100%;
                    justify-content: flex-start;
                }
                .shop-right {
                    width: 100%;
                    .shop-right-box-container {
                        .shop-right-box {
                            width: 23%;
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .shop {
            .shop-columns {
                .shop-right-no-products {
                    margin-left: auto;
                    margin-right: auto;
                }
                .shop-right {
                    margin-left: auto;
                    margin-right: auto;
                    .shop-right-box-container {
                        display: flex;
                        flex-direction: column;
                        margin-bottom: 0;
                        .shop-right-box {
                            width: 80%;
                            margin-right: auto;
                        }
                        .shop-right-box:not(:last-child) {
                            margin-bottom: 2rem;
                        }
                    }
                    .pagination {
                        display: flex;
                        .pagination-col {
                            width: 30px;
                            height: 30px;
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 468px) {
        .shop {
            .shop-columns {
                .shop-left {
                    h1 {
                        font-size: 24px;
                    }
                    h2 {
                        font-size: 20px;
                    }
                    .shop-left-link {
                        font-size: 16px;
                    }
                }
                .shop-right-no-products {
                    p {
                        font-size: 24px;
                    }
                }
                .shop-right {
                    .shop-right-box-container {
                        display: flex;
                        flex-direction: column;
                        margin-bottom: 0;
                        .shop-right-box {
                            width: 80%;
                            margin-right: auto;
                            .shop-right-box-content {
                                p {
                                    font-size: 16px;
                                }
                            }
                        }
                        .shop-right-box:not(:last-child) {
                            margin-bottom: 2rem;
                        }
                    }
                }
            }
        }
    }
</style>
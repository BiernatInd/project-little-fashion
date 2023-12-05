<template>
  <div class="top-bar">
    <div class="top-bar-content">
            <div class="top-bar-left">
              <img src="../../assets/icons/1.svg" alt="">
                <p>Sprawdź nasze promocje!</p>
              </div>
              <div class="top-bar-right">
                <img src="../../assets/icons/2.svg" alt="">
                <p>Darmowa dostawa od 200.00 zł</p>
                <img src="../../assets/icons/3.svg" alt="">
                <p>Dostawa do 24 godzin!</p>
              </div>
            </div>
    </div>
    <header class="header" :class="{ sticky: isHeaderSticky }">
      <nav class="nav">
        <div class="nav-user">
          <img src="../../assets/icons/4.svg" alt="" @click="toggleUserMenu">
        </div>
        <div class="nav-logo">
          <router-link to="/">
            <img src="../../assets/header-logo.svg" alt="">
          </router-link>
        </div>
        <div class="nav-right">
              <img src="../../assets/icons/5.svg" alt="" @click="toggleShoppingBag">
                <div class="nav-menu">
                  <div class="wrapper-menu" @click="toggleMainMenu" :class="{ 'active': mainMenuActive }">
                    <div class="line-menu half start"></div>
                    <div class="line-menu"></div>
                    <div class="line-menu half end"></div>
                  </div>
                </div>
              </div>
            </nav>
          </header>
          <MainSlideUser />
          <MainSlideMenu  />
          <MainShoppingBag v-if="!['/strona-koszyka', '/strona-zamowienia', '/podziekowanie-za-zamowienie'].includes($route.path)" />
</template>
  
<script>

import MainSlideUser from './main-slide-user.vue';
import MainSlideMenu from './main-slide-menu.vue';
import MainShoppingBag from './main-shopping-bag.vue';
import { mapState, mapActions } from 'vuex';

export default {
  components: {
    MainSlideUser,
    MainSlideMenu,
    MainShoppingBag
  },
  data() {
      return {
        isHeaderSticky: false,
      }
    },
  computed: {
    ...mapState(['userMenuActive', 'shoppingBagActive', 'mainMenuActive'])
  },
  methods: {
    ...mapActions(['setUserMenuActive', 'setShoppingBagActive', 'setMainMenuActive']),
    toggleUserMenu() {
      this.setUserMenuActive(!this.userMenuActive);
    },
    toggleShoppingBag() {
      // Sprawdzamy, czy bieżąca ścieżka to 'strona-koszyka'
      if (this.$route.path !== '/strona-koszyka') {
        this.setShoppingBagActive(!this.shoppingBagActive);
      }
      if (this.$route.path !== '/strona-zamowienia') {
        this.setShoppingBagActive(!this.shoppingBagActive);
      }
      if (this.$route.path !== '/podziekowanie-za-zamowienie') {
        this.setShoppingBagActive(!this.shoppingBagActive);
      }
    },
    toggleMainMenu() {
      this.setMainMenuActive(!this.mainMenuActive);
    },
    closeMainMenu() {
      this.setMainMenuActive(false);
    },
    handleScroll() {
    console.log('ScrollY:', window.scrollY);
    if (window.scrollY > 0) {
      this.isHeaderSticky = true;
    } else {
      this.isHeaderSticky = false;
    }
    console.log('isHeaderSticky:', this.isHeaderSticky);
  },
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
    // Dodajemy klasę "active" do wrapper-menu przy starcie komponentu, jeśli mainMenuActive jest true
    if (this.mainMenuActive) {
      this.$nextTick(() => {
        document.querySelector('.wrapper-menu').classList.add('active');
      });
    }
  }
};
</script>

  
<style lang="scss" scoped>
    .top-bar {
        display: flex;
        align-items: center;
        border-bottom: 1px solid rgb(42, 41, 40, 0.3);
        padding-top: 1rem;
        padding-bottom: 1rem;
        max-width: 1920px;
        background-color: var(--white);
        .top-bar-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            .top-bar-left {
                display: flex;
                img {
                    margin-right: 1rem;
                }
                p {
                    color: var(--dark-beige);
                }
            }
            .top-bar-right {
                display: flex;
                p {
                    font-size: 16px;
                    color: var(--dark-beige);
                }
                img:first-child {
                    margin-right: 1rem;
                }
                p:nth-child(2) {
                    margin-right: 1rem;
                }
                img:nth-child(3) {
                    margin-right: 1rem;
                } 
            }
        }
    }
    .header {
        border-bottom: 1px solid rgb(42, 41, 40, 0.3);
        height: 80px;
        display: flex;
        align-items: center;
        position: fixed;
        width: 100%;
        top: 52px;
        transition: top 0.5s;
        max-width: 1920px;
        background-color: var(--white);
        z-index: 998;
        &.sticky {
            top: 0;
        }
        .nav {
            width: 95%;
            display: flex;
            margin-left: auto;
            margin-right: auto;
            justify-content: space-between;
            align-items: center;
            .nav-user {
                img {
                    cursor: pointer;
                    margin-right: 1rem;
                }
            }
            .nav-right {
                display: flex;
                img {
                    margin-right: 1rem;
                    cursor: pointer;
                }
                .nav-menu {
                    .wrapper-menu {
              width: 20px;
              height: 20px;
              display: flex;
              flex-direction: column;
              justify-content: space-between;
              cursor: pointer;
              transition: transform 330ms ease-out;
            }
    
            .wrapper-menu.active {
              transform: rotate(-45deg);  
            }
    
            .line-menu {
              border-radius: 5px;
              width: 100%;
              height: 2px;
            }
    
            .line-menu:nth-child(1) {
              background-color: var(--dark-beige);
            }
            .line-menu:nth-child(2) {
              background-color: var(--dark-beige);
            }
            .line-menu:nth-child(3) {
              background-color: var(--dark-beige);
            }
    
            .line-menu.half {
              width: 50%;
            }
    
            .line-menu.start {
              transition: transform 330ms cubic-bezier(0.54, -0.81, 0.57, 0.57);
              transform-origin: right;
            }
    
            .active .line-menu.start {
              transform: rotate(-90deg) translateX(3px);
            }
    
            .line-menu.end {
              align-self: flex-end;
              transition: transform 330ms cubic-bezier(0.54, -0.81, 0.57, 0.57);
              transform-origin: left;
            }
    
            .active .line-menu.end {
              transform: rotate(-90deg) translateX(-3px);
            }
                }
            }
        }
    }
    
    @media screen and (max-width: 1024px) {
        .top-bar {
            display: none;
        }
        .header {
            top: 0;
        }
    }


</style>
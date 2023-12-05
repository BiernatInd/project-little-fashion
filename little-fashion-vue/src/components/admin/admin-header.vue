<template>
<header class="header" :class="{ sticky: isHeaderSticky }">
      <nav class="nav">
        <div class="nav-user">
          <img src="../../assets/icons/4.svg" alt="" @click="toggleUserMenu" :class="{ active: isActive }">
        </div>
        <div class="nav-logo">
          <router-link to="/">
            <img src="../../assets/header-logo.svg" alt="">
          </router-link>
        </div>
        <div class="nav-right">
                <div class="nav-menu">
                  <div class="wrapper-menu" @click="toggleMainMenu" ref="hamburger">
                    <div class="line-menu half start"></div>
                    <div class="line-menu"></div>
                    <div class="line-menu half end"></div>
                  </div>
                </div>
              </div>
            </nav>
          </header>
          <AdminSlideLeft :isActive="isActive" @toggleUserMenu="toggleUserMenu" />
          <AdminSlideMenu :isMainMenuActive="isMainMenuActive" @toggleMainMenu="toggleMainMenu" />
</template>
    
<script>
import AdminSlideLeft from './admin-slide-left.vue';
import AdminSlideMenu from './admin-slide-menu.vue';

export default {
  components: {
    AdminSlideLeft,
    AdminSlideMenu,
  },
  data() {
    return {
      isHeaderSticky: false,
      isActive: false, // Aktywność menu użytkownika
      isMainMenuActive: false, // Aktywność main-menu
      activeMenu: null,
    };
  },
  methods: {
  handleScroll() {
    console.log('ScrollY:', window.scrollY);
    if (window.scrollY > 0) {
      this.isHeaderSticky = true;
    } else {
      this.isHeaderSticky = false;
    }
    console.log('isHeaderSticky:', this.isHeaderSticky);
  },
  toggleUserMenu() {
  this.isActive = !this.isActive;
  this.$refs.hamburger.classList.remove('active'); // Usuń klasę "active" z "wrapper-menu"
  if (this.isActive) {
    this.isShoppingBagActive = false;
    this.isMainMenuActive = false;
  }
},
    toggleMainMenu() {
  this.isMainMenuActive = !this.isMainMenuActive;
  if (this.isMainMenuActive) {
    this.isActive = false;
    this.isShoppingBagActive = false;
    this.$refs.hamburger.classList.add('active');
  } else {
    this.$refs.hamburger.classList.remove('active');
  }
  console.log('Hamburger element:', this.$refs.hamburger);
}

},

mounted() {
  window.addEventListener('scroll', this.handleScroll);
},
};
</script>
    
  <style lang="scss" scoped>
  
      .header {
          border-bottom: 1px solid rgb(42, 41, 40, 0.3);
          height: 80px;
          display: flex;
          align-items: center;
          position: fixed;
          width: 100%;
          top: 0px;
          transition: top 0.5s;
          max-width: 1920px;
          z-index: 99;
          background-color: var(--white);
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
          .header {
              top: 0;
          }
      }
  
  
  </style>
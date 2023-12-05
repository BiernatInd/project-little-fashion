<template>
   <div class="user-menu" :class="{ active: userMenuActive, sticky: isMenuSticky }">
        <div class="user-menu-content">
            <div class="user-menu-top">
                <div class="user-menu-main">
                    <img src="../../assets/header-logo.svg" alt="">
                    <img src="../../assets/icons/6.svg" alt="" @click="removeActiveClass">
                </div>
                <div class="user-menu-links">
                    <div class="user-menu-link">
                        <router-link to="/logowanie">Zaloguj się</router-link>
                    </div>
                    <div class="user-menu-link">
                        <router-link to="/rejestracja">Zarejestruj się</router-link>
                    </div>
                </div>
            </div>
            <div class="user-menu-bottom">
                <div class="user-menu-links">
                    <div class="user-menu-link">
                        <router-link to="/polityka-prywatnosci">Polityka prywatności</router-link>
                    </div>
                    <div class="user-menu-link">
                        <router-link to="/polityka-cookies">Polityka cookies</router-link>
                    </div>
                    <div class="user-menu-link">
                        <router-link to="/regulamin">Regulamin</router-link>
                    </div>
                    <div class="user-menu-link">
                        <router-link to="/odstapienie">Formularz odstąpienia od umowy</router-link>
                    </div>
                </div>
                <div class="user-menu-icons">
                    <img src="../../assets/icons/7.svg" alt="">
                    <img src="../../assets/icons/8.svg" alt="">
                    <img src="../../assets/icons/9.svg" alt="">
                    <img src="../../assets/icons/10.svg" alt="">
                    <img src="../../assets/icons/11.svg" alt="">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  computed: {
    ...mapState(['userMenuActive'])
  },
  data() {
    return {
      isMenuSticky: false,
    };
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
  },
  destroyed() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    ...mapActions(['setUserMenuActive']),
    toggleUserMenu() {
      this.setUserMenuActive(!this.userMenuActive);
    },
    removeActiveClass() {
      this.setUserMenuActive(false);
      const userMenuElement = document.querySelector('.user-menu');
      if (userMenuElement) {
        userMenuElement.classList.remove('active');
      }
    },
    handleScroll() {
      const scrollY = window.scrollY;
      // Ustaw wysokość, po której chcesz dodać klasę "sticky"
      const scrollThreshold = 1;
      
      if (scrollY > scrollThreshold && !this.isMenuSticky) {
        this.isMenuSticky = true;
      } else if (scrollY <= scrollThreshold && this.isMenuSticky) {
        this.isMenuSticky = false;
      }
    },
  }
};
</script>
  
<style lang="scss" scoped>
    .user-menu {
        position: fixed;
        top: 52px;
        left: -100%;
        width: 400px;
        height: 100%;
        border-right: 1px solid rgb(42, 41, 40, 0.3);
        transition: 0.5s;
        background-color: var(--white);
        z-index: 998;
        &.active {
            left: 0;
        }
        &.sticky {
            top: 0;
            .user-menu-content {
                height: 100%;
            }
        }
        .user-menu-content {
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            height: calc(100% - 52px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: 0.5s;
            .user-menu-top {
                .user-menu-main {
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    display: flex;
                    justify-content: space-between;
                    img:last-child {
                        cursor: pointer;
                        user-select: none;
                    }
                }
                .user-menu-links {
                    .user-menu-link {
                        a {
                            font-size: 20px;
                            color: var(--black);
                            text-transform: uppercase;
                            text-decoration: none;
                            transition: 0.5s;
                            &:hover {
                                color: var(--dark-beige);
                            }
                        }
                    }
                    .user-menu-link:first-child {
                        padding-top: 0.5rem;
                        padding-bottom: 0.5rem;
                    }
                }
            }
            .user-menu-bottom {
                height: 50%;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                .user-menu-links {
                    .user-menu-link {
                        padding-bottom: 1rem;
                        a {
                            font-size: 16px;
                            color: var(--black);
                            text-transform: uppercase;
                            text-decoration: none;
                            transition: 0.5s;
                            &:hover {
                                color: var(--dark-beige);
                            }
                        }
                    }
                }
                .user-menu-icons {
                    padding-bottom: 1rem;
                    img {
                        margin-right: 1rem;
                        cursor: pointer;
                        transition: 0.5s;
                        &:hover {
                            transform: rotate(360deg);
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .user-menu {
            width: 60%;
            top: 0px;
            height: 100%;
            .user-menu-content {
                height: 100%;
            }
        }
    }

    @media screen and (max-width: 468px) {
        .user-menu {
            width: 80%;
            .user-menu-content {
                .user-menu-top {
                    .user-menu-links {
                        .user-menu-link {
                            a {
                                font-size: 16px;
                            }
                        }
                    }
                }
                .user-menu-bottom {
                    .user-menu-links {
                        .user-menu-link {
                            a {
                                font-size: 14px;
                            }
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 320px) {
        .user-menu {
            width: 75%;
            .user-menu-content {
                .user-menu-bottom {
                    .user-menu-icons {
                        img {
                            margin-right: 0.5rem;
                        }
                    }
                }
            }
        }
    }

</style>
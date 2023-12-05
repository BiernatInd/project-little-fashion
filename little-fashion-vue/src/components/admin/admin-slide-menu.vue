<template>
    <MainHeader />
    <div class="main-menu" :class="{ sticky: isMenuSticky, active: isMainMenuActive }">
        <div class="main-menu-content">
            <div class="main-menu-top">
                <div class="main-menu-main">
                    <img src="../../assets/header-logo.svg" alt="">
                    <img src="../../assets/icons/6.svg" alt="" @click="removeActiveClass">
                </div>
                <div class="main-menu-links">
                    <div class="main-menu-link">
                        <router-link to="/">Strona główna</router-link>
                    </div>
                    <div class="main-menu-link">
                        <router-link to="/o-naszej-firmie">O naszej firmie</router-link>
                    </div>
                    <div class="main-menu-link">
                        <router-link to="/faq">Faq</router-link>
                    </div>
                    <div class="main-menu-link" @click="toggleChildMenu('sklep')">
                        <a>Nasz sklep</a>
                        <img src="../../assets/icons/12.svg" alt="">
                    </div>
                    <div class="main-menu-link-child" :class="{ active: activeChildMenu === 'sklep' }">
                          <router-link to="/sklep/ubranka-dla-lalek/1">Ubranka dla lalek</router-link>
                    </div>
                    <div class="main-menu-link-child" :class="{ active: activeChildMenu === 'sklep' }">
                          <router-link to="/sklep/scrunchies/1">Scrunchies</router-link>
                    </div>
                    <div class="main-menu-link-child" :class="{ active: activeChildMenu === 'sklep' }">
                          <router-link to="/sklep/turbany/1">Turbany</router-link>
                    </div>
                    <div class="main-menu-link-child" :class="{ active: activeChildMenu === 'sklep' }">
                          <router-link to="/sklep/promocje/1">Promocje</router-link>
                    </div>
                    <div class="main-menu-link">
                        <router-link to="/blog">Blog</router-link>
                    </div>
                    <div class="main-menu-link">
                        <router-link to="/galeria">Galeria</router-link>
                    </div>
                    <div class="main-menu-link">
                        <router-link to="/kontakt">Kontakt</router-link>
                    </div>
                </div>
            </div>
            <div class="main-menu-bottom">
                <div class="main-menu-links">
                    <div class="main-menu-link">
                        <router-link to="/polityka-prywatnosci">Polityka prywatności</router-link>
                    </div>
                    <div class="main-menu-link">
                        <router-link to="/polityka-cookies">Polityka cookies</router-link>
                    </div>
                    <div class="main-menu-link">
                        <router-link to="/regulamin">Regulamin</router-link>
                    </div>
                    <div class="main-menu-link">
                        <router-link to="/odstapienie">Formularz odstąpienia od umowy</router-link>
                    </div>
                </div>
                <div class="main-menu-icons">
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
export default {
    props: {
    isMainMenuActive: Boolean,
  },
    data() {
        return {
      isMenuSticky: false,
      activeChildMenu: null,
    };
},
  methods: {
    handleScroll() {
      console.log('ScrollY:', window.scrollY);
      if (window.scrollY > 0) {
        this.isMenuSticky = true;
      } else {
        this.isMenuSticky = false;
      }
      console.log('isMenuSticky:', this.isMenuSticky);
    },
    toggleChildMenu(menuName) {
        if (this.activeChildMenu === menuName) {
            this.activeChildMenu = null;
        } else {
            this.activeChildMenu = menuName;
        }

        // Dodawanie klasy "active" do czwartego .main-menu-link
        const fourthMainLink = document.querySelector('.main-menu-link:nth-child(4)');
        if (fourthMainLink) {
            fourthMainLink.classList.toggle('active');
        }
    },
    removeActiveClass() {
            this.$emit("toggleMainMenu");
        },
  },

  mounted() {
    window.addEventListener('scroll', this.handleScroll);
  },
};
</script>
  
<style lang="scss" scoped>
    .main-menu {
        position: fixed;
        top: 0px;
        right: -100%;
        width: 400px;
        height: 100%;
        border-left: 1px solid rgb(42, 41, 40, 0.3);
        transition: 0.5s;
        background-color: var(--white);
        z-index: 998;
        &.active {
            right: 0;
        }
        &.sticky {
            top: 0;
            .main-menu-content {
                height: 100%;
            }
        }
        .main-menu-content {
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: 0.5s;
            .main-menu-top {
                .main-menu-main {
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                    display: flex;
                    justify-content: space-between;
                    img:last-child {
                        cursor: pointer;
                        user-select: none;
                    }
                }
                .main-menu-links {
                    .main-menu-link {
                        padding-top: 0.5rem;
                        padding-bottom: 0.5rem;
                        user-select: none;
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
                    .main-menu-link:nth-child(4) {
                        display: flex;
                        justify-content: space-between;
                        transition: 0.5s;
                        cursor: pointer;
                        img {
                            transition: 0.5s;
                        }
                    }
                    .main-menu-link.active {
                        img {
                            transform: rotate(180deg);
                        }
                    }
                    .main-menu-link-child {
                        width: 90%;
                        margin-left: auto;
                        margin-right: auto;
                        padding-top: 0.5rem;
                        padding-bottom: 0.5rem;
                        display: none;
                        a {
                            font-size: 16px;
                            color: var(--black);
                            text-decoration: none;
                            text-transform: uppercase;
                            transition: 0.5s;
                            &:hover {
                                color: var(--dark-beige);
                            }
                        }
                    }
                    .main-menu-link-child.active {
                        display: block;
                    }

                }
            }
            .main-menu-bottom {
                height: 50%;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                .main-menu-links {
                    .main-menu-link {
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
                .main-menu-icons {
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
        .main-menu {
            width: 60%;
            top: 0px;
            height: 100%;
            .main-menu-content {
                height: 100%;
            }
        }
    }

    @media screen and (max-width: 468px) {
        .main-menu {
            width: 80%;
            .main-menu-content {
                .main-menu-top {
                    .main-menu-links {
                        .main-menu-link {
                            a {
                                font-size: 16px;
                            }
                        }
                    }
                }
                .main-menu-bottom {
                    .main-menu-links {
                        .main-menu-link {
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
        .main-menu {
            width: 75%;
            .main-menu-content {
                .main-menu-bottom {
                    .main-menu-icons {
                        img {
                            margin-right: 0.5rem;
                        }
                    }
                }
            }
        }
    }

</style>
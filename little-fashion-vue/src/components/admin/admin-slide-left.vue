<template>
    <MainHeader />
    <div class="user-menu" :class="{ sticky: isMenuSticky, active: isActive }">
        <div class="user-menu-content">
            <div class="user-menu-top">
                <div class="user-menu-main">
                    <img src="../../assets/header-logo.svg" alt="">
                    <img src="../../assets/icons/6.svg" alt="" @click="removeActiveClass">
                </div>
                <div class="user-menu-links">
                    <div class="user-menu-link" @click="toggleChildMenu('zamowienia')">
                        <router-link to="/lista-zamowien-administrator">Lista zamówień</router-link>
                    </div>
                    <div class="user-menu-link" data-menu="produkty" @click="toggleChildMenu('produkty')">
                        <a>Produkty</a>
                        <img src="../../assets/icons/12.svg" alt="">
                    </div>
                    <div v-if="isActiveSection('produkty')" class="user-menu-link-child active">
                        <router-link to="/lista-produktow">Lista produktów</router-link>
                    </div>
                    <div v-if="isActiveSection('produkty')" class="user-menu-link-child active">
                        <router-link to="/dodawanie-produktow">Dodawanie produktów</router-link>
                    </div>
                    <div class="user-menu-link" data-menu="kategorie" @click="toggleChildMenu('kategorie')">
                        <a>Kategorie</a>
                        <img src="../../assets/icons/12.svg" alt="">
                    </div>
                    <div v-if="isActiveSection('kategorie')" class="user-menu-link-child active">
                        <router-link to="/lista-kategorii">Lista kategorii</router-link>
                    </div>
                    <div v-if="isActiveSection('kategorie')" class="user-menu-link-child active">
                        <router-link to="/dodawanie-kategorii">Dodawanie kategorii</router-link>
                    </div>
                    <div class="user-menu-link" data-menu="kody rabatowe" @click="toggleChildMenu('kody rabatowe')">
                        <a>Kody rabatowe</a>
                        <img src="../../assets/icons/12.svg" alt="">
                    </div>
                    <div v-if="isActiveSection('kody rabatowe')" class="user-menu-link-child active">
                        <router-link to="/lista-kodow-rabatowych">Lista kodów rabatowych</router-link>
                    </div>
                    <div v-if="isActiveSection('kody rabatowe')" class="user-menu-link-child active">
                        <router-link to="/dodawanie-kodu-rabatowego">Dodawanie kodu rabatowego</router-link>
                    </div>
                    <div class="user-menu-link" @click="toggleChildMenu('uzytkownicy')">
                        <router-link to="/lista-uzytkownikow">Lista użytkowników</router-link>
                    </div>
                    <div class="user-menu-link" data-menu="blog" @click="toggleChildMenu('blog')">
                        <a>Blog</a>
                        <img src="../../assets/icons/12.svg" alt="">
                    </div>
                    <div v-if="isActiveSection('blog')" class="user-menu-link-child active">
                        <router-link to="/lista-wpisow">Lista wpisów</router-link>
                    </div>
                    <div v-if="isActiveSection('blog')" class="user-menu-link-child active">
                        <router-link to="/dodawanie-wpisow">Dodawanie wpisów</router-link>
                    </div>
                    <div class="user-menu-link" data-menu="galeria" @click="toggleChildMenu('galeria')">
                        <a>Galeria</a>
                        <img src="../../assets/icons/12.svg" alt="">
                    </div>
                    <div v-if="isActiveSection('galeria')" class="user-menu-link-child active">
                        <router-link to="/lista-kolekcji">Lista kolekcji</router-link>
                    </div>
                    <div v-if="isActiveSection('galeria')" class="user-menu-link-child active">
                        <router-link to="/dodawanie-kolekcji">Dodawanie nowej kolekcji</router-link>
                    </div>
                    <div class="user-menu-link">
                        <router-link to="/">Analityka</router-link>
                    </div>
                    <div class="user-menu-link">
                        <router-link to="/lista-odstapien">Lista odstąpień</router-link>
                    </div>
                    <div class="user-menu-link">
                        <router-link to="/ustawienia-konta">Ustawienia konta</router-link>
                    </div>
                </div>
            </div>
            <div class="user-menu-bottom">
                <div class="user-menu-links">
                    <div class="user-menu-link">
                        <p>Zalogowany: Administrator</p>
                    </div>
                    <div class="user-menu-link" @click="logout">
                        <a href="#">Wyloguj</a>
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
export default {
    props: {
        isActive: Boolean,
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
            this.isMenuSticky = window.scrollY > 0;
            console.log('isMenuSticky:', this.isMenuSticky);
        },
        removeActiveClass() {
            this.$emit("toggleUserMenu");
        },
        toggleChildMenu(menuName) {
        this.activeChildMenu = this.activeChildMenu === menuName ? null : menuName;

        // Przełącz klasę "active" dla elementu .user-menu-link
        const activeLink = document.querySelector(`.user-menu-link[data-menu="${menuName}"]`);
        if (activeLink) {
            activeLink.classList.toggle('active'); // Przełącz klasę active dla wybranego elementu
        }
    },
        isActiveSection(section) {
            return this.activeChildMenu === section;
        },
        logout() {
      // Usuń informacje o zalogowaniu z localStorage
      localStorage.removeItem('isLoggedIn');
      localStorage.removeItem('userRole');

      // Ustaw stan zalogowania na false
      this.isLoggedIn = false;

      // Tutaj możesz dodać przekierowanie na stronę logowania
      // Przykład przekierowania do strony głównej:
      this.$router.push({ path: '/' }); // Zakładając, że używasz Vue Router
    }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
};
</script>
  
<style lang="scss" scoped>
    .user-menu {
        position: fixed;
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
            height: 100%;
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
                    .user-menu-link:nth-child(2) {
                        display: flex;
                        justify-content: space-between;
                        transition: 0.5s;
                        cursor: pointer;
                        img {
                            transition: 0.5s;
                        }
                    }
                    .user-menu-link:nth-child(3) {
                        display: flex;
                        justify-content: space-between;
                        transition: 0.5s;
                        cursor: pointer;
                        img {
                            transition: 0.5s;
                        }
                    }
                    .user-menu-link:nth-child(4) {
                        display: flex;
                        justify-content: space-between;
                        transition: 0.5s;
                        cursor: pointer;
                        img {
                            transition: 0.5s;
                        }
                    }
                    .user-menu-link:nth-child(5) {
                        display: flex;
                        justify-content: space-between;
                        transition: 0.5s;
                        cursor: pointer;
                        img {
                            transition: 0.5s;
                        }
                    }
                    .user-menu-link:nth-child(6) {
                        display: flex;
                        justify-content: space-between;
                        transition: 0.5s;
                        cursor: pointer;
                        img {
                            transition: 0.5s;
                        }
                    }
                    .user-menu-link:nth-child(7) {
                        display: flex;
                        justify-content: space-between;
                        transition: 0.5s;
                        cursor: pointer;
                        img {
                            transition: 0.5s;
                        }
                    }
                    .user-menu-link:nth-child(8) {
                        display: flex;
                        justify-content: space-between;
                        transition: 0.5s;
                        cursor: pointer;
                        img {
                            transition: 0.5s;
                        }
                    }
                    .user-menu-link:nth-child(9) {
                        display: flex;
                        justify-content: space-between;
                        transition: 0.5s;
                        cursor: pointer;
                        img {
                            transition: 0.5s;
                        }
                    }
                    .user-menu-link:nth-child(10) {
                        display: flex;
                        justify-content: space-between;
                        transition: 0.5s;
                        cursor: pointer;
                        img {
                            transition: 0.5s;
                        }
                    }
                    .user-menu-link.active {
                        img {
                            transform: rotate(180deg);
                        }
                    }
                    .user-menu-link-child {
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
                    .user-menu-link-child.active {
                        display: block;
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
                            text-underline-offset: 4px;
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
                        .musermenu-link {
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
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
                    <div class="user-menu-link">
                        <router-link to="/lista-zamowien-uzytkownik">Zamówienia</router-link>
                    </div>
                    <div class="user-menu-link">
                        <router-link to="/ustawienia-konta-uzytkownik">Ustawienia konta</router-link>
                    </div>
                </div>
            </div>
            <div class="user-menu-bottom">
                <div class="user-menu-links">
                    <div class="user-menu-link">
                        <p>Zalogowany: {{ getUsernameFromLocalStorage() }}</p>
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
        logout() {
      // Usuń informacje o zalogowaniu z localStorage
      localStorage.removeItem('isLoggedIn');
      localStorage.removeItem('userRole');

      // Ustaw stan zalogowania na false
      this.isLoggedIn = false;

      // Tutaj możesz dodać przekierowanie na stronę logowania
      // Przykład przekierowania do strony głównej:
      this.$router.push({ path: '/' }); // Zakładając, że używasz Vue Router
    },
        getUsernameFromLocalStorage() {
      // Pobieramy nazwę użytkownika z localStorage
      return localStorage.getItem("userName") || "Brak nazwy"; // Jeśli nie ma w localStorage, zwracamy domyślną wartość "Brak nazwy"
    },
        handleScroll() {
            console.log('ScrollY:', window.scrollY);
            this.isMenuSticky = window.scrollY > 0;
            console.log('isMenuSticky:', this.isMenuSticky);
        },
        removeActiveClass() {
            this.$emit("toggleUserMenu");
        },
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
                    .user-menu-link:nth-child(7) {
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
                    .user-menu-link:nth-child(8) {
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
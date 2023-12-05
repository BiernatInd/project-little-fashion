<template>
    <div>
      <AdminHeader />
      <div class="home">
        <div class="home-content">
          <div class="home-left">
            <div class="home-left-box">
              <div class="home-box-content">
                <h2>Aktualne dane twojego konta</h2>
                <hr />
                <p>Nazwa użytkownika: {{ administratorzy.length > 0 ? administratorzy[0].name : 'Brak danych' }}</p>
                <p>Adres E-mail: {{ administratorzy.length > 0 ? administratorzy[0].email : 'Brak danych' }}</p>
              </div>
            </div>
          </div>
          <div class="home-right">
            <div class="home-right-box">
              <div class="home-box-content">
                <h2>Zmiana danych</h2>
                <hr />
                <router-link v-if="administratorzy.length > 0" :to="{ name: 'zmiana-email-administratora', params: { id: administratorzy[0].id }}">Zmień adres E-mail</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
      <MainFooterBottom />
    </div>
  </template>
  
  <script>
  import AdminHeader from '../../components/admin/admin-header.vue'
  import MainFooterBottom from '../../components/main/main-footer-bottom.vue'
  import axios from 'axios'
  
  export default {
    components: {
      AdminHeader,
      MainFooterBottom
    },
    data() {
      return {
        administratorzy: []
      }
    },
    methods: {
      fetchData() {
        axios.get('http://localhost:8000/api/pobierz-administratora')
          .then(response => {
            console.log('Odpowiedź z API:', response.data)
            this.administratorzy = response.data.administratorzy
          })
          .catch(error => {
            console.error('Błąd pobierania danych:', error)
          })
      },
      checkUserRole() {
            const userRole = localStorage.getItem('userRole'); // Zakładam, że rola użytkownika jest przechowywana w local storage

            if (userRole !== 'admin') {
                // Jeżeli użytkownik nie ma roli user, przekieruj go na stronę logowania
                this.$router.push('/logowanie');
            }
        },
    },
    mounted() {
      this.fetchData();
      this.checkUserRole();
    }
  }
  </script>
  
  
<style lang="scss" scoped>
    .home {
        .home-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            padding-top: 7rem;
            padding-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            .home-left {
                width: 48%;
                .home-left-box {
                    border: 1px solid var(--dark-beige);
                    border-radius: 10px;
                    .home-box-content {
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        padding-top: 1rem;
                        h2 {
                            font-size: 32px;
                            margin-bottom: 1rem;
                        }
                        hr {
                            width: 150px;
                            height: 3px;
                            border: none;
                            border-radius: 10px;
                            background-color: var(--light-beige);
                            margin-bottom: 1rem;
                        }
                        p {
                            font-size: 20px;
                            margin-bottom: 1rem;
                        }
                    }
                }
                .home-left-box:not(:last-child) {
                    margin-bottom: 2rem
                }
            }
            .home-right {
                width: 48%;
                .home-right-box {
                    border: 1px solid var(--dark-beige);
                    border-radius: 10px;
                    .home-box-content {
                        width: 95%;
                        margin-left: auto;
                        margin-right: auto;
                        padding-top: 1rem;
                        display: flex;
                        flex-direction: column;
                        h2 {
                            font-size: 32px;
                            margin-bottom: 1rem;
                        }
                        hr {
                            width: 150px;
                            height: 3px;
                            border: none;
                            border-radius: 10px;
                            background-color: var(--light-beige);
                            margin-bottom: 1rem;
                        }
                        a {
                            font-size: 20px;
                            margin-bottom: 1rem;
                            color: var(--black);
                            text-underline-offset: 4px;
                            transition: 0.5s;
                            &:hover {
                                color: var(--dark-beige);
                            }
                        }
                        
                    }
                }
                .home-left-box:not(:last-child) {
                    margin-bottom: 2rem
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .home {
            .home-content {
                flex-direction: column;
                .home-left {
                    width: 100%;
                    margin-bottom: 2rem;
                    .home-left-box {
                        .home-box-content {
                            h2 {
                                font-size: 24px
                            }
                        }
                    }
                }
                .home-right {
                    width: 100%;
                    .home-right-box {
                        .home-box-content {
                            h2 {
                                font-size: 24px;
                            }
                        }
                    }
                }
            }
        }
    }
</style>

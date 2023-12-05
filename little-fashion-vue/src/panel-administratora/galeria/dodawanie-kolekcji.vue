<template>
    <AdminHeader />
    <AdminLoginSidebar />
    <div class="home">
        <div class="home-content">
            <div class="home-main">
                <div class="home-main-content">
                    <h1>Dodawanie kolekcji</h1>
                    <div class="input-flex">
                        <input type="file" ref="fileInput">
                        <input type="text" v-model="sciezkaKolekcji" placeholder="Dodaj ścieżkę kolekcji">
                    </div>
                    <div class="home-button">
                        <button class="home-btn" @click="uploadImage">Dodaj kolekcję</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <MainFooterBottom />
  </template>

<script>
import AdminHeader from '../../components/admin/admin-header.vue';
import MainFooterBottom from '../../components/main/main-footer-bottom.vue';
import axios from 'axios';
import router from '../../router/router'; // Correct import path

export default {
  components: {
    AdminHeader,
    MainFooterBottom,
  },
  data() {
    return {
      sciezkaKolekcji: '',
    };
  },
  methods: {
    uploadImage() {

        if (!this.sciezkaKolekcji || !this.$refs.fileInput.files[0]) {
        alert('Wszystkie pola muszą zostać wypełnione.');
        return;
      }

      const fileInput = this.$refs.fileInput;
      const file = fileInput.files[0];

      const formData = new FormData();
      formData.append('file', file);
      formData.append('sciezka_kolekcji', this.sciezkaKolekcji);

      axios.post('http://localhost:8000/api/dodaj-kolekcje', formData)
        .then(response => {
          console.log(response.data.url);

          // Przekieruj użytkownika do nowego URL-a po pomyślnym dodaniu kolekcji
          router.push({
            name: 'dodawanie-zdjec-do-kolekcji',
            params: { sciezkaKolekcji: this.sciezkaKolekcji },
          });
        })
        .catch(error => {
          console.error(error);
        });
    },
    checkUserRole() {
            const userRole = localStorage.getItem('userRole'); // Zakładam, że rola użytkownika jest przechowywana w local storage

            if (userRole !== 'admin') {
                // Jeżeli użytkownik nie ma roli admin, przekieruj go na stronę logowania
                this.$router.push('/logowanie');
            }
        },
  },
  mounted() {
    this.checkUserRole();
  }
};
</script>
  
<style lang="scss" scoped>
.home {
    .home-content {
        padding-top: 7rem;
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        padding-bottom: 2rem;
        .home-main {
            width: 1200px;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid var(--dark-beige);
            border-radius: 10px;

            .home-main-content {
                width: 95%;
                margin-left: auto;
                margin-right: auto;
                padding-top: 2rem;
                padding-bottom: 2rem;
                h1 {
                    font-size: 32px;
                    color: var(--black);
                    margin-bottom: 2rem;
                }
                .input-flex {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 2rem;
                    input {
                        font-size: 16px;
                        width: 48%;
                        height: 30px;
                        border: none;
                        border-bottom: 1px solid var(--dark-beige);
                        background-color: var(--transparent);
                    }
                }
                .home-button {
                    .home-btn {
                        width: 20%;
                        height: 30px;
                        background-color: var(--transparent);
                        border: 1px solid var(--dark-beige);
                        color: var(--dark-beige);
                        font-size: 16px;
                        cursor: pointer;
                        transition: 0.5s;
                        border-radius: 5px;
                        &:hover {
                            background-color: var(--dark-beige);
                            color: var(--white);
                        }
                    }
                }
            }
        }
    }
}

@media screen and (max-width: 1600px) {
    .home {
        .home-content {
            .home-main {
                width: 80%;
                
            }
        }
    }
}

@media screen and (max-width: 1024px) {
    .home {
        .home-content {
            .home-main {
                width: 100%;
                .home-main-content {
                    h1 {
                        font-size: 24px;
                    }
                    .input-flex {
                        flex-direction: column;
                        margin-bottom: 0;
                        input {
                            width: 100%;
                            margin-bottom: 2rem
                        }
                    }
                    .home-button {
                        .home-btn {
                            width: 100%;
                        }
                    }
                }
            }
        }
    }
}
</style>

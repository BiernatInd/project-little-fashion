<template>
  <div>
    <AdminHeader />
    <AdminLoginSidebar />
    <div class="home">
      <div class="home-content">
        <div class="home-main">
          <div class="home-main-content">
            <h1>Dodawanie zdjęcia do wpisu</h1>
            <div class="input-flex">
              <input type="file" ref="fileInput" @change="handleFileChange" />
            </div>
            <div class="home-button">
              <button class="home-btn" @click="dodajZdjecie">Dodaj zdjęcie</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <MainFooterBottom />
  </div>
</template>

<script>
import AdminHeader from "../../components/admin/admin-header.vue";
import MainFooterBottom from "../../components/main/main-footer-bottom.vue";
import axios from "axios";
import router from "../../router/router";

export default {
  components: {
    AdminHeader,
    MainFooterBottom,
  },
  data() {
    return {
      selectedFile: null,
      sciezkaArtykulu: "", // Dodaj zmienną przechowującą ścieżkę artykułu
    };
  },
  methods: {
    handleFileChange(event) {
      this.selectedFile = event.target.files[0];
    },
    dodajZdjecie() {

      if (!this.selectedFile) {
        // Display an alert if no file is selected
        alert('Wybierz plik przed dodaniem zdjęcia.');
        return;
      }

      
      const formData = new FormData();
      formData.append("image", this.selectedFile);

      axios.post(`http://localhost:8000/api/dodaj-zdjecie/${this.sciezkaArtykulu}`, formData, {
  headers: {
    "Content-Type": "multipart/form-data",
  },
})
        .then((response) => {
          console.log(response.data.message);
          
          router.push(`/dodawanie-tresci-do-wpisow/${this.sciezkaArtykulu}`);
          // Dodaj odpowiednie działania po udanym dodaniu zdjęcia

          // Przekieruj do odpowiedniego widoku lub wykonaj inne operacje
        })
        .catch((error) => {
          console.error("Błąd podczas dodawania zdjęcia:", error.response.data);
          // Dodaj odpowiednie działania po nieudanym dodaniu zdjęcia
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
  created() {
    // Odbierz parametr ścieżki artykułu z router'a
    this.sciezkaArtykulu = this.$route.params.sciezkaArtykulu || '';
    this.checkUserRole();
  },
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
                        width: 100%;
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

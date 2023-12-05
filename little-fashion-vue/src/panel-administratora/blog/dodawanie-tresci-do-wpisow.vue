<template>
    <AdminHeader />
    <AdminLoginSidebar />
    <div class="home">
        <div class="home-content">
            <div class="home-left">
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Dodawanie nagłówków</h2>
                        <input type="text" v-model="nowyNaglowek" placeholder="Wprowadź nagłówek">
                        <div class="home-button">
                          <button class="home-btn" @click="dodajNaglowek">Dodaj nagłówek</button>
                        </div>
                    </div>
                </div>
                <div class="home-left-box">
                    <div class="home-box-content">
                        <h2>Dodawanie paragrafów</h2>
                        <input type="text" v-model="nowyParagraf" placeholder="Wprowadź paragraf">
                        <div class="home-button">
                          <button class="home-btn" @click="dodajParagraf">Dodaj paragraf</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-right">
                <div class="home-right-box">
                    <div class="home-box-content">
                        <h2>Aktualna treść wpisu</h2>
                        <img :src="sciezkaZdjecia">
                        <div v-for="(element, index) in tresci" :key="index">
    <component v-if="element.typ === 'naglowek'" :is="getHeaderType(index)">{{ element.tresc }}</component>
    <p v-else-if="element.typ === 'paragraf'">{{ element.tresc }}</p>
  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <MainFooterBottom />
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
        sciezkaArtykulu: "",
      nowyNaglowek: "",
      nowyParagraf: "",
      sciezkaZdjecia: "",
      naglowki: [],
      paragrafy: [],
      tresci: [],
    };
  },
  methods: {
    getHeaderType(index) {
    const headerTypes = ['h3', 'h4', 'h5', 'h6'];
    const headerIndex = Math.floor(index / 2) % headerTypes.length;
    return headerTypes[headerIndex];
  },
    dodajNaglowek() {
        if (!this.nowyNaglowek.trim()) {
        // Display an alert if the header field is empty
        alert('Wprowadź nagłówek przed dodaniem.');
        return;
      }
        axios
            .post(`http://localhost:8000/api/dodaj-naglowek/${this.sciezkaArtykulu}`, {
                tresc_naglowka: this.nowyNaglowek,
            })
            .then((response) => {
                console.log(response.data.message);
                // Zaktualizuj tresci po dodaniu nowego nagłówka
                this.pobierzDane();
            })
            .catch((error) => {
                console.error('Błąd podczas dodawania nagłówka:', error);
            });
    },
    dodajParagraf() {
        if (!this.nowyParagraf.trim()) {
        // Display an alert if the header field is empty
        alert('Wprowadź paragraf przed dodaniem.');
        return;
      }
        axios
            .post(`http://localhost:8000/api/dodaj-paragraf/${this.sciezkaArtykulu}`, {
                tresc_paragrafu: this.nowyParagraf,
            })
            .then((response) => {
                console.log(response.data.message);
                this.pobierzDane();
                // Zaktualizuj tresci po dodaniu nowego nagłówka
            })
            .catch((error) => {
                console.error('Błąd podczas dodawania nagłówka:', error);
            });
    },
    pobierzDane() {
      axios
        .get(`http://localhost:8000/api/pobierz-dane/${this.sciezkaArtykulu}`)
        .then((response) => {
          // Łącz nagłówki i paragrafy w jedną tablicę z informacją o typie
          const naglowki = response.data.naglowki.map((naglowek) => ({ typ: 'naglowek', tresc: naglowek.tresc_naglowka }));
          const paragrafy = response.data.paragrafy.map((paragraf) => ({ typ: 'paragraf', tresc: paragraf.tresc_paragrafu }));

          // Połącz naprzemiennie nagłówki i paragrafy
          this.tresci = this.interleaveArrays(naglowki, paragrafy);
        })
        .catch((error) => {
          console.error('Błąd podczas pobierania danych:', error);
        });
    },
    pobierzZdjecie() {
            axios
                .get(`http://localhost:8000/api/pobierz-zdjecie/${this.sciezkaArtykulu}`)
                .then((response) => {
                    this.sciezkaZdjecia = response.data.zdjecie ? response.data.zdjecie.zdjecie_artykulu : '';
                })
                .catch((error) => {
                    console.error('Błąd podczas pobierania zdjęcia:', error);
                });
        },
    // Funkcja do naprzemiennego łączenia dwóch tablic
    interleaveArrays(arr1, arr2) {
      const result = [];
      const maxLength = Math.max(arr1.length, arr2.length);
      
      for (let i = 0; i < maxLength; i++) {
        if (i < arr1.length) {
          result.push(arr1[i]);
        }
        if (i < arr2.length) {
          result.push(arr2[i]);
        }
      }

      return result;
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
    this.pobierzDane();
    this.pobierzZdjecie();
    this.checkUserRole();
  },
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
                        padding-bottom: 1rem;
                        h2 {
                            font-size: 32px;
                            margin-bottom: 1rem;
                        }
                        input {
                            width: 100%;
                            height: 30px;
                            font-size: 16px;
                            border: none;
                            border-bottom: 1px solid var(--dark-beige);
                            background-color: var(--transparent);
                            margin-bottom: 1rem; 
                        }
                        textarea {
                            width: 100%;
                            height: 160px;
                            resize: none;
                            font-size: 16px;
                            border: none;
                            border-bottom: 1px solid var(--dark-beige);
                            background-color: var(--transparent);
                            margin-bottom: 1rem; 
                        }
                        .home-button {
                            .home-btn {
                                height: 30px;
                                width: 40%;
                                background-color: var(--transparent);
                                border-radius: 5px;
                                border: 1px solid var(--dark-beige);
                                cursor: pointer;
                                transition: 0.5s;
                                font-size: 16px;
                                color: var(--dark-beige);
                                &:hover {
                                    background-color: var(--dark-beige);
                                    color: var(--white);
                                }
                            }
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
                        h2 {
                            font-size: 32px;
                        }
                        img {
                            margin-top: 1rem;
                            width: 300px;
                            height: 300px;
                            margin-bottom: 1rem;
                            border-radius: 10px;
                        }
                        div {
                            h3, h4, h5, h6 {
                                font-size: 24px;
                                margin-bottom: 1rem;
                            }
                            p {
                                font-size: 20px;
                                margin-bottom: 1rem;
                            }
                        }
                    }
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
                            .home-button {
                                .home-btn {
                                    width: 100%;
                                }
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
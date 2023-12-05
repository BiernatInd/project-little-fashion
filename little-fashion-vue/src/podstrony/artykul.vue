<template>
    <MainHeader />
    <div class="article">
        <div class="article-content">
            <div class="article-top">
                <div class="article-img">
                    <img :src="sciezkaZdjecia">
                </div>
            </div>
            <div class="article-bottom" v-for="(element, index) in tresci" :key="index">
                <component v-if="element.typ === 'naglowek'" :is="getHeaderType(index)">{{ element.tresc }}</component>
                <p v-else-if="element.typ === 'paragraf'">{{ element.tresc }}</p>
            </div>
        </div>
    </div>
    <MainFooterTop />
    <MainFooterBottom />
</template>

<script>
import MainHeader from '../components/main/main-header.vue'
import MainFooterTop from '../components/main/main-footer-top.vue'
import MainFooterBottom from '../components/main/main-footer-bottom.vue'
import axios from 'axios'

export default {
    components: {
        MainHeader,
        MainFooterTop,
        MainFooterBottom
    },
    data() {
        return {
            sciezkaZdjecia: "",
            tresci: [],
        }
    },
    methods: {
        getHeaderType(index) {
    const headerTypes = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
    const headerIndex = Math.floor(index / 2) % headerTypes.length;
    return headerTypes[headerIndex];
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
    },
    created() {
        this.sciezkaArtykulu = this.$route.params.sciezkaArtykulu || '';
        this.pobierzDane();
        this.pobierzZdjecie();
    }
}
</script>
  
<style lang="scss" scoped>
.article {
    .article-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        padding-top: 7rem;
        .article-top {
            .article-img {
                display: flex;
                justify-content: center;
                margin-bottom: 2rem;
                img {
                    width: 500px;
                    height: 500px;
                    border-radius: 10px;
                }
            }
        }
        .article-bottom {
            h1, h2, h3, h4, h5, h6 {
                font-size: 32px;
                margin-bottom: 1rem;
            }
            hr {
                width: 240px;
                    height: 3px;
                    background-color: var(--dark-beige);
                    border: none;
            }
            p {
                margin-bottom: 1rem;
                font-size: 24px;
            }
        }
    }
}

@media screen and (max-width: 1024px) {
    .article {
        .article-content {
            padding-top: 7rem;
            .article-top {
                .article-img {
                    img {
                        width: 200px;
                        height: 200px;
                    }
                }
            }
        }
    }
}

@media screen and (max-width: 468px) {
    .article {
        .article-content {
            .article-top {
            }
            .article-bottom {
                h1, h2, h3, h4, h5, h6 {
                    font-size: 20px;
                }
                p {
                    font-size: 16px;
                }
                hr {
                    width: 60%;
                }
            }
        }
    }
}
</style>
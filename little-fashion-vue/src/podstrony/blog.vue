<template>
    <MainHeader />
    <div class="blog">
        <div class="blog-content">
            <div class="blog-heading">
                <h2>Najnowsze informacje ze świata krawiectwa</h2>
                <h1>Blog</h1>
                <hr>
            </div>
            <div class="blog-articles">
                <div v-for="(group, index) in podzielNaGrupy(articles, 2)" :key="index" class="blog-box-container">
            <div class="blog-box" v-for="article in group" :key="article.id">
                <div class="blog-box-left">
                    <!-- Znajdź odpowiednie zdjęcie dla artykułu -->
                    <img :src="znajdzZdjecie(article.sciezka_artykulu)" alt="Zdjęcie artykułu">
                </div>
                        <div class="blog-box-right">
                            <h4>Nasze artykuły</h4>
                            <h3>{{ article.meta_title }}</h3>
                            <h4>{{ formatData(article.created_at) }}</h4>
                            <div class="blog-box-button">
                                <router-link :to="'/artykul/' + article.sciezka_artykulu">
                                    <button class="blog-box-btn">
                                        Czytaj artykuł
                                        <div><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/></svg></div>
                                    </button>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
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
            articles: [],
            zdjecia: [],
        };
    },
    mounted() {
        this.pobierzListeWpisow();
        this.pobierzZdjecia(); // Dodaj to wywołanie
        
    },
    methods: {
        formatData(isoDate) {
            const date = new Date(isoDate);
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();

            return `${day < 10 ? '0' : ''}${day}.${month < 10 ? '0' : ''}${month}.${year}`;
        },
        podzielNaGrupy(array, groupSize) {
            const groups = [];
            for (let i = 0; i < array.length; i += groupSize) {
                groups.push(array.slice(i, i + groupSize));
            }
            return groups;
        },
        pobierzListeWpisow() {
            axios.get('http://localhost:8000/api/lista-wpisow')
                .then(response => {
                    this.articles = response.data.entries;
                    console.log('Pobrane dane:', this.articles);
                })
                .catch(error => {
                    console.error('Błąd podczas pobierania danych:', error);
                });
        },
        pobierzZdjecia() {
            axios.get('http://localhost:8000/api/pobierz-wszystkie-zdjecia')
                .then(response => {
                    this.zdjecia = response.data.zdjecia;
                    console.log('Pobrane zdjęcia:', this.zdjecia);
                })
                .catch(error => {
                    console.error('Błąd podczas pobierania zdjęć:', error);
                });
        },
        znajdzZdjecie(sciezkaArtykulu) {
            // Znajdź odpowiadające zdjęcie dla artykułu
            const zdjecie = this.zdjecia.find(z => z.sciezka_artykulu === sciezkaArtykulu);
            return zdjecie ? zdjecie.zdjecie_artykulu : ''; // Zwróć ścieżkę do zdjęcia
        },
    }
}
</script>
  
<style lang="scss" scoped>
    .blog {
        .blog-content {
            padding-top: 7rem;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .blog-heading {
                h2 {
                    font-size: 32px;
                    color: var(--dark-beige);
                    margin-bottom: 1rem;
                }
                h1 {
                    font-size: 40px;
                    color: var(--black);
                    margin-bottom: 1rem;
                }
                hr {
                    width: 100px;
                    height: 3px;
                    border: none;
                    border-radius: 10px;
                    background-color: var(--light-beige);
                    margin-bottom: 2rem;
                }
            }
            .blog-box-container:not(:last-child) {
                margin-bottom: 2rem;
            }
            .blog-box-container {
                display: flex;
                justify-content: space-between;
                .blog-box {
                    width: 48%;
                    border-radius: 10px;
                    display: flex;
                    align-items: center;
                    border: 1px solid var(--dark-beige);
                    .blog-box-left {
                        img {
                            display: block;
                            width: 200px;
                            height: 260px;
                            border-radius: 10px;
                        }
                    }
                    .blog-box-right {
                        width: 100%;
                        margin-left: 2rem;
                        margin-right: 2rem;
                        h3 {
                            font-size: 24px;
                            margin-bottom: 1rem;
                        }
                        h4 {
                            font-size: 20px;
                            margin-bottom: 1rem;
                            font-weight: 400;
                        }
                        .blog-box-button {
                            a {
                                text-decoration: none;
                                .blog-box-btn {
                        width: 100%;
                        height: 40px;
                        display: flex;
                        justify-content: space-between;
                        padding-left: 1rem;
                        align-items: center;
                        font-size: 20px;
                        border: 1px solid var(--dark-beige);
                        background-color: var(--dark-beige);
                        color: var(--white);
                        font-weight: 400;
                        cursor: pointer;
                        transition: 0.5s;
                        text-align: center;
                        div {
                            background-color: var(--transparent);
                            height: 40px;
                            width: 40px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-left: 1px solid rgb(255, 255, 255, 0.5);
                            transition: 0.5s;
                            svg {
                                stroke: var(--white);
                                background-color: var(--transparent);
                                transition: 0.5s;
                            }
                        }
                        &:hover {
                            background-color: var(--white);
                            color: var(--dark-beige);
                            div {
                                background-color: var(--white);
                                border-top: 1px solid var(--dark-beige);
                                border-bottom: 1px solid var(--dark-beige);
                                border-left: 1px solid var(--dark-beige);
                                svg {
                                    background-color: var(--transparent);
                                    stroke: var(--dark-beige);
                                }
                            }
                        }
                    }
                            }
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1600px) {
        .blog {
            .blog-content {
                .blog-heading {
                    h1 {
                    font-size: 32px;
                }
                    h2 {
                        font-size: 24px;
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .blog {
            .blog-content {
                padding-top: 7rem;
                .blog-heading {
                    hr {
                        width: 100px;
                    }
                }
                .blog-box-container {
                    flex-direction: column;
                    .blog-box {
                        width: 100%;
                    }
                    .blog-box:not(:last-child) {
                        margin-bottom: 2rem;
                    }
                }
            }
        }
    }

    @media screen and (max-width: 468px) {
        .blog {
            .blog-content {
                .blog-heading {
                    h1 {
                        font-size: 24px;
                    }
                    h2 {
                        font-size: 20px;
                    }
                    hr {
                        width: 50px;
                    }
                }
                .blog-box-container {
                    .blog-box {
                        flex-direction: column;
                        .blog-box-left {
                            padding-top: 2rem;
                            padding-bottom: 2rem;
                            img {
                                width: 50%;
                                margin-left: auto;
                                margin-right: auto;
                            }
                        }
                        .blog-box-right {
                            width: 90%;
                            margin-left: auto;
                            margin-right: auto;
                            h3 {
                                font-size: 24px;
                            }
                            h4 {
                                font-size: 20px;
                            }
                            .blog-box-button {
                                margin-bottom: 2rem;
                                .blog-box-btn {
                                    font-size: 16px;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
</style>
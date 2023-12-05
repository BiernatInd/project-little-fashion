<template>
    <MainHeader />
    <div class="gallery">
        <div class="gallery-content">
            <div class="gallery-heading">
                <h2>Wszystkie nasze projekty</h2>
                <h1>Galeria</h1>
                <hr>
            </div>
            <div class="gallery-box-container" v-for="(chunk, chunkIndex) in galerieKolekcjeChunks" :key="chunkIndex">
    <a v-for="(item, index) in chunk" :key="index" href="#" @click="showCollect(item)">
        <div class="gallery-box">
            <img :src="item.zdjecie_kolekcji" :alt="item.altText">
        </div>
    </a>
</div>
        </div>
    </div>
    <div class="collect" :class="{ 'active': collectActive }" ref="collect">
        <div class="collect-content">
            <div class="collect-top">
                <div class="collect-top-left">
                    <h2>Nasza kolekcja</h2>
                    <hr>
                </div>
                <div class="collect-top-right">
                    <img src="../assets/icons/6.svg" alt="" @click="hideCollect">
                </div>
            </div>
            <div class="collect-bottom">
        <div v-for="(chunk, chunkIndex) in kolekcjaItemsChunks" :key="chunkIndex" class="collect-box-container">
            <div class="collect-box" v-for="(item, index) in chunk" :key="index">
                <img :src="item.zdjecia_kolekcji" :alt="item.altText" @error="handleImageError">
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
            collectActive: false,
            galerieKolekcje: [],
        galerieKolekcjeChunks: [],
        kolekcjaItems: [],
        kolekcjaItemsChunks: [],
        };
    },
    methods: {
        showCollect(item) {
            this.pobierzDaneTresci(item.sciezka_kolekcji); // Dodaj wywołanie funkcji pobierającej dane kolekcji
            this.collectActive = !this.collectActive;
            document.body.classList.toggle('active', this.collectActive);
        },
        hideCollect() {
            this.collectActive = false;
            document.body.classList.remove('active');
        },
        pobierzDaneTresci(sciezkaKolekcji) {
            axios.get(`http://localhost:8000/api/pobierz-dane-tresci-kolekcji/${sciezkaKolekcji}`)
                .then(response => {
                    this.kolekcjaItems = response.data;
                    this.chunkifyKolekcjeItems(); // Dodaj wywołanie funkcji do podziału danych kolekcji
                    console.log(response.data);
                })
                .catch(error => {
                    console.error('Błąd pobierania danych tresci kolekcji', error);
                });
        },
        chunkifyKolekcje() {
            const chunkSize = 4;
            this.galerieKolekcjeChunks = [];
            for (let i = 0; i < this.galerieKolekcje.length; i += chunkSize) {
                this.galerieKolekcjeChunks.push(this.galerieKolekcje.slice(i, i + chunkSize));
            }
        },
        chunkifyKolekcjeItems() {
            const chunkSize = 4;
            this.kolekcjaItemsChunks = [];
            for (let i = 0; i < this.kolekcjaItems.length; i += chunkSize) {
                this.kolekcjaItemsChunks.push(this.kolekcjaItems.slice(i, i + chunkSize));
            }
        },

    },
    mounted() {
        // Automatycznie pobierz dane po zamontowaniu komponentu
        axios.get('http://localhost:8000/api/pobierz-dane-kolekcji')
        .then(response => {
            this.galerieKolekcje = response.data;
            this.chunkifyKolekcje();
            console.log(response.data);
        })
        .catch(error => {
            console.error('Błąd pobierania danych kolekcji', error);
        });
    }
}
</script>
  
<style lang="scss" scoped>
    .gallery {
        padding-top: 7rem;
        .gallery-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            .gallery-heading {
                h1 {
                    font-size: 40px;
                    color: var(--black);
                    margin-bottom: 1rem;
                }
                h2 {
                    font-size: 32px;
                    margin-bottom: 1rem;
                    color: var(--dark-beige);
                }
                hr {
                background-color: var(--dark-beige);
                height: 3px;
                border: none;
                border-radius: 10px;
                width: 100px;
                margin-bottom: 2rem;
            }
            }
            .gallery-box-container {
                display: flex;
                justify-content: space-between;
                .gallery-box {
                    width: 322px;
                    height: 466px;
                    img {
                        display: block;
                        width: 322px;
                        height: 466px;
                        border-radius: 10px;
                    }
                }
            }
            .gallery-box-container:not(:last-child) {
                margin-bottom: 2rem;
            }
        }
    }

    .collect {
    position: fixed;
    height: 100%;
    width: 100%;
    top: -1000px;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.5s;
    z-index: 999;
    max-width: 1920px;
    &.active {
        top: 0;
    }
    .collect-content {
        width: 80%;
        height: 80%;
        overflow-y: scroll;
        background-color: var(--white);
        border-radius: 10px;
        padding-top: 2rem;
        padding-bottom: 2rem;
        .collect-top {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            .collect-top-left {
                h2 {
                    font-size: 32px;
                    color: var(--black);
                    margin-bottom: 1rem;
                }
                hr {
                    width: 50%;
                    height: 3px;
                    border: none;
                    border-radius: 10px;
                    background-color: var(--light-beige);
                }
            }
            .collect-top-right {
                img {
                    user-select: none;
                    cursor: pointer;
                }
            }
        }
        .collect-bottom {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            padding-top: 2rem;
            .collect-box-container:not(:last-child) {
                padding-bottom: 2rem;
            }
            .collect-box-container {
                display: flex;
                justify-content: space-between;
                .collect-box {
                    img {
                        display: block;
                        width: 300px;
                        height: 375px;
                        border-radius: 10px;
                    }
                }
            }
        }
    }
}

    @media screen and (max-width: 1600px) {
        .gallery {
            .gallery-content {
                .gallery-heading {
                    h1 {
            font-size: 32px;
        }
        h2 {
            font-size: 24px;
        }
                }
                .gallery-box-container {
                    .gallery-box {
                        width: 100%;
                        img {
                            width: 100%;
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .gallery {
            padding-top: 7rem;
            .gallery-content {
                .gallery-box-container {
                    flex-direction: column;
                    margin-bottom: 0;
                    .gallery-box {
                        margin-bottom: 2rem;
                        img {
                            width: 80%;
                            margin-left: auto;
                            margin-right: auto;
                        }
                    }
                }
            }
        }
        .collect {
        .collect-content {
            width: 95%;
            height: 80%;
            overflow-y: scroll;
            .collect-bottom {
                .collect-box-container:not(:last-child) {
                    padding-bottom: 0;
                }
                .collect-box-container {
                    flex-direction: column;
                    .collect-box:not(:last-child) {
                        margin-bottom: 2rem;
                    }
                    .collect-box {
                        img {
                            width: 60%;
                            margin-left: auto;
                            margin-right: auto;
                        }
                    }
                }
            }
        }
    }
    }

    @media screen and (max-width: 468px) {
        .gallery {
            .gallery-content {
                .gallery-heading {
                    h2 {
                    font-size: 20px;
                }
                h1 {
                    font-size: 24px;
                }
                }
            }
        }
        .collect {
        .collect-content {
            .collect-top {
                width: 90%;
                .collect-top-left {
                    h2 {
                        font-size: 24px;
                    }
                }
            }
            .collect-bottom {
                width: 90%;
                p {
                    font-size: 16px;
                }
                .collect-box-container {
                    .collect-box {
                        img {
                            width: 80%;
                        }
                    }
                }
            }
        }
    }
    }
</style>
<template>
    <MainHeader />
    <div class="statement">
        <div class="statement-content">
            <div class="statement-heading">
                <h1>Wzór formularza odstąpienia od umowy</h1>
                <hr>
                <p>Data wejścia w życie: 1 grudnia 2023 r.</p>
            </div>
            <div class="statement-image">
                <img src="../assets/14.png" alt="">
            </div>
            <div class="statement-input">
                <input type="file" ref="fileInput" @change="handleFileChange">
    <button class="statement-btn" @click="uploadFile">
        Wyślij odstąpienie
        <div><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.99528 19.0703L18.9906 10.0903L9.99529 1.11022"/><path d="M1.00004 19.0703L9.99536 10.0903L1.00005 1.11022"/></svg></div>
    </button>
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
import axios from 'axios';

export default {
    components: {
        MainHeader,
        MainFooterTop,
        MainFooterBottom
    },
    methods: {
        handleFileChange() {
            // Obsługa zmiany pliku, jeśli to konieczne
        },
        uploadFile() {
            const fileInput = this.$refs.fileInput;
            const file = fileInput.files[0];

            const formData = new FormData();
            formData.append('file', file);

            axios.post('http://localhost:8000/api/wyslij-odstapienie', formData)
                .then(response => {
                    // Obsługa sukcesu
                    console.log(response.data);
                    alert("Odstąpienie zostało wysłane.");

                    // Zresetuj wartość pola pliku
                    fileInput.value = null;
                })
                .catch(error => {
                    // Obsługa błędów
                    console.error(error);
                    alert("Odstąpienie nie zostało wysłane. Spróbuj ponownie.");
                });
        }
    }
}

</script>
  
<style lang="scss" scoped>
.statement {
    .statement-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        padding-top: 7rem;
        .statement-heading {
            h1 {
                font-size: 40px;
                color: var(--black);
                margin-bottom: 1rem;
            }
            hr {
                background-color: var(--dark-beige);
                height: 3px;
                border: none;
                border-radius: 10px;
                width: 150px;
                margin-bottom: 1rem;
            }
            p {
                font-size: 24px;
                margin-bottom: 2rem;
            }
        }
        .statement-image {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
            img {
                display: block;
                width: 60%;
            }
        }
        .statement-input {
            display: flex;
            input {
                height: 30px;
                border-bottom: 1px solid var(--dark-beige);
            }
            .statement-btn {
                width: 200px;
                height: 30px;
                display: flex;
                justify-content: space-between;
                padding-left: 1rem;
                align-items: center;
                font-size: 16px;
                border: 1px solid var(--dark-beige);
                background-color: var(--dark-beige);
                color: var(--white);
                font-weight: 400;
                cursor: pointer;
                transition: 0.5s;
                text-align: center;
                div {
                    background-color: var(--transparent);
                    height: 30px;
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

@media screen and (max-width: 1600px) {
    .statement {
        .statement-content {
            .statement-heading {
                h1 {
                    font-size: 32px;
                }
            }
        }
    }
}

@media screen and (max-width: 1024px) {
    .statement {
        .statement-content {
            padding-top: 7rem;
            .statement-input {
                justify-content: space-between;
                input {
                    width: 55%;
                }
                .statement-btn {
                    width: 45%;
                }
            }
        }
    }
}

@media screen and (max-width: 478px) {
    .statement {
        .statement-content {
            .statement-heading {
                h1 {
                    font-size: 24px;
                }
                p {
                    font-size: 20px;
                }
            }
            .statement-input {
                flex-direction: column;
                input {
                    margin-bottom: 1rem;
                    width: 100%;
                }
                .statement-btn {
                    width: 100%;
                }
                
            }
        }
    }
}
</style>
<template>
    <AdminHeader />
    <AdminLoginSidebar />
    <div class="home">
        <div class="home-content">
            <div class="home-main">
                <div class="home-main-content">
                    <h1>Dodawanie zdjęć do kolekcji</h1>
                    <div class="input-flex">
                        <input type="file" ref="fileInput" multiple>
                    </div>
                    <div class="home-button">
                        <button class="home-btn" @click="uploadImages">Dodaj zdjęcia</button>
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
import router from '../../router/router'

export default {
    components: {
        AdminHeader,
        MainFooterBottom
    },
    data() {
        return {
            sciezkaKolekcji: '',
        };
    },
    created() {
        this.sciezkaKolekcji = this.$route.params.sciezkaKolekcji;
    },
    methods: {
        uploadImages() {

            if (!this.sciezkaKolekcji || !this.$refs.fileInput.files[0]) {
        alert('Wszystkie pola muszą zostać wypełnione.');
        return;
      }

            const fileInput = this.$refs.fileInput;
            const files = fileInput.files;

            const formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }
            formData.append('sciezka_kolekcji', this.sciezkaKolekcji);

            axios.post(`http://localhost:8000/api/dodaj-zdjecia-kolekcji/${this.sciezkaKolekcji}`, formData)
                .then(response => {
                    console.log(response.data.images);

                    // Przekieruj użytkownika po pomyślnym dodaniu zdjęć
                    alert('Zdjęcia zostały dodane.')
                    
                    this.$refs.fileInput.value = '';
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
}
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

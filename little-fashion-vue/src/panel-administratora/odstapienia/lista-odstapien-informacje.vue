<template>
    <MainHeader />
    <div class="statement">
        <div class="statement-content">
            <div class="statement-image">
                <img :src="imagePath" alt="">
            </div>
        </div>
    </div>
    <MainFooterTop />
    <MainFooterBottom />
</template>

<script>
import axios from 'axios';
import MainHeader from '../../components/main/main-header.vue';
import MainFooterTop from '../../components/main/main-footer-top.vue';
import MainFooterBottom from '../../components/main/main-footer-bottom.vue';

export default {
  components: {
    MainHeader,
    MainFooterTop,
    MainFooterBottom
  },
  data() {
    return {
      imagePath: '', // Initialize imagePath
    };
  },
  methods: {
    checkUserRole() {
            const userRole = localStorage.getItem('userRole'); // Zakładam, że rola użytkownika jest przechowywana w local storage

            if (userRole !== 'admin') {
                // Jeżeli użytkownik nie ma roli admin, przekieruj go na stronę logowania
                this.$router.push('/logowanie');
            }
        },
  },
  mounted() {
    // Make Axios request to fetch image path
    axios.get('http://localhost:8000/api/pobierz-odstapienie/11')
      .then(response => {
        // Update imagePath with the fetched path
        this.imagePath = response.data.odstapienie.sciezka_zdjecia;
      })
      .catch(error => {
        console.error('Error fetching image:', error);
      });
      this.checkUserRole();
  },
};
</script>
  
<style lang="scss" scoped>
.statement {
    .statement-content {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        padding-top: 7rem;
        .statement-image {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
            img {
                display: block;
                width: 60%;
            }
        }
    }
}

@media screen and (max-width: 1024px) {
    .statement {
        .statement-content {
            padding-top: 7rem;
        }
    }
}

</style>
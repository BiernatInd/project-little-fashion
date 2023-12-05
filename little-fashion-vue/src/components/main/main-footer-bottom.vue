<template>
    <div class="footer-bottom">
        <div class="footer-bottom-content">
            <div class="footer-left">
                <router-link to="/polityka-prywatnosci">Polityka prywatności</router-link>
            </div>
            <div class="footer-mid">
                <p>Copyright © 2023 by <a href="https://vibewebs.com" target="_blank">VibeWebs.</a> Wszelkie prawa zastrzeżone.</p>
            </div>
            <div class="footer-right">
                <img src="../../assets/icons/7.svg" alt="">
                <img src="../../assets/icons/8.svg" alt="">
                <img src="../../assets/icons/9.svg" alt="">
                <img src="../../assets/icons/10.svg" alt="">
                <img src="../../assets/icons/11.svg" alt="">
            </div>
        </div>
    </div>
</template>

<script>

</script>
  
<style lang="scss" scoped>
    .footer-bottom {
        padding-top: 1rem;
        padding-bottom: 1rem;
        border-top: 1px solid rgb(42, 41, 40, 0.3);
        .footer-bottom-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            .footer-left {
                width: 33.33%;
                a {
                    font-size: 20px;
                    color: var(--black);
                    text-underline-offset: 4px;
                    transition: 0.5s;
                    &:hover {
                        color: var(--dark-beige);
                    }
                }
            }
            .footer-mid {
                width: 33.33%;
                p {
                    text-align: center;
                    font-size: 20px;
                    color: var(--black);
                    a {
                        text-underline-offset: 4px;
                        color: var(--black);
                        transition: 0.5s;
                    &:hover {
                        color: var(--dark-beige);
                    }
                    }
                }
            }
            .footer-right {
                width: 33.33%;
                display: flex;
                justify-content: flex-end;
                img {
                    width: 25px;
                    cursor: pointer;
                    transition: 0.5s;
                    &:hover {
                        transform: rotate(360deg);
                    }
                }
            img:not(:last-child) {
                margin-right: 1rem;
            }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .footer-bottom {
            .footer-bottom-content {
                flex-direction: column;
                .footer-left {
                    width: 100%;
                    margin-bottom: 1rem;
                }
                .footer-mid {
                    width: 100%;
                    margin-bottom: 1rem;
                    p {
                        text-align: left;
                    }
                }
                .footer-right {
                    width: 100%;
                    justify-content: start;
                }
            }
        }
    }

    @media screen and (max-width: 468px) {
     
        .footer-bottom {
            .footer-bottom-content {
                flex-direction: column;
                .footer-left {
                    a {
                        font-size: 16px;
                    }
                }
                .footer-mid {
                    p {
                        font-size: 16px;
                    }
                }
                .footer-right {
                    img {
                        width: 20px;
                    }
                }
            }
        }
    }
</style>
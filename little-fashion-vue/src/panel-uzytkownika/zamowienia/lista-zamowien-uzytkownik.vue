<template>
    <UserHeader/>
    <div class="home">
      <table>
        <thead>
            <tr>
              <th>Numer</th>
              <th>Zamówienie</th>
              <th>Status</th>
              <th>Płatność</th>
              <th>Cena</th>
              <th>Data</th>
              <th>Szczegóły</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(order, index) in orders" :key="index">
          <td data-label="Numer">{{ index + 1 }}</td>
          <td data-label="Zamówienie">{{ order.numer_zamowienia || order.id }}</td>
          <td data-label="Status">{{ order.status_zamowienia || 'Nieznany' }}</td>
          <td data-label="Płatność">{{ order.platnosc || 'Nieznana' }}</td>
          <td data-label="Cena">{{ order.laczna_kwota || 'Brak informacji' }}</td>
          <td data-label="Data">{{ formatData(order.created_at) }}</td>
            <td data-label="Szczegóły">
                <router-link :to="{ name: 'lista-zamowien-informacje-uzytkownik', params: { numer_zamowienia: extractOrderNumber(order.numer_zamowienia) } }">
                <svg width="16" height="4" viewBox="0 0 16 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="8" cy="2" r="1" stroke="" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="2" cy="2" r="1" stroke="" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="14" cy="2" r="1" stroke="" stroke-width="2" stroke-linecap="round"/>
                </svg>
                </router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="confirmation" :class="{ 'active': confirmationActive }">
      <div class="confirmation-content">
        <div class="confirmation-main">
            <div class="confirmation-top">
                <h2>Potwierdzenie</h2>
                <hr>
            </div>
            <div class="confirmation-bottom">
                <p>Czy napewno chcesz usunąć ten wpis?</p>
                <div class="confirmation-buttons">
                    <button class="confirmation-btn" :class="{ 'active': confirmationActive }" @click="hideConfirmation" ref="collection">Anuluj</button>
                    <button class="confirmation-btn">Usuń</button>
                </div>
            </div>
        </div>
      </div>
    </div>
    <AdminLoginSidebar />
    <MainFooterBottom />
  </template>

<script>
import UserHeader from '../../components/user/user-header.vue'
import MainFooterBottom from '../../components/main/main-footer-bottom.vue'
import axios from 'axios'

export default {
    components: {
        UserHeader,
        MainFooterBottom
    },
    data() {
    return {
      confirmationActive: false,
      userName: null,
      orders: [],
    }
  },
  methods: {
    extractOrderNumber(fullOrderNumber) {
    // Zastosuj odpowiednią logikę wyciągania numeru zamówienia przed datą
    const orderNumberWithoutDate = fullOrderNumber.split('/')[0];
    return orderNumberWithoutDate;
  },
    formatData(isoDate) {
            const date = new Date(isoDate);
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();

            return `${day < 10 ? '0' : ''}${day}.${month < 10 ? '0' : ''}${month}.${year}`;
        },
    showConfirmation() {
        console.log('showConfirmation');
        this.confirmationActive = !this.confirmationActive;
        document.body.classList.toggle('active', this.confirmationActive);
    },
    hideConfirmation() {
        console.log('hideConfirmation');
        this.confirmationActive = false;
        document.body.classList.remove('active');
    },
    checkUserRole() {
            const userRole = localStorage.getItem('userRole'); // Zakładam, że rola użytkownika jest przechowywana w local storage

            if (userRole !== 'user') {
                // Jeżeli użytkownik nie ma roli user, przekieruj go na stronę logowania
                this.$router.push('/logowanie');
            }
        },
        fetchOrders() {
  axios
    .get("http://localhost:8000/api/pobierz-liste-zamowien-uzytkownika", { params: { userName: this.userName } })
    .then((response) => {
      // Aktualizacja zmiennej orders
      this.orders = response.data.map(order => {
        return {
          ...order,
          nazwa_uzytkownika: order.nazwa_uzytkownika || this.userName,
        };
      });

      console.log('Fetched Orders:', this.orders);
    })
    .catch((error) => {
      console.error("Error fetching orders", error);
    });
},
    },
    mounted() {
        this.checkUserRole();
        this.fetchOrders();
    },
    created() {
        this.userName = localStorage.getItem('userName');
                // Wyświetl userName w konsoli
                console.log('UserName:', this.userName);
    }
}
</script>
  
<style lang="scss" scoped>
.home {
      width: 95%;
      margin-left: auto;
      margin-right: auto;
      padding-top: 7rem;
      padding-bottom: 2rem;
      table {
        width: 100%;
        border: 1px solid var(--dark-beige);
        border-radius: 10px;
        border-collapse: separate;
        border-spacing: 0;
        th {
            padding: 12px;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
        }
        td:nth-child(7) {
            svg {
                background-color: rexd;
                margin-bottom: 0.3rem;
            }
        }
        td {
            padding: 12px;
            text-align: center;
            font-weight: 400;
            white-space: normal;
            font-size: 20px;
            border-top: 1px solid var(--dark-beige);
            svg {
                width: 20px;
                margin-left: 0.5rem;
                margin-right: 0.5rem;
                cursor: pointer;
                stroke: var(--black);
                transition: 0.5s;
                &:hover {
                    stroke: var(--dark-beige);
                }
            }
            a {
              color: var(--black);
              text-underline-offset: 4px;
            }
        }

      }
    }
    .confirmation {
        position: fixed;
        max-width: 1920px;
        top: -100%;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.5s;
        z-index: 999;
        &.active {
            top: 0;
        }
        .confirmation-content {
            width: 40%;
            height: 25%;
            border-radius: 10px;
            background-color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            .confirmation-main {
                width: 90%;
                .confirmation-top {
                    margin-bottom: 1rem;
                    h2 {
                        font-size: 32px;
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
                .confirmation-bottom {
                    p {
                        font-size: 20px;
                        margin-bottom: 1rem;
                    }
                    .confirmation-buttons {
                        .confirmation-btn {
                            width: 220px;
                            height: 30px;
                            font-size: 16px;
                        }
                        .confirmation-btn:nth-child(1) {
                            margin-right: 1rem;
                            background-color: var(--white);
                            border: 1px solid var(--dark-beige);
                            color: var(--dark-beige);
                            border-radius: 5px;
                            cursor: pointer;
                            transition: 0.5s;
                            &:hover {
                                background-color: var(--dark-beige);
                                color: var(--white);
                            }
                        }
                        .confirmation-btn:nth-child(2) {
                            margin-right: 1rem;
                            background-color: var(--dark-beige);
                            border: 1px solid var(--dark-beige);
                            color: var(--white);
                            border-radius: 5px;
                            cursor: pointer;
                            transition: 0.5s;
                            &:hover {
                                background-color: var(--white);
                                color: var(--dark-beige);
                            }
                        }
                    }
                }
            }
        }
    }

          @media screen and (max-width: 1600px) {
            .confirmation {
                .confirmation-content {
                    height: 200px;
                    width: 60%;
                }
            }
          }

          @media screen and (max-width: 1024px) {
            .home {
                padding-top: 7rem;
                table, thead, tbody, th, td, tr {
                  display: block;
                  border: none;
              }
              table {
                  thead {
                    tr {
                        position: absolute;
                        top: -9999px;
                        left: -9999px;
                    }
                  }
                  tbody {
                      tr {
                        border: 1px solid var(--dark-beige);
                        border-radius: 10px;
                        margin-bottom: 2rem;
                        td {
                            border-top: none;
                            position: relative;
                            padding-left: 50%;
                            font-size: 12px;
                            text-align: right;
                            img {
                              width: 16px;
                            }
                        }
                        td {
                            position: relative;
                            padding-left: 50%;
                            font-size: 12px;
                            text-align: right;
                            img {
                              width: 16px;
                            }
                        }
                        td:not(:last-child) {
                          border-bottom: 1px solid var(--dark-beige);
                        }
                        td:last-child {
                          display: flex;
                          align-items: center;
                          justify-content: flex-end;
                        }
                        tr {
                          border: 1px solid var(--dark-beige);
                          border-radius: 10px;
                        }
                        td::before {
                            content: attr(data-label);
                            position: absolute;
                            left: 0;
                            width: 50%;
                            padding-left: 15px;
                            font-weight: bold;
                            text-align: left;
                        }
                    }
                  }
              }
            }
            .confirmation {
                .confirmation-content {
                    height: 240px;
                    width: 95%;
                    .confirmation-main {
                        .confirmation-top {
                            hr {
                                width: 30%;
                            }
                        }
                        .confirmation-bottom {
                            .confirmation-buttons {
                                display: flex;
                                flex-direction: column;
                                .confirmation-btn:nth-child(1) {
                                    margin-bottom: 1rem;
                                }
                            }
                        }
                    }
                }
            }
          }

          @media screen and (max-width: 468px) {
            .confirmation {
                .confirmation-content {
                    height: 260px;
                    .confirmation-main {
                        .confirmation-top {
                            h2 {
                                font-size: 24px;
                            }
                        }
                        .confirmation-bottom {
                            p {
                                font-size: 16px;
                            }
                            .confirmation-buttons {
                                .confirmation-btn {
                                    width: 100%;
                                }
                            }
                        }
                    }
                }
            }
          }
</style>

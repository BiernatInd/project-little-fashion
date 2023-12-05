<template>
    <AdminHeader />
    <div class="home">
      <table>
        <thead>
            <tr>
              <th>Numer</th>
              <th>Nazwa wpisu</th>
              <th>Data</th>
              <th>Szczegóły</th>
            </tr>
        </thead>
        <tbody>
          <tr v-for="entry in entries" :key="entry.id">
            <td data-label="Numer">{{ entry.id }}</td>
            <td data-label="Nazwa wpisu">{{ entry.meta_title }}</td>
            <td data-label="Data">{{ formatData(entry.created_at) }}</td>
            <td data-label="Szczegóły">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg" @click="RedirectDodawanieTresciDoWpisow(entry.sciezka_artykulu)">
                    <path d="M9 1L9 16" stroke="" stroke-width="2" stroke-linecap="round"/>
                    <path d="M16 9L1 9" stroke="" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <svg width="16" height="4" viewBox="0 0 16 4" fill="none" xmlns="http://www.w3.org/2000/svg" @click="RedirectEdytowanieTresciDoWpisow(entry.sciezka_artykulu)">
                    <circle cx="8" cy="2" r="1" stroke="" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="2" cy="2" r="1" stroke="" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="14" cy="2" r="1" stroke="" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg" @click="showConfirmation(entry.sciezka_artykulu)">
                    <path d="M8.14233 15.2188L8.14233 11.6972" stroke-linecap="round"/>
                    <path d="M13.7118 15.2188L13.7118 11.6972" stroke-linecap="round"/>
                    <path d="M0.901855 5.82812H20.9522V5.82812C19.165 5.82812 18.2714 5.82812 17.6967 6.35878C17.6577 6.39477 17.6202 6.4323 17.5842 6.47128C17.0535 7.04594 17.0535 7.93956 17.0535 9.72681V17.0883C17.0535 18.9739 17.0535 19.9168 16.4678 20.5025C15.882 21.0883 14.9392 21.0883 13.0535 21.0883H8.80054C6.91492 21.0883 5.97211 21.0883 5.38633 20.5025C4.80054 19.9168 4.80054 18.9739 4.80054 17.0883V9.72681C4.80054 7.93956 4.80054 7.04594 4.26989 6.47128C4.23389 6.4323 4.19636 6.39477 4.15738 6.35878C3.58273 5.82812 2.6891 5.82812 0.901855 5.82812V5.82812Z" stroke-linecap="round"/>
                    <path d="M8.14224 2.30696C8.14224 2.30696 8.6992 1.13281 10.927 1.13281C13.1548 1.13281 13.7118 2.30667 13.7118 2.30667" stroke-linecap="round"/>
                </svg>
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
                    <button class="confirmation-btn" @click="deleteEntry">Usuń</button>
                </div>
            </div>
        </div>
      </div>
    </div>
    <AdminLoginSidebar />
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
            confirmationActive: false,
            entries: [],
            entryToDelete: null,
        };
    },
    methods: {
        RedirectDodawanieTresciDoWpisow(sciezkaArtykulu) {
            this.$router.push(`/dodawanie-tresci-do-wpisow/${sciezkaArtykulu}`);
        },
        RedirectEdytowanieTresciDoWpisow(sciezkaArtykulu) {
            this.$router.push(`/edytowanie-tresci-do-wpisow/${sciezkaArtykulu}`);
        },
        showConfirmation(sciezkaArtykulu) {
      this.entryToDelete = sciezkaArtykulu;
      this.confirmationActive = true;
      document.body.classList.add('active');
    },
    deleteEntry() {
      if (this.entryToDelete) {
        axios.delete(`http://localhost:8000/api/usun-wpis/${this.entryToDelete}`)
          .then(response => {
            console.log('Wpis został usunięty pomyślnie');
            this.hideConfirmation();
            this.fetchEntries(); // Optionally update the view by fetching data again
          })
          .catch(error => {
            console.error('Błąd podczas usuwania wpisu:', error);
          });
      }
    },
        hideConfirmation() {
            this.confirmationActive = false;
            document.body.classList.remove('active');
        },
        fetchEntries() {
            axios.get('http://localhost:8000/api/lista-wpisow')
                .then(response => {
                    this.entries = response.data.entries;
                })
                .catch(error => {
                    console.error('Error fetching entries:', error);
                });
        },
        formatData(isoDate) {
            const date = new Date(isoDate);
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();

            return `${day < 10 ? '0' : ''}${day}.${month < 10 ? '0' : ''}${month}.${year}`;
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
        this.fetchEntries();
        this.checkUserRole();
    },
};
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
        td:nth-child(4) {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        td {
            padding: 12px;
            text-align: center;
            font-weight: 400;
            white-space: normal;
            font-size: 20px;
            border-top: 1px solid var(--dark-beige);
            svg:first-child {
                path {
                    fill: var(--black);
                }
                &:hover {
                    path {
                        fill: var(--dark-beige);
                    }
                }
            }
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

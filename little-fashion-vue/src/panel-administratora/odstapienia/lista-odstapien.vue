<template>
  <AdminHeader />
  <div class="home">
    <table>
      <thead>
          <tr>
            <th>Numer</th>
            <th>Ścieżka zdjęcia</th>
            <th>Data</th>
          </tr>
      </thead>
      <tbody>
        <tr v-for="newsletter in newslettery" :key="newsletter.id">
          <td data-label="Numer">{{ newsletter.id }}</td>
          <td data-label="Ścieżka zdjęcia">{{ newsletter.email }}</td>
          <td data-label="Data">{{ formatData(newsletter.created_at)}}</td>
        </tr>
      </tbody>
    </table>
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
          newslettery: [],
      }
  },
  methods: {
      fetchData() {
          // Pobierz dane z API
          axios.get('http://localhost:8000/api/pobierz-newslettery')
              .then(response => {
                  console.log('Odpowiedź z API:', response.data);
                  this.newslettery = response.data.newsletter; // update to the correct field name
              })
              .catch(error => {
                  console.error('Błąd pobierania danych:', error);
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
      this.checkUserRole();
      this.fetchData();
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
          }
</style>

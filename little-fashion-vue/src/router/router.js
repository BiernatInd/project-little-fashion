import { createRouter, createWebHistory } from 'vue-router'
import StronaGlowna from '../podstrony/strona-glowna.vue'
import ONaszejFirmie from '../podstrony/o-naszej-firmie.vue'
import Faq from '../podstrony/faq.vue'
import SklepDynamiczny from '../podstrony/sklep.vue'
import StronaProduktu from '../podstrony/strona-produktu.vue'
import StronaKoszyka from '../podstrony/strona-koszyka.vue'
import StronaZamowienia from '../podstrony/strona-zamowienia.vue'
import PodziekowanieZaZamowienie from '../podstrony/podziekowanie-za-zamowienie.vue'
import Galeria from '../podstrony/galeria.vue'
import Blog from '../podstrony/blog.vue'
import Artykul from '../podstrony/artykul.vue'
import Kontakt from '../podstrony/kontakt.vue'
import Odstapienie from '../podstrony/odstapienie.vue'
import PolitykaPrywatnosci from '../podstrony/polityka-prywatnosci.vue'
import PolitykaCookies from '../podstrony/polityka-cookies.vue'
import Regulamin from '../podstrony/regulamin.vue'
//System autoryzacji
import Rejestracja from '../system-autoryzacji/rejestracja.vue'
import Logowanie from '../system-autoryzacji/logowanie.vue'
import OdzyskiwanieHasla from '../system-autoryzacji/odzyskiwanie-hasla.vue'
import ResetowanieHasla from '../system-autoryzacji/resetowanie-hasla.vue'
//Panel administratora
//Blog
import ListaWpisow from '../panel-administratora/blog/lista-wpisow.vue'
import DodawanieWpisow from '../panel-administratora/blog/dodawanie-wpisow.vue'
import DodawanieZdjecDoWpisow from '../panel-administratora/blog/dodawanie-zdjec-do-wpisow.vue'
import DodawanieTresciDoWpisow from '../panel-administratora/blog/dodawanie-tresci-do-wpisow.vue'
import EdytowanieTresciDoWpisow from '../panel-administratora/blog/edytowanie-tresci-do-wpisow.vue'
//Galeria
import ListaKolekcji from '../panel-administratora/galeria/lista-kolekcji.vue'
import ListaTresciKolekcji from '../panel-administratora/galeria/lista-tresci-kolekcji.vue'
import DodawanieKolekcji from '../panel-administratora/galeria/dodawanie-kolekcji.vue'
import DodawanieZdjecDoKolekcji from '../panel-administratora/galeria/dodawanie-zdjec-do-kolekcji.vue'
//Kod rabatowy
import ListaKodowRabatowych from '../panel-administratora/kod-rabatowy/lista-kodow-rabatowych.vue'
import DodawanieKoduRabatowego from '../panel-administratora/kod-rabatowy/dodawanie-kodu-rabatowego.vue'
//Odstąpienia
import ListaOdstapien from '../panel-administratora/odstapienia/lista-odstapien.vue'
import ListaOdstapienInformacje from '../panel-administratora/odstapienia/lista-odstapien-informacje.vue'
//Produkty 
import ListaProduktow from '../panel-administratora/produkty/lista-produktow.vue'
import DodawanieProduktow from '../panel-administratora/produkty/dodawanie-produktow.vue'
import EdytowanieProduktow from '../panel-administratora/produkty/edytowanie-produktow.vue'
//Kategorie
import ListaKategorii from '../panel-administratora/kategorie/lista-kategorii.vue'
import EdytowanieKategorii from '../panel-administratora/kategorie/edytowanie-kategorii.vue'
import DodawanieKategorii from '../panel-administratora/kategorie/dodawanie-kategorii.vue'
//Ustawienia
import UstawieniaKonta from '../panel-administratora/ustawienia/ustawienia-konta.vue'
import ZmianaEmailAdministratora from '../panel-administratora/ustawienia/zmiana-email-administrator.vue'
//Uzytkownicy
import ListaUzytkownikow from '../panel-administratora/uzytkownicy/lista-uzytkownikow.vue'
//Zamowienia
import ListaZamowienAdministrator from '../panel-administratora/zamowienia/lista-zamowien-administrator.vue'
import ListaZamowienInformacjeAdministrator from '../panel-administratora/zamowienia/lista-zamowien-informacje-administrator.vue'
//Panel uzytkownika
//Ustawienia
import UstawieniaKontaUzytkownik from '../panel-uzytkownika/ustawienia/ustawienia-konta-uzytkownik.vue'
import ZmianaEmailUzytkownik from '../panel-uzytkownika/ustawienia/zmiana-email-uzytkownik.vue'
//Zamowienia
import ListaZamowienUzytkownik from '../panel-uzytkownika/zamowienia/lista-zamowien-uzytkownik.vue'
import ListaZamowienInformacjeUzytkownik from '../panel-uzytkownika/zamowienia/lista-zamowien-informacje-uzytkownik.vue'
import StatusZamowienia from '../panel-uzytkownika/status/status-zamowienia.vue'
import ListaNewsletter from '../panel-administratora/newsletter/lista-newsletter.vue'
import axios from 'axios'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: StronaGlowna,
            name: "strona-glowna",
            meta: {
                title: "Ubranka dla lalek - Little Fashion",
                description: "Odkryj wspaniałe kolekcje ubranek dla lalek w sklepie Little Fashion! Znajdź idealne ubranko dla swojej lalki w naszym bogatym asortymencie, pełnym modnych stylizacji, akcesoriów i więcej. Już dziś stwórz wyjątkowe kolekcje dla swojej lalki dzięki naszym unikalnym ubrankom!",
            },
        },
        {
            path: '/o-naszej-firmie',
            component: ONaszejFirmie,
            name: "o-naszej-firmie",
            meta: {
                title: "O Nas - Little Fashion - Twój Sklep z Pasją do Akcesoriów dla Lalek",
                description: "Dowiedz się więcej o Little Fashion - naszej historii, pasji i zaangażowaniu w tworzenie wyjątkowych akcesoriów dla lalek. Poznaj nas lepiej i dołącz do naszej społeczności kreatywnych zabaw!",
            },
        },
        {
            path: '/faq',
            component: Faq,
            name: "faq",
            meta: {
                title: "Najczęstsze pytania - Little Fashion - Sklep z Akcesoriami dla Lalek",
                description: "Znajdź odpowiedzi na najczęstsze pytania dotyczące naszych produktów i obsługi zamówień. Sprawdź, jak sprawić, by zabawy lalek były jeszcze lepsze!",
            },
        },
        {
            path: '/sklep/:category/:page?',
            component: SklepDynamiczny,
            name: "sklep",
            meta: {
              title: "",
              description: "",
            },
            props: true,
          },
        {
            path: '/strona-produktu/:id',
            component: StronaProduktu,
            name: "strona-produktu",
            meta: {
                title: "Unikalne Akcesoria dla lalek - Little Fashion - Zobacz Nasze Produkty",
                description: "Odkryj wyjątkowe ubranka, turbany i scrunchies dla lalek w naszym sklepie. Każdy produkt stworzony z myślą o najmłodszych miłośnikach lalek.",
            },
        },
        {
            path: '/strona-koszyka',
            component: StronaKoszyka,
            name: "strona-koszyka",
            meta: {
                title: "Twój Koszyk - Little Fashion - Sklep z Akcesoriami dla Lalek",
                description: "Sprawdź zawartość swojego koszyka w Little Fashion. Gotów do finalizacji zakupów? Znajdź najlepsze akcesoria dla lalek już teraz.",
            },
        },
        {
            path: '/strona-zamowienia',
            component: StronaZamowienia,
            name: "strona-zamowienia",
            meta: {
                title: "Potwierdzenie Zamówienia - Little Fashion - Akcesoria dla Lalek",
                description: "Twoje zamówienie zostało złożone! Śledź status dostawy i przygotuj się na ekscytujące chwile z naszymi produktami dla lalek.",
            },
        },
        {
            path: '/podziekowanie-za-zamowienie',
            component: PodziekowanieZaZamowienie,
            name: "podziekowanie-za-zamowienie",
            meta: {
                title: "Dziękujemy za Zamówienie - Little Fashion - Akcesoria dla Lalek",
                description: "Little Fashion dziękuje za Twoje zamówienie! Przygotuj się na niezapomniane chwile z naszymi wyjątkowymi akcesoriami dla lalek.",
            },
        },
        {
            path: '/galeria',
            component: Galeria,
            name: "galeria",
            meta: {
                title: "Galeria Inspiracji - Little Fashion - Akcesoria dla Lalek",
                description: "Przejrzyj naszą galerię, aby znaleźć inspiracje do ubierania lalek. Zobacz, jak nasze akcesoria dodają uroku każdej zabawie!",
            },
        },
        {
            path: '/blog',
            component: Blog,
            name: "blog",
            meta: {
                title: "Blog Little Fashion - Pomysły na Zabawę z Lalkami",
                description: "Czytaj najnowsze wpisy na naszym blogu i odkrywaj kreatywne pomysły na zabawę z lalkami. Bądź na bieżąco z trendami w świecie lalek.",
            },
        },
        {
            path: '/artykul/:sciezkaArtykulu',
            component: Artykul,
            name: "artykul",
            meta: {
                title: "",
                description: "",
            },
        },
        {
            path: '/kontakt',
            component: Kontakt,
            name: "kontakt",
            meta: {
                title: "Skontaktuj się z Nami - Little Fashion - Akcesoria dla Lalek",
                description: "Masz pytania lub potrzebujesz pomocy? Skorzystaj z naszego formularza kontaktowego. Jesteśmy tutaj, aby pomóc w sprawach związanych z naszymi produktami.",
            },
        },
        {
            path: '/odstapienie',
            component: Odstapienie,
            name: "odstapienie",
            meta: {
                title: "Odstąpienie od Umowy - Little Fashion - Akcesoria dla Lalek",
                description: "Dowiedz się, jak odstąpić od umowy i zwrócić produkty. Naszym celem jest zapewnienie Ci satysfakcji z zakupów w Little Fashion.",
            },
        },
        {
            path: '/polityka-prywatnosci',
            component: PolitykaPrywatnosci,
            name: "polityka-prywatnosci",
            meta: {
                title: "Polityka Prywatności - Little Fashion - Sklep z Akcesoriami dla Lalek",
                description: "Zapoznaj się z naszą polityką prywatności. Twój komfort i bezpieczeństwo są dla nas priorytetem.",
            },
        },
        {
            path: '/polityka-cookies',
            component: PolitykaCookies,
            name: "polityka-cookies",
            meta: {
                title: "Polityka Cookies - Little Fashion - Sklep z Akcesoriami dla Lalek",
                description: "Jak używamy plików cookies? Sprawdź naszą politykę cookies i dowiedz się, jakie informacje gromadzimy w celu ulepszenia Twojego doświadczenia zakupowego.",
            },
        },
        {
            path: '/regulamin',
            component: Regulamin,
            name: "regulamin",
            meta: {
                title: "Regulamin Sklepu - Little Fashion - Akcesoria dla Lalek",
                description: "Zapoznaj się z regulaminem naszego sklepu. Dowiedz się o warunkach zakupów i korzystania z naszych usług.",
            },
        },
        {
            path: '/rejestracja',
            component: Rejestracja,
            name: "rejestracja",
            meta: {
                title: "Załóż Konto - Little Fashion - Sklep z Akcesoriami dla Lalek",
                description: "Zarejestruj się na Little Fashion, aby mieć szybszy dostęp do zakupów. Bądź częścią naszej społeczności miłośników lalek.",
            },
        },
        {
            path: '/logowanie',
            component: Logowanie,
            name: "logowanie",
            meta: {
                title: "Zaloguj się - Little Fashion - Sklep z Akcesoriami dla Lalek",
                description: "Zaloguj się na swoje konto Little Fashion. Odkryj pełną gamę akcesoriów dla lalek i ciesz się wyjątkowymi zakupami.",
            },
        },
        {
            path: '/odzyskiwanie-hasla',
            component: OdzyskiwanieHasla,
            name: "odzyskiwanie-hasla",
            meta: {
                title: "Odzyskiwanie Hasła - Little Fashion - Sklep z Akcesoriami dla Lalek",
                description: "Zapomniałeś hasła? Skorzystaj z opcji odzyskiwania hasła i wróć do swojego konta, gotów do dalszych zakupów.",
            },
        },
        {
            path: '/resetowanie-hasla/:token',
            component: ResetowanieHasla,
            name: "resetowanie-hasla",
            meta: {
                title: "Resetowanie Hasła - Little Fashion - Sklep z Akcesoriami dla Lalek",
                description: "Zabezpiecz swoje konto! Zresetuj hasło, aby utrzymać bezpieczeństwo swoich danych w Little Fashion.",
            },
        },
        //Panel administratora
        //Blog
        {
            path: '/lista-wpisow',
            component: ListaWpisow,
            name: "lista-wpisow",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/dodawanie-wpisow',
            component: DodawanieWpisow,
            name: "dodawanie-wpisow",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/dodawanie-zdjec-do-wpisow/:sciezkaArtykulu',
            component: DodawanieZdjecDoWpisow,
            name: "dodawanie-zdjec-do-wpisow",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/dodawanie-tresci-do-wpisow/:sciezkaArtykulu',
            component: DodawanieTresciDoWpisow,
            name: "dodawanie-tresci-do-wpisow",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/edytowanie-tresci-do-wpisow/:sciezkaArtykulu',
            component: EdytowanieTresciDoWpisow,
            name: "edytowanie-tresci-do-wpisow",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
         //Galeria
         {
            path: '/lista-kolekcji',
            component: ListaKolekcji,
            name: "lista-kolekcji",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/lista-tresci-kolekcji/:sciezkaKolekcji',
            component: ListaTresciKolekcji,
            name: "lista-tresci-kolekcji",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/dodawanie-kolekcji',
            component: DodawanieKolekcji,
            name: "dodawanie-kolekcji",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/dodawanie-zdjec-do-kolekcji/:sciezkaKolekcji',
            component: DodawanieZdjecDoKolekcji,
            name: "dodawanie-zdjec-do-kolekcji",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        //Kod rabatowy
        {
            path: '/lista-kodow-rabatowych',
            component: ListaKodowRabatowych,
            name: "lista-kodow-rabatowych",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/dodawanie-kodu-rabatowego',
            component: DodawanieKoduRabatowego,
            name: "dodawanie-kodu-rabatowego",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        //Odstapienia
        {
            path: '/lista-odstapien',
            component: ListaOdstapien,
            name: "lista-odstapien",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/lista-odstapien-informacje/:id',
            component: ListaOdstapienInformacje,
            name: "lista-odstapien-informacje",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        //Produkty
        {
            path: '/lista-produktow',
            component: ListaProduktow,
            name: "lista-produktow",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/dodawanie-produktow',
            component: DodawanieProduktow,
            name: "dodawanie-produktow",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/edytowanie-produktow/:id',
            component: EdytowanieProduktow,
            name: "edytowanie-produktow",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        //Kategorie
        {
            path: '/lista-kategorii',
            component: ListaKategorii,
            name: "lista-kategorii",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/edytowanie-kategorii/:id',
            component: EdytowanieKategorii,
            name: "edytowanie-kategorii",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/dodawanie-kategorii',
            component: DodawanieKategorii,
            name: "dodawanie-kategorii",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        //Ustawienia
        {
            path: '/ustawienia-konta',
            component: UstawieniaKonta,
            name: "ustawienia-konta",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/zmiana-email-administratora/:id',
            component: ZmianaEmailAdministratora,
            name: "zmiana-email-administratora",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        //Uzytkownicy
        {
            path: '/lista-uzytkownikow',
            component: ListaUzytkownikow,
            name: "lista-uzytkownikow",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        //Zamowienia
        {
            path: '/lista-zamowien-administrator',
            component: ListaZamowienAdministrator,
            name: "lista-zamowien-administrator",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/lista-zamowien-informacje-administrator/:numer_zamowienia',
            component: ListaZamowienInformacjeAdministrator,
            name: "lista-zamowien-informacje-administrator",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        //Panel uzytkownika
        //Ustawienia
        {
            path: '/ustawienia-konta-uzytkownik',
            component: UstawieniaKontaUzytkownik,
            name: "ustawienia-konta-uzytkownik",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/zmiana-email-uzytkownik/:id',
            component: ZmianaEmailUzytkownik,
            name: "zmiana-email-uzytkownik",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        //Zamowienia
        {
            path: '/lista-zamowien-uzytkownik',
            component: ListaZamowienUzytkownik,
            name: "lista-zamowien-uzytkownik",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/lista-zamowien-informacje-uzytkownik/:numer_zamowienia',
            component: ListaZamowienInformacjeUzytkownik,
            name: "lista-zamowien-informacje-uzytkownik",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
        {
            path: '/status-zamowienia/:numerZamowienia',
            component: StatusZamowienia,
            name: "status-zamowienia",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
            props: true
        },
        {
            path: '/lista-newsletter',
            component: ListaNewsletter,
            name: "lista-newsletter",
            meta: {
                title: "",
                description: "",
                content: 'noindex, nofollow',
            },
        },
    ]
});

router.beforeEach(async (to, from, next) => {
    // Przewiń do góry strony przy każdym przejściu
    window.scrollTo(0, 0);

    if (to.name === 'artykul') {
        const articleName = to.params.sciezkaArtykulu;
        console.log('Article Name:', articleName);

        try {
            const response = await axios.get(`http://localhost:8000/api/pobierz-meta/${articleName}`); // Use relative path
            const article = response.data.article;
            console.log('API Response:', article);

            if (article.meta_title) {
                document.title = article.meta_title;
            }

            if (article.meta_description) {
                const descriptionMetaTag = document.querySelector('meta[name="description"]');
                if (descriptionMetaTag) {
                    descriptionMetaTag.setAttribute('content', article.meta_description);
                }
            }
        } catch (error) {
            console.error('Error:', error);
            next({ name: '404' });
            return;
        }
    } else {
        const meta = to.meta;

        if (meta.title) {
            document.title = meta.title;
        }

        if (meta.description) {
            const descriptionMetaTag = document.querySelector('meta[name="description"]');
            if (descriptionMetaTag) {
                descriptionMetaTag.setAttribute('content', meta.description);
            }
        }
    }

    next();
});

export default router
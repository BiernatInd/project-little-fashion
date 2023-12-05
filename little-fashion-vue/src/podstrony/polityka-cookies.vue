<template>
    <MainHeader />
    <div class="policy-cookies">
        <div class="policy-cookies-content">
            <h1>Polityka cookies</h1>
            <hr>
            <p>Jeżeli trafiłeś na tę stronę, to znak, że dbasz o swoją prywatność. Szanujemy Twoje podejście do tego tematu i przygotowaliśmy ten dokument, aby dostarczyć Ci informacji na temat wykorzystywania plików cookies i innych technologii śledzących w związku z korzystaniem ze strony internetowej <a href="#">https://little-fashion.pl</a>, na której działa sklep internetowy.</p>
            <h2>Wykorzystywanie plików cookies</h2>
            <hr>
            <p>Nasza strona internetowa, podobnie jak wiele innych, wykorzystuje pliki cookies, które są małymi plikami tekstowymi przechowywanymi na Twoim urządzeniu końcowym (np. komputerze, tablecie, smartfonie) w celu poprawy jakości korzystania z naszej witryny. Pliki cookies pozwalają nam na dostosowanie strony do Twoich potrzeb oraz analizę ruchu na stronie. Kontynuując korzystanie z naszej strony, wyrażasz zgodę na wykorzystanie plików cookies zgodnie z postanowieniami niniejszej polityki.</p>
            <h2>Co to są pliki cookies?</h2>
            <hr>
            <p>Pliki cookies to niewielkie informacje tekstowe, które nasz serwer przesyła i zapisuje na Twoim urządzeniu podczas odwiedzania naszej witryny. Dzięki nim, nasza strona może zapamiętać Twoje preferencje i zachowanie, co pozwala na bardziej efektywną i przyjazną interakcję z naszym serwisem.</p>
            <h2>Rodzaje plików cookies</h2>
            <hr>
            <p>Na naszej stronie stosujemy różne rodzaje plików cookies:</p>
            <ul>
                <li><span>Cookies niezbędne –</span> są niezbędne do prawidłowego funkcjonowania strony i umożliwiają korzystanie z podstawowych funkcji, takich jak nawigacja po witrynie, dostęp do zabezpieczonych obszarów itp. Bez tych plików, strona nie będzie działać poprawnie.</li>
                <li><span>Cookies analityczne –</span> umożliwiają nam monitorowanie i analizę zachowań użytkowników na stronie. Dzięki nim możemy poprawiać jakość naszej witryny oraz dostosowywać ją do potrzeb użytkowników.</li>
                <li><span>Cookies reklamowe –</span> wykorzystujemy je do personalizacji treści reklamowych i dostarczania użytkownikom bardziej odpowiednich ofert.</li>
                <li><span>Cookies społecznościowe –</span> pozwalają na udostępnianie treści z naszej strony w mediach społecznościowych, co umożliwia łatwiejszą interakcję i udział w społeczności.</li>
            </ul>
            <h2>Zarządzanie plikami cookies</h2>
            <hr>
            <p>Możesz zarządzać plikami cookies na swoim urządzeniu, w tym usuwać je lub blokować ich przyjmowanie. Warto jednak pamiętać, że wyłączenie lub blokowanie plików cookies może wpłynąć na funkcjonalność naszej strony. Aby dostosować ustawienia plików cookies, skorzystaj z opcji w ustawieniach swojej przeglądarki internetowej.</p>
            <h2>Jakie dane przetwarzamy za pomocą plików cookies?</h2>
            <hr>
            <p>Pliki cookies nie przechowują Twoich danych osobowych w sposób, który pozwala na Twoją identyfikację. Informacje gromadzone za pomocą plików cookies mogą obejmować unikalne identyfikatory sesji, informacje o Twoich preferencjach i ustawieniach, oraz dane dotyczące aktywności na stronie.</p>
            <h2>Informacje o plikach cookies od podmiotów trzecich</h2>
            <hr>
            <p>Nasza strona internetowa może wykorzystywać pliki cookies dostarczane przez podmioty trzecie, takie jak dostawcy usług analitycznych, reklamodawcy i platformy społecznościowe. Pliki cookies od podmiotów trzecich mogą być wykorzystywane do analizy zachowań użytkowników na stronie lub do celów marketingowych.</p>
            <h2>Zgoda na pliki cookies</h2>
            <hr>
            <p>Podczas pierwszej wizyty na naszej stronie wyświetlana jest informacja dotycząca stosowania plików cookies. Zaakceptowanie i zamknięcie tej informacji oznacza, że wyrażasz zgodę na wykorzystywanie plików cookies zgodnie z postanowieniami niniejszej polityki. Zgodę zawsze możesz wycofać, usuwając pliki cookies oraz zmieniając ustawienia plików cookies w swojej przeglądarce.</p>
            <h2>Kontakt</h2>
            <hr>
            <p>Jeśli masz pytania lub wątpliwości dotyczące naszej polityki cookies, skontaktuj się z nami pod adresem e-mail: biuro@little-fashion.pl.</p>
        </div>
    </div>
    <MainFooterTop />
    <MainFooterBottom />
</template>

<script>
import MainHeader from '../components/main/main-header.vue'
import MainFooterTop from '../components/main/main-footer-top.vue'
import MainFooterBottom from '../components/main/main-footer-bottom.vue'

export default {
    components: {
        MainHeader,
        MainFooterTop,
        MainFooterBottom
    }
}
</script>
  
<style lang="scss" scoped>
    .policy-cookies {
        .policy-cookies-content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            padding-top: 7rem;
            h1, h2 {
                font-size: 40px;
            }
            h1 {
                margin-bottom: 1rem;
            }
            h2:not(:last-child) {
                margin-bottom: 1rem;
            }
            p {
                font-size: 24px;
                margin-bottom: 1rem;
                a {
                    color: var(--black);
                    text-underline-offset: 4px;
                    transition: 0.5s;
                    &:hover {
                        color: var(--dark-beige);
                    }
                }
            }
            ul {
                width: 95%;
                list-style-position: inside;
                li {
                    font-size: 24px;
                    margin-bottom: 1rem;
                    span {
                        font-weight: 600;
                    }
                }
            }
            hr {
                background-color: var(--dark-beige);
                height: 3px;
                border: none;
                border-radius: 10px;
                width: 150px;
                margin-bottom: 1rem;
            }
        }
    }

    @media screen and (max-width: 1600px) {
        .policy-cookies {
            .policy-cookies-content {
                h1 {
                    font-size: 32px;
                }
                h2 {
                    font-size: 32px;
                }
            }
        }
    }

    @media screen and (max-width: 1024px) {
        .policy-cookies {
            .policy-cookies-content {
                padding-top: 7rem;
            }
        }
    }

    @media screen and (max-width: 468px) {
        .policy-cookies {
            .policy-cookies-content {
                h1 {
                    font-size: 24px;
                }
                h2 {
                    font-size: 24px;
                }
                p {
                    font-size: 20px;
                }
                ul {
                    li {
                        font-size: 20px;
                    }
                }
            }
        }
    }
</style>
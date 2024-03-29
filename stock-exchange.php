<?php
session_start();

include 'functions.php';
include 'kitlab_db.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){

}

if($_SERVER["REQUEST_METHOD"] == "POST"){
        
}

?>

<!DOCTYPE html>
<html lang="cs" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible">
    <title>Burza skripta</title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/367398db3a.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <img id="header-logo" src="./logo.png" href="./index.php" alt="Logo"></img>
        <div id="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <div id="hamburger-content">
            <div id="header-first-part" class="header-side">
                <nav id="header-nav">
                    <a class="header-nav-link header-link" href="./index.php">Domů</a>
                    <a class="header-nav-link header-link" href="./stock-exchange.php">Burza</a>
                    <a class="header-nav-link header-link" href="./contact.php">Kontakt</a>
                </nav>
            </div>

            <div id="header-second-part" class="header-side">
                <form id="search-bar" action="/action_page.php">
                    <button id="search-button" type="submit" title="Vyhledat"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
                    <input id="search-input" type="text" placeholder="Hledat..." name="search" title="Vyhledávají pole">
                </form>

                <div id="account-buttons">
                    <a id="header-login-button" class="header-acc-btn header-link" href="login.php"><div class="header-acc-btn-div">Přihlášení</div></a>
                    <a id="header-signup-button" class="header-acc-btn header-link" href="registration.php"><div class="header-acc-btn-div">Registrace</div></a>
                </div>
            </div>
        </div>
    </header>
    <div class="stock-exchange">
        <h1>Burza</h1>
        <div class="stock-exchange-wrap">
            <section class="stock-exchange-category">
                <h2>Kategorie</h2>
                <div class="stock-exchange-category-list">
                    <div class="stock-exchange-category-list-faculty">
                        <button type="button" class="stock-exchange-category-list-faculty-collapsible" id="pef">
                            <h3>PEF</h3>
                        </button>
                        <div class="stock-exchange-category-list-faculty-content">
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="EAM">
                                <label for="EAM">Ekonomika a management</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="PAA">
                                <label for="PAA">Podnikání a administrativa</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="VSSR">
                                <label for="VSSR">Veřejná správa a regionální rozvoj</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="HKS">
                                <label for="HKS">Hospodářská a kulturní studia</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="SI">
                                <label for="SI">Systémové inženýrství</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="INFO">
                                <label for="INFO">Informatika</label>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-category-list-faculty">
                        <button type="button" class="stock-exchange-category-list-faculty-collapsible" id="fappz">
                            <h3>FAPPZ</h3>
                        </button>
                        <div class="stock-exchange-category-list-faculty-content">
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="LANDAB">
                                <label for="LANDAB">Ochrana krajiny a využívání přírodních zdrojů</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="PETIBH">
                                <label for="PETIBH">Chov koní</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="PETIBE">
                                <label for="PETIBE">Chov exotických zvířat</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="KYNOB">
                                <label for="KYNOB">Kynologie</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="VETEB">
                                <label for="VETEB">Veterinární asistent</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="REHAB">
                                <label for="REHAB">Zoorehabilitace a asistenční aktivity se zvířaty</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="HORTIB">
                                <label for="HORTIB">Zahradnictví</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="ARCHIB">
                                <label for="ARCHIB">Krajinářská architektura</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="AKVAB">
                                <label for="AKVAB">Akvakultura a péče o vodní ekosystémy</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="AGRIBF">
                                <label for="AGRIBF">Faremní hospodaření</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="FYTOB">
                                <label for="FYTOB">Rostlinná produkce</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="ANIMAB">
                                <label for="ANIMAB">Chov hospodářských zvířat</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="AGRIBR">
                                <label for="AGRIBR">Veřejná správa v zemědělství, rozvoji venkova a krajiny</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="AGRIBE">
                                <label for="AGRIBE">Ekologické zemědělství</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="NUTRIB">
                                <label for="NUTRIB">Výživa a potraviny</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="QUALIB">
                                <label for="QUALIB">Kvalita potravin a zpracování zemědělských produktů</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="AGRIFOB">
                                <label for="AGRIFOB">Agriculture and Food</label>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-category-list-faculty">
                        <button type="button" class="stock-exchange-category-list-faculty-collapsible" id="tf">
                            <h3>TF</h3>
                        </button>
                        <div class="stock-exchange-category-list-faculty-content">
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="ZT">
                                <label for="ZT">Zemědělská technika</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="SMAD">
                                <label for="SMAD">Silniční a městská automobilová doprava</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="TTZO">
                                <label for="TTZO">Technika a technologie zpracování odpadů</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="TZS">
                                <label for="TZS">Technologická zařízení staveb</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="OPT">
                                <label for="OPT">Obchod a podnikání s technikou</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="IŘTAK">
                                <label for="IŘTAK">Informační a řídící technika v agropotravinářském komplexu</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="IÚ">
                                <label for="IÚ">Inženýrství údržby</label>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-category-list-faculty">
                        <button type="button" class="stock-exchange-category-list-faculty-collapsible" id="fžp">
                            <h3>FŽP</h3>
                        </button>
                        <div class="stock-exchange-category-list-faculty-content">
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="AE">
                                <label for="AE">Aplikovaná ekologie</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="EDS">
                                <label for="EDS">Environmental Data Science</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="EE">
                                <label for="EE">Environmental Engineering</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="GISDPZŽP">
                                <label for="GISDPZŽP">Geografické informační systémy a dálkový průzkum Země v životním prostředí</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="KR">
                                <label for="KR">Krajinářství</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="ÚP">
                                <label for="ÚP">Územní plánování</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="ÚTSSŽP">
                                <label for="ÚTSSŽP">Územní technická a správní služba v životním prostředí</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="VH">
                                <label for="VH">Vodní hospodářství</label>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-category-list-faculty">
                        <button type="button" class="stock-exchange-category-list-faculty-collapsible" id="fld">
                            <h3>FLD</h3>
                        </button>
                        <div class="stock-exchange-category-list-faculty-content">
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="MPŽPZ">
                                <label for="MPŽPZ">Myslivost a péče o životní prostředí zvěře</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="LSOPLE">
                                <label for="LSOPLE">Lesnictví, specializace Ochrana a pěstování lesních ekosystémů</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="LSEŘLH">
                                <label for="LSEŘLH">Lesnictví, specializace Ekonomika a řízení lesního hospodářství</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="DSPDNP">
                                <label for="DSPDNP">Dřevařství, specializace Podnikání ve dřevozpracujícím a nábytkářském průmyslu</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="DSZD">
                                <label for="DSZD">Dřevařství, specializace Zpracování dřeva</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="KPT">
                                <label for="KPT">Konzervace přírodnin a taxidermie</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="SA">
                                <label for="SA">Systémová arboristika</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="FSFEPS">
                                <label for="FSFEPS">Forestry, specializace Forest ecosystems protection and silviculture</label>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-category-list-faculty">
                        <button type="button" class="stock-exchange-category-list-faculty-collapsible" id="ftz">
                            <h3>FTZ</h3>
                        </button>
                        <div class="stock-exchange-category-list-faculty-content">
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="TZ">
                                <label for="TZ">Tropické zemědělství</label>
                            </div>
                            <div class="stock-exchange-category-list-faculty-content-department">
                                <input type="checkbox" class="filter-check-input" id="ICARD">
                                <label for="ICARD">International Cooperation in Agricultural and Rural Development</label>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="stock-exchange-script">
                <h2>Skripta</h2>
                <div class="stock-exchange-script-menu">
                    <div class="stock-exchange-script-menu-detail">
                        <h3>Název</h3>
                        <div class="stock-exchange-script-menu-detail-wrap">
                            <div class="stock-exchange-script-menu-detail-left">
                                <img src="book1.jpg" alt="Náhled nabízených skript">
                            </div>
                            <div class="stock-exchange-script-menu-detail-right">
                                <div class="stock-exchange-script-menu-detail-right-price">
                                    <span>Cena</span>
                                </div>
                                <a href="./product-detail.php">Zobrazit</a>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-script-menu-detail">
                        <h3>Název</h3>
                        <div class="stock-exchange-script-menu-detail-wrap">
                            <div class="stock-exchange-script-menu-detail-left">
                                <img src="book1.jpg" alt="Náhled nabízených skript">
                            </div>
                            <div class="stock-exchange-script-menu-detail-right">
                                <div class="stock-exchange-script-menu-detail-right-price">
                                    <span>Cena</span>
                                </div>
                                <a href="./product-detail.php">Zobrazit</a>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-script-menu-detail">
                        <h3>Název</h3>
                        <div class="stock-exchange-script-menu-detail-wrap">
                            <div class="stock-exchange-script-menu-detail-left">
                                <img src="book1.jpg" alt="Náhled nabízených skript">
                            </div>
                            <div class="stock-exchange-script-menu-detail-right">
                                <div class="stock-exchange-script-menu-detail-right-price">
                                    <span>Cena</span>
                                </div>
                                <a href="./product-detail.php">Zobrazit</a>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-script-menu-detail">
                        <h3>Název</h3>
                        <div class="stock-exchange-script-menu-detail-wrap">
                            <div class="stock-exchange-script-menu-detail-left">
                                <img src="book1.jpg" alt="Náhled nabízených skript">
                            </div>
                            <div class="stock-exchange-script-menu-detail-right">
                                <div class="stock-exchange-script-menu-detail-right-price">
                                    <span>Cena</span>
                                </div>
                                <a href="./product-detail.php">Zobrazit</a>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-script-menu-detail">
                        <h3>Název</h3>
                        <div class="stock-exchange-script-menu-detail-wrap">
                            <div class="stock-exchange-script-menu-detail-left">
                                <img src="book1.jpg" alt="Náhled nabízených skript">
                            </div>
                            <div class="stock-exchange-script-menu-detail-right">
                                <div class="stock-exchange-script-menu-detail-right-price">
                                    <span>Cena</span>
                                </div>
                                <a href="./product-detail.php">Zobrazit</a>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-script-menu-detail">
                        <h3>Název</h3>
                        <div class="stock-exchange-script-menu-detail-wrap">
                            <div class="stock-exchange-script-menu-detail-left">
                                <img src="book1.jpg" alt="Náhled nabízených skript">
                            </div>
                            <div class="stock-exchange-script-menu-detail-right">
                                <div class="stock-exchange-script-menu-detail-right-price">
                                    <span>Cena</span>
                                </div>
                                <a href="./product-detail.php">Zobrazit</a>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-script-menu-detail">
                        <h3>Název</h3>
                        <div class="stock-exchange-script-menu-detail-wrap">
                            <div class="stock-exchange-script-menu-detail-left">
                                <img src="book1.jpg" alt="Náhled nabízených skript">
                            </div>
                            <div class="stock-exchange-script-menu-detail-right">
                                <div class="stock-exchange-script-menu-detail-right-price">
                                    <span>Cena</span>
                                </div>
                                <a href="./product-detail.php">Zobrazit</a>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-script-menu-detail">
                        <h3>Název</h3>
                        <div class="stock-exchange-script-menu-detail-wrap">
                            <div class="stock-exchange-script-menu-detail-left">
                                <img src="book1.jpg" alt="Náhled nabízených skript">
                            </div>
                            <div class="stock-exchange-script-menu-detail-right">
                                <div class="stock-exchange-script-menu-detail-right-price">
                                    <span>Cena</span>
                                </div>
                                <a href="./product-detail.php">Zobrazit</a>
                            </div>
                        </div>
                    </div>
                    <div class="stock-exchange-script-menu-detail">
                        <h3>Název</h3>
                        <div class="stock-exchange-script-menu-detail-wrap">
                            <div class="stock-exchange-script-menu-detail-left">
                                <img src="book1.jpg" alt="Náhled nabízených skript">
                            </div>
                            <div class="stock-exchange-script-menu-detail-right">
                                <div class="stock-exchange-script-menu-detail-right-price">
                                    <span>Cena</span>
                                </div>
                                <a href="./product-detail.php">Zobrazit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <footer>
        
        <div id="footer-nav">
            <img id="footer-logo" src="./logo.png" alt="Logo">
            <ul id="footer-nav-list">
                <li><a class="footer-nav-link" href="./index.php">Domů</a></li>
                <li><a class="footer-nav-link" href="./stock-exchange.php">Burza</a></li>
                <li><a class="footer-nav-link" href="./contact.php">Kontakt</a></li>
                <li><a class="footer-nav-link" href="./my-account.php">Můj účet</a></li>
            </ul>
        </div>
        <hr class="solid">
        <p>Studentský projekt</p>
    </footer>
    <script src="./script.js"></script>
    <script src="./collapsible.js"></script>
</body>

</html>
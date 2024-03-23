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
<html dir="ltr" lang='cs'>
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
                <form id="search-bar">
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

    <div id="home-page-top-container">
        <img id="home-page-top-background-image" src="book5.jpg" alt="Pozadí s motivem knihy">
        <div id="home-page-top-items">
            <h1>Dáváme skriptům nový život a tvé peněžence taktéž...</h1>
            <div id="home-page-buttons">
                <a href="./stock-exchange.php"><div class="home-page-button">Začít nakupovat</div></a>
                <a href="./add-advertisement.php"><div class="home-page-button">Přidat inzerát</div></a>
            </div>
        </div>
    </div>

    <div id="most-popular-container">
        <h2 class="home-page-section-title">Nejpopulárnější</h2>
        <div class="home-page-products-container">
            <a href="./product-detail.php">
                <div class="home-page-product-card">
                    <img class="home-page-product-card-image" src="./product-card-book.png" alt="Náhled skript">
                    <div class="home-page-product-card-text-container">
                        <h3>Název</h3>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
                    </div>
                </div>
            </a>

            <a href="./product-detail.php">
                <div class="home-page-product-card">
                    <img class="home-page-product-card-image" src="./product-card-book.png" alt="Náhled skript">
                    <div class="home-page-product-card-text-container">
                        <h3>Název</h3>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
                    </div>
                </div>
            </a>

            <a href="./product-detail.php">
                <div class="home-page-product-card">
                    <img class="home-page-product-card-image" src="./product-card-book.png" alt="Náhled skript">
                    <div class="home-page-product-card-text-container">
                        <h3>Název</h3>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div id="most-recent-container">
        <h2 class="home-page-section-title">Nejnovější</h2>
        <div class="home-page-products-container">
            <a href="./product-detail.php">
                <div class="home-page-product-card">
                    <img class="home-page-product-card-image" src="./product-card-book.png" alt="Náhled skript">
                    <div class="home-page-product-card-text-container">
                        <h3>Název</h3>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
                    </div>
                </div>
            </a>

            <a href="./product-detail.php">
                <div class="home-page-product-card">
                    <img class="home-page-product-card-image" src="./product-card-book.png" alt="Náhled skript">
                    <div class="home-page-product-card-text-container">
                        <h3>Název</h3>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
                    </div>
                </div>
            </a>

            <a href="./product-detail.php">
                <div class="home-page-product-card">
                    <img class="home-page-product-card-image" src="./product-card-book.png" alt="Náhled skript">
                    <div class="home-page-product-card-text-container">
                        <h3>Název</h3>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div id="popular-categories-container">
        <h2 class="home-page-section-title">Populární kategorie</h2>
        <div id="popular-category-buttons-container">
            <a href="./stock-exchange.php">
                <div class="home-page-pupular-category-button">
                    <p>Kategorie 1</p>
                </div>
            </a>
            <a href="./stock-exchange.php">
                <div class="home-page-pupular-category-button">
                    <p>Kategorie 2</p>
                </div>
            </a>
            <a href="./stock-exchange.php">
                <div class="home-page-pupular-category-button">
                    <p>Kategorie 3</p>
                </div>
            </a>
            <a href="./stock-exchange.php">
                <div class="home-page-pupular-category-button">
                    <p>Kategorie 4</p>
                </div>
            </a>
        </div>
    </div>

    <div id="home-page-reviews-container">
        <h2 class="home-page-section-title">Recenze</h2>
        <div id="home-review-cards-container">
            <div class="home-page-review-card">
                <div class="home-page-review-card-text-container">
                    <h3>Jméno recenzenta</h3>
                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
                </div>
            </div>

            <div class="home-page-review-card">
                <div class="home-page-review-card-text-container">
                    <h3>Jméno recenzenta</h3>
                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
                </div>
            </div>

            <div class="home-page-review-card">
                <div class="home-page-review-card-text-container">
                    <h3>Jméno recenzenta</h3>
                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
                </div>
            </div>
            
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
 </body>
</html>
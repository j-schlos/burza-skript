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
    <div class="forgot-password">
        <div class="forgot-password-form">
            <form action="">
                <h1>Zapomněli jste své heslo?</h1>
                <label for="forgot-email">Zadejte svůj e-mail, bude Vám zaslána zpráva s odkazem na změnu hesla.</label>
                <input type="text" id="forgot-email" class="text-input" name="forgot-email" placeholder="Emailová adresa">
                <input type="submit" value="Obnovit heslo" id="reset-password">
            </form>
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
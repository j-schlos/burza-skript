<?php
session_start(); 

include 'functions.php';
include 'kitlab_db.php';

// define variables and set to empty values
$email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    
    $email = process_input($_POST["email"]);
    $password = process_input($_POST["password"]);

    if(!login_inputs_empty($email, $password)){
        login($email, $password);
    }
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

<body id="Login-body">
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
                    <a id="header-login-button" class="header-acc-btn header-link" href="login.php">
                        <div class="header-acc-btn-div">Přihlášení</div>
                    </a>
                    <a id="header-signup-button" class="header-acc-btn header-link" href="registration.php">
                        <div class="header-acc-btn-div">Registrace</div>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div class="login">
        <div class="login-form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <h1>Přihlášení</h1>
                    <input id="email" name="email" class="login-input" type="text" placeholder="Emailová adresa" value="a.prijemny@gmail.com" required title="Emailová adresa">
                
                    <input id="password" name="password" class="login-input" type="password" placeholder="Heslo" value="Heslo123" required title="Heslo">
                
                <div class="login-bottom">
                    <div>
                        <label>
                            <input id="Remember-cred" type="checkbox"> Pamatovat si údaje
                        </label>
                        <a href="./forgot-password.php">Zapomněli jste heslo?</a>
                    </div>
                    
                    <button type="submit" class="login-submit">Přihlásit </button>
                    
                        
                    <p><a href="./registration.php">Nemáte účet a chcete se registrovat?</a></p>
                </div>
                
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
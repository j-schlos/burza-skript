<?php
session_start(); 

include 'functions.php';
include 'kitlab_db.php';

// define variables and set to empty values
$fname = $lname = $email = $phone = $street = $city = $zipcode = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    redirect_user_if_not_logged_in();

    $result = get_user_by_email($_SESSION['email']);

    if (mysqli_num_rows($result) === 1) {
        $row = $result -> fetch_assoc();
        $GLOBALS['fname'] = $row['fname'];
        $GLOBALS['lname'] = $row['lname'];
        $GLOBALS['email'] = $row['email'];
        $GLOBALS['phone'] = $row['phone'];
        $GLOBALS['street'] = $row['street'];
        $GLOBALS['city'] = $row['city'];
        $GLOBALS['zipcode'] = $row['zipcode'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['btnPassChange'])) {
        redirect("./password-change.php");
    }
    else{
        //změna údajů
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
    <div class="Signup-container">
        <div class="UserInfo-container">
            <form action>
                <div class="NameContainer-wrapper">
                    <img class="userImg" src="avatar.png" alt="">
                    <div class="NameContainer">
                        <h2>Osobní údaje</h2>
                        <input id="Acc-Name-btn" class="Account-btns" type="text" placeholder="Jméno" value="<?php echo $fname ?>" required title="Textové pole pro Jméno">
                        <input id="Acc-Surname-btn" class="Account-btns" type="text" placeholder="Příjmení" value="<?php echo $lname ?>" required title="Textové pole pro Příjmení">
                    </div>
                </div>
        
                    <input id="Acc-Email-btn" class="Account-btns" type="text" placeholder="Emailová adresa" value="<?php echo $email ?>" required title="Textové pole pro "Emailovou adresu>
                    <input id="Acc-Phone-btn" class="Account-btns" type="text" placeholder="Telefon" value="<?php echo $phone ?>" required title="Textové pole pro telefonní číslo">
                    <input id="Acc-Address-btn" class="Account-btns" type="text" placeholder="Adresa" value="<?php echo $street ?>" required title="Textové pole pro Ulici">
                    <input id="Acc-City-btn" class="Account-btns" type="text" placeholder="Město" value="<?php echo $city ?>" required title="Textové pole pro Město">
                    <input id="Acc-PSC-btn" class="Account-btns" type="text" placeholder="PSČ" value="<?php echo $zipcode ?>" required title="Textové pole pro PSČ">
        
                <div class="Accout-change-buttons">
                    <button type="submit" name="btnAccChange" id="change-submit">Upravit</button>
                    <button type="submit" name="btnPassChange" id="pass-change-submit">Změnit heslo</button>
                </div>
            </form>
        </div>
        <div class="Info-Container">
            <div class="Account-ads-box">
                <h2>Moje inzeráty</h2>
                <ul id="acc-ads-list">
                    <li><a id="acc-ad1" href="./product-detail.php">Inzerát 1</a></li>
                    <li><a id="acc-ad2" href="./product-detail.php">Inzerát 2</a></li>
                    <li><a id="acc-ad3" href="./product-detail.php">Inzerát 3</a></li>
                </ul>
            </div>
            <div class="Account-purchases-box">
                <h2>Moje nákupy</h2>
                <ul id="acc-purchases-list">
                    <li><a id="acc-purchase1" href="#">Nákup 1</a></li>
                    <li><a id="acc-purchase2" href="#">Nákup 2</a></li>
                    <li><a id="acc-purchase3" href="#">Nákup 3</a></li>
                </ul>
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
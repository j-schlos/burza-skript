<<<<<<< HEAD:product-detail.html
<<<<<<< Updated upstream:product-detail.html
=======
=======
>>>>>>> main:product-detail.php
<?php
session_start();

include 'functions.php';
include 'kitlab_db.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){
<<<<<<< HEAD:product-detail.html
    $product = load_product_details($_GET['id']);
    $user = get_user_by_id($product['user_id']);
=======

}

if($_SERVER["REQUEST_METHOD"] == "POST"){
        
>>>>>>> main:product-detail.php
}

?>

<<<<<<< HEAD:product-detail.html
>>>>>>> Stashed changes:product-detail.php
=======
>>>>>>> main:product-detail.php
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
    <div class="product-detail">
            <section class="product-detail-images">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($product["image"]) ?>" alt="Fotografie nabízených skript">
            </section>
            <section class="product-detail-description">
                <h1><?php echo $product['title']?></h1>
                <div class="product-detail-description-condition">
                    <p><?php echo $product['description']?></p>
                </div>
                
            </section>
            <section class="product-detail-advertiser">
                <div class="product-detail-advertiser-personal-data">
                    <div><span>Jméno inzerenta: </span><span><?php echo $user['fname'] . " " . $user['lname']?></span></div>
                    <div><span>Telefon: </span><span><?php echo $user['phone']?></span></div>
                    <div><span>Email: </span><span><?php echo $user['email']?></span></div>
                </div>
                <hr>
                <div class="product-detail-advertiser-price">
                    <div><span>Vidělo lidí: </span><span><?php echo $product['views']?></span></div>
                    <div><span>Cena: </span><span><?php echo $product['price'] . " Kč"?></span></div>
                </div>
            </section>
            <section class="product-detail-contact-advertiser">
                <h2>Kontaktovat inzerenta</h2>
                <form action="">
                    <label for="insert-phone-number">Potvrzením kontaktujete inzerenta na email</label>
                    <div class="insert-phone-number-wrap">
                        <input type="text" id="insert-phone-number" class="text-input" name="insert-phone-number" placeholder="Vložte telefonní číslo">
                        <input type="button" value="Kontaktovat" id="contact-btn">
                    </div>
                </form>
            </section>
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
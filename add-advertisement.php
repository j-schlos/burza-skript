<?php
session_start(); 

// define variables and set to empty values
$error = false;
$userId = $sqlPhone = $sqlEmail = "";
$title = $phone = $email = $price = $description = "";
$errorMsg = "";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    include 'kitlab_db.php';

    //sql query na select usera podle session emailu
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $mysqli -> prepare($sql);
    $stmt -> bind_param("s", $_SESSION['email']);
    $stmt -> execute();
    $result = $stmt -> get_result();

    if (mysqli_num_rows($result) === 1) {
        //natáhnutí dat z DB
        $row = $result -> fetch_assoc();
        $GLOBALS['userId'] = $row['id'];
        $GLOBALS['sqlPhone'] = $row['phone'];
        $GLOBALS['sqlEmail'] = $row['email'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    include 'kitlab_db.php';

    $title = process_input($_POST['title']);

    $phone = process_input($_POST['phone']);

    $email = process_input($_POST['email']);

    $price = process_input($_POST["price"]);

    $description = process_input($_POST["description"]);

    //TODO validace inputů?

    if(!$error){
        

        //sql query na insert inzerátu
        $sql = "INSERT INTO advertisements (title, price, description, image, user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli -> prepare($sql);
        $stmt -> bind_param("sssss", $title, $price, $description, $image, $userId);
        $stmt -> execute();

        //$_SESSION['email'] = $email;
        //redirect("./my-account.php");
    }

}

function show_alert_box($message) {
    echo "<script>alert('$message');</script>"; 
}

function process_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
function redirect($url, $statusCode = 303) {
    header('Location: ' . $url, true, $statusCode);
    exit();
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
        <img id="header-logo" src="./logo.png" href="./index.html" alt="Logo"></img>
        <div id="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <div id="hamburger-content">
            <div id="header-first-part" class="header-side">
                <nav id="header-nav">
                    <a class="header-nav-link header-link" href="./index.html">Domů</a>
                    <a class="header-nav-link header-link" href="./stock-exchange.html">Burza</a>
                    <a class="header-nav-link header-link" href="./contact.html">Kontakt</a>
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
    <div class="add-advertisement">
        <div class="add-advertisement-wrap">
            <div class="add-advertisement-form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                    <h1>Přidání inzerátu</h1>
                    <input type="text" id="advertisement-name" name="title" class="text-input add-advertisement-form-input" placeholder="Název" title="Textové pole pro název">
                    <input type="text" id="phone-number" name="phone" class="text-input add-advertisement-form-input" placeholder="Telefon" value="<?php echo $sqlPhone ?>" title="Textové pole pro telefon">
                    <input type="text" id="advertisement-email" name="email" class="text-input add-advertisement-form-input" placeholder="Email" value="<?php echo $sqlEmail ?>" title="Textové pole pro email">
                    <input type="text" id="price" name="price" class="text-input add-advertisement-form-input" placeholder="Cena" title="Textové pole pro cenu">
                    <textarea id="description" name="description" class="text-input" rows="15" placeholder="Popis a stav" title="Textové pole pro popis skript a jejich stavu" maxlength=800></textarea>
                    <input type="file" value="Vložit obrázky" id="insert-images-btn">
                    <input type="button" value="Přidat inzerát" id="add-advertisement-btn">
                </form>
            </div>
            
        </div>
    </div>
    <footer>
        
        <div id="footer-nav">
            <img id="footer-logo" src="./logo.png" alt="Logo">
            <ul id="footer-nav-list">
                <li><a class="footer-nav-link" href="./index.html">Domů</a></li>
                <li><a class="footer-nav-link" href="./stock-exchange.html">Burza</a></li>
                <li><a class="footer-nav-link" href="./contact.html">Kontakt</a></li>
                <li><a class="footer-nav-link" href="./my-account.php">Můj účet</a></li>
            </ul>
        </div>
        <hr class="solid">
        <p>Studentský projekt</p>
    </footer>
    <script src="./script.js"></script>
</body>
</html>
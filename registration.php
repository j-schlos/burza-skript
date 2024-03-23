<?php
session_start(); 

include 'functions.php';
include 'kitlab_db.php';

// define variables and set to empty values
$error = false;
$fname = $lname = $email = $password = "";
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    

    $fname = process_input($_POST['fname']);

    $lname = process_input($_POST['lname']);

    $email = process_input($_POST['email']);

    $password = process_input($_POST["password"]);

    $repassword = process_input($_POST["repassword"]);

    //TODO validace inputů?

    if(strcmp($password, $repassword) != 0){
        $errorMsg = "Hesla se neshodují!";
        $error = true;
    }
    else{
        //check jestli user už neexistuje
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $mysqli -> prepare($sql);
        $stmt -> bind_param("s", $email);
        $stmt -> execute();
        $result = $stmt -> get_result();
        if(mysqli_num_rows($result) > 0){
            $errorMsg = "Uživatel s tímto emailem již existuje";
            $error = true;
        }

        if(!$error){
            //sql query na insert údajů uživatele
            $sql = "INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli -> prepare($sql);
            $stmt -> bind_param("ssss", $fname, $lname, $email, $password);
            $stmt -> execute();

            $_SESSION['email'] = $email;
            redirect("./my-account.php");
        }
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

<body id="Registration-body">
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
    <div class="Registration">
        <div class="Registration-form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <h1>Registrace</h1>
            
                        <input id="fname" name="fname" class="registration-input" type="text" placeholder="Jméno" required title="Textové pole pro Jméno">
            
                        <input id="lname" name="lname" class="registration-input" type="text" placeholder="Příjmení" required title="Textové pole pro Příjmení">
            
            
                    <input id="email" name="email" class="registration-input" type="text" placeholder="Emailová adresa" required title="Textové pole pro Emailovou adresu">
            
                    <input id="password" name="password" class="registration-input" type="password" placeholder="Heslo" required title="Textové pole pro Heslo">
            
                    <input id="repassword" name="repassword" class="registration-input" type="password" placeholder="Heslo znovu" required title="Textové pole pro Heslo znovu">
            
                    <p class="error-msg"><?php echo $errorMsg ?></p>

                <button type="submit" class="Registration-submit">Registrovat</button>
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
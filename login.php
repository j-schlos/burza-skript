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
                    <a id="header-login-button" class="header-acc-btn header-link" href="login.html">
                        <div class="header-acc-btn-div">Přihlášení</div>
                    </a>
                    <a id="header-signup-button" class="header-acc-btn header-link" href="registration.html">
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
                    <input id="username" name="username" class="login-input" type="text" placeholder="Emailová adresa" value="testuser" required title="Emailová adresa">
                
                    <input id="password" name="password" class="login-input" type="password" placeholder="Heslo" value="testuser" required title="Heslo">
                
                <div class="login-bottom">
                    <div>
                        <label>
                            <input id="Remember-cred" type="checkbox"> Pamatovat si údaje
                        </label>
                        <a href="./forgot-password.html">Zapomněli jste heslo?</a>
                    </div>
                    
                    <button type="submit" class="login-submit">Přihlásit </button>
                    
                        
                    <p><a href="./registration.html">Nemáte účet a chcete se registrovat?</a></p>
                </div>
                
            </form>
        </div>
    </div>
    <footer>
        <div id="footer-nav">
            <img id="footer-logo" src="./logo.png" alt="Logo">
            <ul id="footer-nav-list">
                <li><a class="footer-nav-link" href="./index.html">Domů</a></li>
                <li><a class="footer-nav-link" href="./stock-exchange.html">Burza</a></li>
                <li><a class="footer-nav-link" href="./contact.html">Kontakt</a></li>
                <li><a class="footer-nav-link" href="./my-account.html">Můj účet</a></li>
            </ul>
        </div>
        <hr class="solid">
        <p>Studentský projekt</p>
    </footer>
    <script src="./script.js"></script>
</body>

</html>

<?php
// define variables and set to empty values
$error = false;
$username = $password = "";
$errorMsg = "V zadaném formuláři nebyly vyplněny správně tato pole: ";





if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start(); 
    include 'kitlab_db.php';

    $username = process_input($_POST["username"]);

    $password = process_input($_POST["password"]);

    //sql query select na zadaný username
    $sql = "SELECT * FROM users WHERE username='$username'";

    //pošle query do databáze
    $result =  $mysqli -> query($sql);

    if (mysqli_num_rows($result) === 1) {

        $row = $result -> fetch_assoc();

        if ($row['username'] === $username && $row['password'] === $password) {
            //uživatel zadal jméno a heslo správně, je přihlášený
            redirect("./my-account.html");
            exit();
        }
    }
}

function process_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
function validate_name($name){
    if (!preg_match("~^[\p{Latin} ]+$~u",$name)) {
        show_alert_box("Ve jméně musí být jen písmena či mezery");
        exit();
      }
  }

function validate_email($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        show_alert_box("Formát emailu není správný");
        exit();
      }
}

function validate_password($password){
    if (!preg_match("/^[0-9]{9}$/",$password)) {
        show_alert_box("V telefonním čísle mohou být pouze číslice (bez mezer a předvolby). Těchto číslic musí být přesně 9 (české telefonní číslo)");
        exit();
      }
  }

function check_age($dob){
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dob), date_create($today));
    $age = $diff->format('%y');
    if($age < 80){
        show_alert_box("Minimální věk pro registraci je 80 let.");
        exit();
    }
}


function error_msg_append($text){
    if($GLOBALS['error']){
        $GLOBALS['errorMsg'] .= ", ";
    }
    $GLOBALS['errorMsg'] .= $text;
    $GLOBALS['error'] = true;
}

function show_alert_box($message) {
    echo "<script>alert('$message');</script>"; 
}

function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

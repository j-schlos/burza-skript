<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include 'kitlab_db.php';

$_SESSION["errors"] = "";
//START - práce s inputama 

function process_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function validate_name($name){
    //validace jména
    if (!preg_match("~^[\p{Latin} ]{2,32}$~u",$name)) {
      $_SESSION["errors"] .= "Ve jméně a příjmení musí být jen písmena či mezery o délce 2-32 znaků" . "<br>";
      return false;
    }
    return true;
  }

  function validate_email($email){
    //validace emailu
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["errors"] .= "Zadaný email nebyl ve správném formátu" . "<br>";
        return false;
      }
      return true;
  }

  function validate_password($password){
    // Validace hesla
    $regex = '/^(?=.[A-Z])(?=.[a-z])(?=.\d)[A-Za-z\d]{8,}$/';
    if (!preg_match($regex, $password)) {
        $_SESSION["errors"] .= "<b>Heslo nesplňuje požadavky.</b> <br>";
        if (!preg_match('/^(?=.[A-Z])/', $password)) {
            $_SESSION["errors"] .= " - Chybí alespoň jedno velké písmeno. <br>";
        }
        else if (!preg_match('/^(?=.[a-z])/', $password)) {
            $_SESSION["errors"] .= " - Chybí alespoň jedno malé písmeno. <br>";
        }
        else if (!preg_match('/^(?=.\d)/', $password)) {
            $_SESSION["errors"] .= " - Chybí alespoň jedno číslo. <br>";
        }
        else if (!preg_match('/[A-Za-z\d]{8,}$/', $password)) {
            $_SESSION["errors"] .= " - Heslo musí mít alespoň 8 znaků. <br>";
        }
        return true;
    } else {
        return false;
    }
  }

  function hash_password($password){
      return password_hash($password, PASSWORD_DEFAULT);
  }


//END - práce s inputama 

//START - registrace

function signup_inputs_empty($fname, $lname, $email, $password, $repassword){
  if(empty($fname) || empty($lname) || empty($email) || empty($password) || empty($repassword)){
    $_SESSION["errors"] .= "Všechna pole jsou povinná" . "<br>";
    return true;
  }
  return false;
}

function check_existing_user($email){
  //check jestli user už neexistuje
  $sql = "SELECT * FROM users WHERE email=?";
  $stmt = $GLOBALS['mysqli'] -> prepare($sql);
  $stmt -> bind_param("s", $email);
  $stmt -> execute();
  $result = $stmt -> get_result();
  if(mysqli_num_rows($result) > 0){
    $_SESSION["errors"] .= "Uživatel s tímto emailem již existuje" . "<br>";
  }
}

function add_new_user_to_database($fname, $lname, $email, $password){
    //sql query na insert údajů uživatele
    $sql = "INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $GLOBALS['mysqli'] -> prepare($sql);
    $stmt -> bind_param("ssss", $fname, $lname, $email, $password);
    $stmt -> execute();
}

  function signup($fname, $lname, $email, $password, $repassword){

    validate_name($fname);
    validate_name($lname);
    validate_email($email);

    if(strcmp($password, $repassword) != 0){
      $_SESSION["errors"] .= "Zadaná hesla se neshodují" . "<br>";
    }
    else{
      $password = hash_password($password);
    }
    
    check_existing_user($email);

    if(empty($_SESSION["errors"])){
        add_new_user_to_database($fname, $lname, $email, $password);

        unset($_SESSION["errors"]);
        $_SESSION['email'] = $email;
        redirect("./my-account.php");
    }
  }

//END - registrace



//START - přihlášení

function login_inputs_empty($email, $password){
  if(empty($email) || empty($password)){
    $_SESSION["errors"] .= "Všechna pole jsou povinná" . "<br>";
    return true;
  }
  return false;
}

function login($email, $password){

  validate_email($email);

  if(empty($_SESSION['errors'])){
    $result = get_user_by_email($email);

    if (mysqli_num_rows($result) === 1) {
  
        $row = $result -> fetch_assoc();
  
        if (password_verify($password, $row['password'])) {
            //uživatel zadal jméno a heslo správně, je přihlášený
            $_SESSION['email'] = $row['email'];
            redirect("./my-account.php");
        }
        else{
          $_SESSION["errors"] .= "Zadané heslo nebylo správné" . "<br>";
        }
    }else{
      $_SESSION["errors"] .= "Uživatel s tímto emailem neexistuje" . "<br>";
    }
  }  
}

//END - přihlášení

//START - změna hesla

function password_change_inputs_empty($oldPassword, $newPassword, $newRepassword){
  if(empty($oldPassword) || empty($newPassword) || empty($newRepassword)){
    $_SESSION["errors"] .= "Všechna pole jsou povinná" . "<br>";
    return true;
  }
  return false;
}

function update_users_password($email, $password){
  //sql query select na zadaný email
  $sql = "UPDATE users SET password=? WHERE email=?";
  $stmt = $GLOBALS['mysqli'] -> prepare($sql);
  $stmt -> bind_param("ss", $password, $email);
  $stmt -> execute();
}
function password_change($email, $oldPassword, $newPassword, $newRepassword){

  $result = get_user_by_email($email);

  $row = $result -> fetch_assoc();

  if (!password_verify($oldPassword, $row['password'])) {
    $_SESSION["errors"] .= "Zadané staré heslo nebylo správné" . "<br>";
    return false;
  }
  if(strcmp($newPassword, $newRepassword) != 0){
    $_SESSION["errors"] .= "Zadaná hesla se neshodují" . "<br>";
    return false;
  }

  $hashed_password = hash_password($newPassword);
  update_users_password($email, $hashed_password);
  return true;
}

//END - změna hesla

function get_user_by_email($email){
    //sql query select na zadaný email
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $GLOBALS['mysqli'] -> prepare($sql);
    $stmt -> bind_param("s", $email);
    $stmt -> execute();
    return $stmt -> get_result();
}

function echo_all_errors(){
  if(!empty($_SESSION["errors"])){
      echo "Nastala chyba:" . "<br>";
      echo $_SESSION["errors"];
      unset($_SESSION["errors"]);
  }
}

function redirect_user_if_not_logged_in(){
    if(empty($_SESSION['email'] || !isset($_SESSION['email']))){
       redirect("./login.php");
    }
}


function redirect($url, $statusCode = 303) {
    header('Location: ' . $url, true, $statusCode);
    exit();
  }

function show_alert_box($message) {
    echo "<script>alert('$message');</script>"; 
  }

  function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>
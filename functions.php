<?php
session_start(); 
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
     if (!preg_match("/^[\p{Latin} ]{2,32}$/u",$name)) {
      return false;
     }
     return true;
  }

  function validate_first_name($fname){
    //validace jména
    if (!validate_name($fname)) {
      $_SESSION["errors"] .= "Ve jméně musí být jen písmena či mezery o délce 2-32 znaků" . "<br>";
      return false;
    }
    return true;
  }

  function validate_last_name($lname){
    //validace příjmení
    if (!validate_name($lname)) {
      $_SESSION["errors"] .= "V příjmení musí být jen písmena či mezery o délce 2-32 znaků" . "<br>";
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
  
  function validate_phone($phone){
    if (!preg_match("/^[\d]{9}$/",$phone)) {
      $_SESSION["errors"] .= "Zadaný telefon nebyl ve správném formátu, musí se skládat z přesně 9 číslic." . "<br>";
        return false;
      }
      return true;
  }

  function validate_street($street){
    if(empty($street)){
      return true;
    }
    if(strlen($street) > 64){
      $_SESSION["errors"] .= "Adresa musí mít maximálně 64 znaků." . "<br>";
      return false;
    }
    if (!preg_match("/^(\p{Latin}*\s{0,1})*\s\d+$/u",$street)) {
      $_SESSION["errors"] .= "Adresa musí být složena ze slov zakončených číslicí (Například: \"Vodičkova 35\")" . "<br>";
      return false;
    }
      return true;
  }

  function validate_city($city){
    if(empty($city)){
      return true;
    }
    if(strlen($city) > 64){
      $_SESSION["errors"] .= "Město musí mít maximálně 64 znaků." . "<br>";
      return false;
    }
    if (!preg_match("/^([\p{Latin}-]*\s{0,1})*\d*$/u",$city)) {
      $_SESSION["errors"] .= "Město musí být složeno pouze ze slov(Například: \"Velké Meziříčí\")" . "<br>";
      return false;
    }
      return true;
  }

  function validate_zipcode($zipcode){
    if(empty($zipcode)){
      return true;
    }
    if (!preg_match("/^\d{5}$/",$zipcode)) {
      $_SESSION["errors"] .= "PSČ musí být zadáno jako 5 číslic bez mezery(Například: \"16500\")" . "<br>";
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

    validate_first_name($fname);
    validate_last_name($lname);
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
  if(strcmp($oldPassword, $newPassword) == 0){
    $_SESSION["errors"] .= "Zadané staré a nové heslo se shodují" . "<br>";
    return false;
  }
  if(strcmp($newPassword, $newRepassword) != 0){
    $_SESSION["errors"] .= "Zadané nové heslo a znovu zadané nové heslo se neshodují" . "<br>";
    return false;
  }

  $hashed_password = hash_password($newPassword);
  update_users_password($email, $hashed_password);
  return true;
}

//END - změna hesla

//START - změna osobních údajů

function account_data_change_inputs_empty($fname, $lname, $email){
  if(empty($fname) || empty($lname) || empty($email)){
    $_SESSION["errors"] .= "Pole Jméno, Příjmení a Emailová adresa jsou povinná" . "<br>";
    return true;
  }
  return false;
}

function update_users_data($id, $fname, $lname, $email, $phone, $street, $city, $zipcode){
  //sql query select na zadaný email
  $sql = "UPDATE users SET fname=?, lname=?, email=?, phone=?, street=?, city=?, zipcode=? WHERE id=?";
  $stmt = $GLOBALS['mysqli'] -> prepare($sql);
  $stmt -> bind_param("sssssssi", $fname, $lname, $email, $phone, $street, $city, $zipcode, $id);
  $stmt -> execute();
}

function change_account_data($fname, $lname, $email, $phone, $street, $city, $zipcode){

  $user_id = get_user_id_by_email($email);

  validate_first_name($fname);
  validate_last_name($lname);
  validate_email($email);
  validate_phone($phone);
  validate_street($street);
  validate_city($city);
  validate_zipcode($zipcode);

  if(empty($_SESSION['errors'])){
    update_users_data($user_id, $fname, $lname, $email, $phone, $street, $city, $zipcode);
  }

}

//END - změna osobních údajů

function get_user_by_email($email){
    //sql query select na zadaný email
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $GLOBALS['mysqli'] -> prepare($sql);
    $stmt -> bind_param("s", $email);
    $stmt -> execute();
    return $stmt -> get_result();
}

function get_user_id_by_email($email){
  //sql query select id podle zadan0ho emailu
  $sql = "SELECT id FROM users WHERE email=?";
  $stmt = $GLOBALS['mysqli'] -> prepare($sql);
  $stmt -> bind_param("s", $email);
  $stmt -> execute();
  $result = $stmt -> get_result();
  $row = $result -> fetch_assoc();
  return $row['id'];
}

function echo_all_errors(){
  if(!empty($_SESSION["errors"])){
      echo "Nastala chyba:" . "<br>";
      echo $_SESSION["errors"];
      unset($_SESSION["errors"]);
  }
}

function redirect_user_if_not_logged_in(){
   if(!isset($_SESSION["email"]) || empty($_SESSION["email"])){
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
<?php
session_start();

include 'functions.php';
include 'kitlab_db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
}
$result = get_products($_SESSION);

//$faculty_query_run = get_faculty($_SESSION);
//$faculty_query_run = get_faculty($_SESSION['id']);


//$field_of_study_query_run = get_field_of_study($_SESSION);
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
    <div class="stock-exchange">
        <h1>Burza</h1>
        <div class="stock-exchange-wrap">
            <section class="stock-exchange-category">
                <h2>Kategorie</h2>
                <form action="" method="GET">
                    <div class="stock-exchange-category-list">
                        <?php
                        $faculty_query = "SELECT * FROM faculty";
                        $faculty_query_run = mysqli_query($mysqli, $faculty_query);

                        if (mysqli_num_rows($faculty_query_run) > 0) {
                            foreach ($faculty_query_run as $faculty_list) {



                        ?>
                                <div class="stock-exchange-category-list-faculty" name="faculty[]">
                                    <button type="button" class="stock-exchange-category-list-faculty-collapsible" id="<?php echo $faculty_list['name']; ?>">
                                        <h3><?php echo $faculty_list['name']; ?></h3>
                                    </button>
                                    <div class="stock-exchange-category-list-faculty-content">

                                        <?php
                                        $field_of_study_query = "SELECT * FROM fieldOfStudy";
                                        $field_of_study_query_run = mysqli_query($mysqli, $field_of_study_query);

                                        if (mysqli_num_rows($field_of_study_query_run) > 0) {
                                            foreach ($field_of_study_query_run as $field_of_study_list) {
                                                if ($field_of_study_list['faculty_id'] == $faculty_list['id']) {
                                                    $checked = [];
                                                    if (isset($_GET['fields_of_study'])) {
                                                        $checked = $_GET['fields_of_study'];
                                                    }
                                        ?>
                                                    <div class="stock-exchange-category-list-faculty-content-department">
                                                        <input type="checkbox" name="fields_of_study[]" value="<?php echo $field_of_study_list['id']; ?>" class="filter-check-input" id="<?php echo $field_of_study_list['id']; ?>" <?php
                                                                                                                                                                                                                                    if (in_array($field_of_study_list['id'], $checked)) {
                                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                    ?> />
                                                        <label for="<?php echo $field_of_study_list['id']; ?>"><?php echo $field_of_study_list['name'] ?></label>
                                                    </div>
                                        <?php
                                                }
                                            }
                                        } else {
                                            echo "Žádné obory nenalezeny";
                                        }
                                        ?>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "Žádné obory nenalezeny";
                        }
                        ?>
                    </div>
                    <button type="submit" id="filter">Filtrovat</button>
                </form>
            </section>
            <section class="stock-exchange-script">
                <h2>Skripta</h2>
                <div class="stock-exchange-script-menu">
                    <?php
                    //deklarace promenných
                    $page = 0;
                    $counter = 0;
                    $valid_products_sum = 0;
                    //po stisknutí tlačítka volání funkcí
                    if (isset($_POST['prev_page'])) {
                        prev_page();
                    }
                    if (isset($_POST['next_page'])) {
                        next_page();
                    }
                    function prev_page()
                    {
                        global $page;
                        if ($page >= 12) {
                            $page -= 12;
                        }
                    }
                    function next_page()
                    {
                        global $page;
                        global $mysqli;
                        $valid_products_sum = 0;
                        if (isset($_GET['fields_of_study'])) {
                            $fos_checked = [];
                            $fos_checked = $_GET['fields_of_study'];
                            foreach ($fos_checked as $row_fos) {
                                $products = "SELECT * FROM advertisements WHERE field_of_study_id IN ($row_fos)";
                                $products_run = mysqli_query($mysqli, $products);
                                $valid_products_sum += mysqli_num_rows($products_run);
                            }
                                if (($page < $valid_products_sum) && ($page+12 != $valid_products_sum)) {
                                    $page += 12;
                                }
                        } else {
                            $products = "SELECT * FROM advertisements";
                            $products_run = mysqli_query($mysqli, $products);
                            $valid_products_sum = mysqli_num_rows($products_run);
                            if (($page < $valid_products_sum) && ($page+12 != $valid_products_sum)) {
                                $page += 12;
                            }
                        }
                    }
                    //pokud je vybraný filtr, vypisují se jen zvolené produkty             
                    if (isset($_GET['fields_of_study'])) {
                        $fos_checked = [];
                        $fos_checked = $_GET['fields_of_study']; //uložení vybraného filtru
                        //výpis všech zvolených filtrů
                        foreach ($fos_checked as $row_fos) {
                            $products = "SELECT * FROM advertisements WHERE field_of_study_id IN ($row_fos)";
                            $products_run = mysqli_query($mysqli, $products);
                            if (mysqli_num_rows($products_run) > 0) {
                                $valid_products_sum += mysqli_num_rows($products_run); //suma všech produktů odpovidající zvolenému filtru
                                //výpis produktů z každého zvoleného filtru
                                foreach ($products_run as $product) {
                                    //podmínka na maximálně 12 produktů na stránce
                                    if (($counter >= $page) && ($counter < $page + 12)) {
                    ?>
                                        <div class="stock-exchange-script-menu-detail">
                                            <h3><?php echo $product["title"] ?></h3>
                                            <div class="stock-exchange-script-menu-detail-wrap">
                                                <div class="stock-exchange-script-menu-detail-left">
                                                    <img src="book1.jpg" alt="Náhled nabízených skript">
                                                </div>
                                                <div class="stock-exchange-script-menu-detail-right">
                                                    <div class="stock-exchange-script-menu-detail-right-price">
                                                        <span><?php echo $product["price"] . " Kč"; ?></span>
                                                    </div>
                                                    <a href="./product-detail.php">Zobrazit</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    $counter++;
                                }
                            }
                        }
                    }
                    //pokud není zvolený žádný filtr, zobrazí se všechny produkty
                    else {
                        $products = "SELECT * FROM advertisements";
                        $products_run = mysqli_query($mysqli, $products);
                        if (mysqli_num_rows($products_run) > 0) {
                            $valid_products_sum = mysqli_num_rows($products_run); //suma všech produktů odpovidající zvolenému filtru = všech
                            //výpis produktů
                            foreach ($products_run as $product) {
                                //podmínka na maximálně 12 produktů na stránce
                                if (($counter >= $page) && ($counter < $page + 12)) {
                                    ?>
                                    <div class="stock-exchange-script-menu-detail">
                                        <h3><?php echo $product["title"] ?></h3>
                                        <div class="stock-exchange-script-menu-detail-wrap">
                                            <div class="stock-exchange-script-menu-detail-left">
                                                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($product["image"]) ?>" alt="Náhled nabízených skript">
                                            </div>
                                            <div class="stock-exchange-script-menu-detail-right">
                                                <div class="stock-exchange-script-menu-detail-right-price">
                                                    <span><?php echo $product["price"] . " Kč"; ?></span>
                                                </div>
                                                <a href="./product-detail.php">Zobrazit</a>
                                            </div>
                                        </div>
                                    </div>
                    <?php
                                }
                                $counter++;
                            }
                        } else {
                            echo "Nenalezeny žádné položky";
                        }
                    }
                    ?>
                    <?php  ?>
                </div>
                <!-- tlačítka na změnu stránky s produkty -->
                <form method="POST">
                    <input type="submit" name="prev_page" value="< předchozí" id="prev" <?php if ($page == 0) { ?>disabled<?php } ?>>
                    </input>
                        <input type="submit" name="next_page" value="následující >" id="next"<?php if (($page+12 >= $valid_products_sum)){ ?> disabled <?php } ?>></input>
                </form>
            </section>
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
    <script src="./collapsible.js"></script>
</body>

</html>
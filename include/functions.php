<?php
// funkcijos  include/functions.php

function inisession($arg)
{ //valom sesijos kintamuosius
    if ($arg == "full") {
        $_SESSION['message'] = "";
        $_SESSION['offer_message'] = "";
        $_SESSION['user'] = "";
        $_SESSION['ulevel'] = 0;
        $_SESSION['userid'] = 0;
        $_SESSION['umail'] = 0;
    }
    $_SESSION['name_login'] = "";
    $_SESSION['pass_login'] = "";
    $_SESSION['mail_login'] = "";
    $_SESSION['first_name_login'] = "";
    $_SESSION['last_name_login'] = "";
    $_SESSION['name_error'] = "";
    $_SESSION['first_name_error'] = "";
    $_SESSION['last_name_error'] = "";
    $_SESSION['pass_error'] = "";
    $_SESSION['mail_error'] = "";
    $_SESSION['name_offer'] = "";
    $_SESSION['amount_offer'] = "";
    $_SESSION['price_offer'] = "";
    $_SESSION['amount_error'] = "";
    $_SESSION['item_error'] = "";
    $_SESSION['price_error'] = "";
    $_SESSION['amount_sell'] = "";
    $_SESSION['price_sell'] = "";
    $_SESSION['price_sell_error'] = "";
    $_SESSION['amount_sell_error'] = "";
    $_SESSION['sold_message'] = "";
    $_SESSION['offered_message'] = "";
    $_SESSION['amount_accept_error'] = "";
}

function checkname($username)
{ // Vartotojo vardo sintakse
    if (!$username || strlen($username = trim($username)) == 0) {$_SESSION['name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neįvestas vartotojo vardas</font>";
        "";
        return false;} elseif (!preg_match("/^([0-9a-zA-Z])*$/", $username)) /* Check if username is not alphanumeric */ {$_SESSION['name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Vartotojo vardas gali būti sudarytas<br>
				&nbsp;&nbsp;tik iš raidžių ir skaičių</font>";
        return false;
    } else {
        return true;
    }
}

function checkamount($productid, $amount,$price)
{
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    $sql = "SELECT * FROM " . TBL_PRODUCTS . " WHERE kodas = '$productid'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    $amountleft = $row['kiekis'];
    if($amount == null){
        $_SESSION['amount_sell_error'] = "<font size=\"2\" color=\"#ff0000\">* Neįvestas kiekis</font>";
        return false;
    }
    if($price == null){
        $_SESSION['price_sell_error'] = "<font size=\"2\" color=\"#ff0000\">* Neįvesta kaina</font>";
        return false;
    }
    if ($amount > $amountleft) {
        $_SESSION['amount_sell_error'] = "<font size=\"2\" color=\"#ff0000\">* Bandoma parduoti daugiau nei yra sandėlyje</font>";
        return false;
    }
    return true;

}

function checkregname($username, $firstname, $lastname,$mail)
{
    if (!$username || strlen($username = trim($username)) == 0) {$_SESSION['name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neįvestas vartotojo vardas</font>";
        "";
        return false;} else if (!$firstname || strlen($firstname = trim($firstname)) == 0) {
        $_SESSION['first_name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neįvestas vartotojo vardas</font>";
        "";
        return false;
    } else if (!$lastname || strlen($lastname = trim($lastname)) == 0) {
        $_SESSION['last_name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neįvesta vartotojo pavardė</font>";
        "";
        return false;
    } elseif (!$mail || strlen($mail = trim($mail)) == 0){
        $_SESSION['mail_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neįvestas vartotojo el. paštas</font>";
        "";
        return false;
    }elseif (!preg_match("/^([0-9a-zA-Z])*$/", $username)) /* Check if username is not alphanumeric */ {$_SESSION['name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Vartotojo vardas gali būti sudarytas<br>
		&nbsp;&nbsp;tik iš raidžių ir skaičių</font>";
        return false;
    } else if (preg_match('~[0-9]+~', $firstname)) {
        $_SESSION['first_name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Vartotojo vardas gali būti sudarytas tik iš raidžių</font>";
        "";
        return false;
    } else if (preg_match('~[0-9]+~', $lastname)) {
        $_SESSION['last_name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Vartotojo pavardė gali būti sudaryta tik iš raidžių</font>";
        "";
        return false;
    } else {
        return true;
    }
}
function checkpass($pwd, $dbpwd)
{ //  slaptazodzio tikrinimas (tik demo: min 4 raides ir/ar skaiciai) ir ar sutampa su DB esanciu
    if (!$pwd || strlen($pwd = trim($pwd)) == 0) {$_SESSION['pass_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neįvestas slaptažodis</font>";
        return false;} elseif (!preg_match("/^([0-9a-zA-Z])*$/", $pwd)) /* Check if $pass is not alphanumeric */ {$_SESSION['pass_error'] = "* Čia slaptažodis gali būti sudarytas<br>&nbsp;&nbsp;tik iš raidžių ir skaičių";
        return false;} elseif (strlen($pwd) < 4) // per trumpas
    { $_SESSION['pass_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Slaptažodžio ilgis <4 simbolius</font>";
        return false;} elseif ($dbpwd != substr(hash('sha256', $pwd), 5, 32)) {$_SESSION['pass_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neteisingas slaptažodis</font>";
        return false;} else {
        return true;
    }

}

function checkdb($username)
{ // iesko DB pagal varda, grazina {vardas,slaptazodis,lygis,id} ir nustato name_error
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    $sql = "SELECT * FROM " . TBL_USERS . " WHERE slapyvardis = '$username'";
    $result = mysqli_query($db, $sql);
    $uname = $upass = $ulevel = $uid = $umail = null;
    if (!$result || (mysqli_num_rows($result) != 1)) // jei >1 tai DB vardas kartojasi, netikrinu, imu pirma
    { // neradom vartotojo DB
        $_SESSION['name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Tokio vartotojo nėra</font>";
    } else { //vardas yra DB
        $row = mysqli_fetch_assoc($result);
        $uname = $row["slapyvardis"];
        $upass = $row["slaptazodis"];
        $ulevel = $row["roles_id"];
        $uid = $row["vartotojo_id"];
        $umail = $row["email"];}
    return array($uname, $upass, $ulevel, $uid, $umail);
}

function checkmail($mail)
{ // e-mail sintax error checking
    if (!$mail || strlen($mail = trim($mail)) == 0) {$_SESSION['mail_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neįvestas e-pašto adresas</font>";
        return false;} elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {$_SESSION['mail_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neteisingas e-pašto adreso formatas</font>";
        return false;} else {
        return true;
    }

}

function checkitem($item, $amount, $price)
{
    if (!$item || strlen($item = trim($item)) == 0) {
        $_SESSION['item_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Įveskite prekės pavadinimą</font>";
        return false;
    } else if (!$amount || strlen($amount = trim($amount)) == 0) {
        $_SESSION['amount_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Įveskite prekės kiekį</font>";
        return false;
    } else if (!$price || strlen($price = trim($price)) == 0) {
        $_SESSION['price_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Įveskite prekės kainą</font>";
        return false;
    } else {
        return true;
    }

}

function checkifhoused($productname, $supplier)
{
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    $sql = "SELECT * FROM " . TBL_PRODUCTS. " WHERE pavadinimas='$productname' AND tiekejoid='$supplier'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    return mysqli_num_rows($result) > 0;
}


function checkeditname($username, $firstname, $lastname,$mail,$pass)
{
    if (!$username || strlen($username = trim($username)) == 0) {$_SESSION['name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neįvestas vartotojo vardas</font>";
        "";
        return false;} else if (!$firstname || strlen($firstname = trim($firstname)) == 0) {
        $_SESSION['first_name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neįvestas vartotojo vardas</font>";
        "";
        return false;
    } else if (!$lastname || strlen($lastname = trim($lastname)) == 0) {
        $_SESSION['last_name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neįvesta vartotojo pavardė</font>";
        "";
        return false;
    } elseif (!$mail || strlen($mail = trim($mail)) == 0){
        $_SESSION['mail_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neįvestas vartotojo el. paštas</font>";
        "";
        return false;
    }elseif (!$pass || strlen($pass = trim($pass)) == 0){
        $_SESSION['pass_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Neįvestas vartotojo slaptažodis</font>";
        "";
        return false;
    }elseif (!preg_match("/^([0-9a-zA-Z])*$/", $username)) /* Check if username is not alphanumeric */ {$_SESSION['name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Vartotojo vardas gali būti sudarytas<br>
		&nbsp;&nbsp;tik iš raidžių ir skaičių</font>";
        return false;
    } else if (preg_match('~[0-9]+~', $firstname)) {
        $_SESSION['first_name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Vartotojo vardas gali būti sudarytas tik iš raidžių</font>";
        "";
        return false;
    } else if (preg_match('~[0-9]+~', $lastname)) {
        $_SESSION['last_name_error'] =
            "<font size=\"2\" color=\"#ff0000\">* Vartotojo pavardė gali būti sudaryta tik iš raidžių</font>";
        "";
        return false;
    } else {
        return true;
    }
}
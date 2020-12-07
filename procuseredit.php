<?php
// procregister.php tikrina registracijos reikšmes
// įvedimo laukų reikšmes issaugo $_SESSION['xxxx_login'], xxxx-name, pass, mail
// jei randa klaidų jas sužymi $_SESSION['xxxx_error']
// jei vardas, slaptažodis ir email tinka, įraso naują vartotoja į DB, nukreipia į index.php
// po klaidų- vel į register.php

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "useredit")) {header("Location: logout.php");exit;}

include "include/nustatymai.php";
include "include/functions.php";

$_SESSION['name_error'] = "";
$_SESSION['first_name_error'] = "";
$_SESSION['last_name_error'] = "";
$_SESSION['pass_error'] = "";
$_SESSION['mail_error'] = "";
$edituserid = $_POST['edituser'];
$user = strtolower($_POST['user']);
$pass = $_POST['pass'];
$mail = $_POST['email'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$role = $_POST['role'];
$_SESSION['prev'] = "procuseredit";

// registracijos formos lauku  kontrole
if (checkeditname($user, $firstname, $lastname,$mail,$pass)) { // vardas  geras,  nuskaityti vartotoja is DB

    list($dbuname) = checkdb($user); //patikrinam DB
        $_SESSION['name_error'] = "";
        if (checkpass($pass, substr(hash('sha256', $pass), 5, 32)) && checkmail($mail)) // antra tikrinimo dalis checkpass bus true
        { // viskas tinka sukurti vartotojo irasa DB
            $userid = md5(uniqid($user)); //naudojam toki userid
            $pass = substr(hash('sha256', $pass), 5, 32); // DB password skirti 32 baitai, paimam is maisos vidurio
            $ulevel = $_POST['role'];

            $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            $sq1 = "UPDATE " . TBL_USERS . " (vartotojo_id, slapyvardis, email, slaptazodis, vardas, pavarde, roles_id)
          VALUES ('$userid','$user', '$mail' ,'$pass', '$firstname','$lastname', '$ulevel') WHERE slapyvardis=\"$user\"";
            $sql = "UPDATE " . TBL_USERS . " SET slapyvardis='$user' , email='$mail' , slaptazodis='$pass' , vardas='$firstname' , pavarde='$lastname' , roles_id='$ulevel' WHERE vartotojo_id='$edituserid'";
            if (mysqli_query($db, $sql)) {$_SESSION['message'] = "Redagavimas sėkmingas";} else { $_SESSION['message'] = "DB redagavimo klaida:" . $sql . "<br>" . mysqli_error($db);}

            // uzregistruotas

            if ($_SESSION['ulevel'] == $user_roles[ADMIN_LEVEL]) {header("Location:admin.php");} else {header("Location:  .php");}

            exit;
        }
    
}
// griztam taisyti
// session_regenerate_id(true);
header("Refresh:0 url=useredit.php?id='$edituserid'");exit;

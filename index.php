<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

session_start();
include "include/functions.php";
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Sandėlio projektas</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
                <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>

<?php

if (!empty($_SESSION['user'])) //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
{ // Sesijoje nustatyti kintamieji su reiksmemis is DB
    // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']

    inisession("part"); //   pavalom prisijungimo etapo kintamuosius
    $_SESSION['prev'] = "index";

    include "include/meniu.php"; //įterpiamas meniu pagal vartotojo rolę

    ?>
<div id="introMessage"><center>Sandėlio infomacinė sistema</center></td></tr></table> <br></div>
      <?php
} else {

    if (!isset($_SESSION['prev'])) {
        inisession("full");
    }
    // nustatom sesijos kintamuju pradines reiksmes
    else {if ($_SESSION['prev'] != "proclogin") {
        inisession("part");
    }
        // nustatom pradines reiksmes formoms
    }
    // jei ankstesnis puslapis perdavė $_SESSION['message']
    include "include/login.php";
}
?>
            </body>
</html>

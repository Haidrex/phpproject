<?php
session_start();
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "accept")) {header("Location: logout.php");exit;}

include "include/nustatymai.php";
include "include/functions.php";

$user = $_SESSION['userid'];
$userlevel = $_SESSION['ulevel'];
$role = "";
{foreach ($user_roles as $x => $x_value) {if ($x_value == $userlevel) {
    $role = $x;
}
}
}

$_SESSION['amount_accept_error'] = "";

$kodas = $_POST['accept'];
$kiekis = $_POST['amount'];
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT * FROM " . TBL_OFFER . " WHERE kodas=" . $kodas;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);
$productname = $row['pavadinimas'];
$offeredamount = $row['kiekis'];
$offeredprice = $row['kaina'];
$supplier = $row['tiekejoid'];

if (checkifhoused($productname, $supplier)) {
    $sql1 = "UPDATE " . TBL_PRODUCTS . " SET kiekis=kiekis+'$kiekis' WHERE pavadinimas='$productname' AND tiekejoid='$supplier'";
    $sql3 = "UPDATE " . TBL_OFFER . " SET busena=2 WHERE kodas='$kodas'";
    mysqli_query($db, $sql1);
    mysqli_query($db, $sql3);
} else {
    $sql2 = "INSERT INTO " . TBL_PRODUCTS . " (pavadinimas, kiekis, kaina,tiekejoid)
    VALUES ('$productname', '$kiekis' ,'$offeredprice','$supplier')";
    $sql4 = "UPDATE " . TBL_OFFER . " SET busena=2 WHERE kodas='$kodas'";
    mysqli_query($db, $sql2);
    mysqli_query($db, $sql4);
}


header("Location:offered.php");exit;

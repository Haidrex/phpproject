<?php

session_start();

if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "offer"))
{ header("Location: logout.php");exit;}
include("include/nustatymai.php");
include("include/functions.php");
$_SESSION['prev'] = "procoffer";
$_SESSION['name_error']="";
$_SESSION['pass_error']="";

$product = $_POST['item'];
$_SESSION['name_offer'] = $product;
$amount = $_POST['amount'];
$_SESSION['amount_offer'] = $amount;
$price = $_POST['price'];
$_SESSION['price_offer'] = $price;

if(checkitem($product, $amount, $price)){
    $itemid = md5(uniqid($product));
    $user=  $_SESSION['userid'];
    $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    $sql = "INSERT INTO " . TBL_PRODUCTS. " (kodas, pavadinimas, kiekis, kaina, busena  , tiekejoid)
    VALUES ('$itemid','$product', '$amount' ,'$price', 1, '$user')";

    if (mysqli_query($db, $sql)) 
    {$_SESSION['offer_message']="Pasiūlymas įvykdytas sėkmingai";}
    else {$_SESSION['offer_message']="DB pasiūlymo klaida:" . $sql . "<br>" . mysqli_error($db);}
}
header("Location:offer.php");exit;
?>

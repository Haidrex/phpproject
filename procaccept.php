<?php
session_start();
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "accept"))
{ header("Location: logout.php");exit;}

include("include/nustatymai.php");
include("include/functions.php");

$user=$_SESSION['userid'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
}

$_SESSION['amount_accept_error']="";

$kodas = $_POST['accept'];
$kiekis = $_POST['amount'];
$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$sql= "SELECT * FROM " . TBL_OFFER. " WHERE kodas=".$kodas;
$result = mysqli_query($db,$sql); 
$row = mysqli_fetch_array($result);
$productname = $row['pavadinimas'];
$offeredamount = $row['kiekis'];
$offeredprice = $row['kaina'];
$supplier = $row['tiekejoid'];


if(checkifhoused($productname, $supplier)){
    $sql1 = "UPDATE " . TBL_PRODUCTS. " SET kiekis=kiekis+'$kiekis' WHERE pavadinimas='$productname' AND tiekejoid='$supplier'";
    mysqli_query($db, $sql1);
}else{
    $sql2 = "INSERT INTO " . TBL_PRODUCTS. " (pavadinimas, kiekis, kaina, busena,tiekejoid) 
    VALUES ('$productname', '$kiekis' ,'$offeredprice' , 2,'$supplier')";
    mysqli_query($db, $sql2);
}


// if(checkifhoused($productname, $supplier)){
//     if($kiekis == $offeredamount){
//         $sql1= "UPDATE " . TBL_HOUSED. " SET kiekis=kiekis+'$kiekis' WHERE kodas=".$kodas;
//         mysqli_query($db, $sql1); 
//         $sql4 = "DELETE FROM " . TBL_OFFER. " WHERE kodas='$kodas'";
//         mysqli_query($db, $sql4);   
//     }
//     else{
//         $sql1= "UPDATE " . TBL_HOUSED. " SET kiekis=kiekis+'$kiekis' WHERE kodas=".$kodas;
//         $result1 = mysqli_query($db,$sql1);
//         $sql5= "UPDATE " . TBL_OFFER. " SET kiekis=kiekis-'$kiekis' WHERE kodas=".$kodas;
//         $result1 = mysqli_query($db,$sql5);
//     }
// }
// else{
//     if($kiekis == $offeredamount){
//         $sql2 = "UPDATE " . TBL_PRODUCTS. " SET busena=2 WHERE kodas=".$kodas;
//         mysqli_query($db, $sql2);
//         $_SESSION['amount_accept_error'] = mysqli_error($db);
//         header("Location:offered.php");exit;
//     }
//     else{
//         $sql2 = "INSERT INTO " . TBL_HOUSED. " (kodas, pavadinimas, kiekis, kaina, tiekejoid)
//         VALUES ('$kodas','$productname', '$kiekis' ,'$offeredprice' , '$supplier')";
//         mysqli_query($db, $sql2);
//         $sql5= "UPDATE " . TBL_OFFER. " SET kiekis=kiekis-'$kiekis' WHERE kodas=".$kodas;
//         $result1 = mysqli_query($db,$sql5);
//     }
// }
header("Location:offered.php");exit;
?>
<?php 

session_start();
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "sell"))
{ header("Location: logout.php");exit;}

include("include/nustatymai.php");
include("include/functions.php");

$user=$_SESSION['userid'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
}

$_SESSION['price_sell_error']="";
$_SESSION['amount_sell_error']="";

$sellitemid = $_POST['sell'];
$amount = $_POST['amount'];
$price = $_POST['price'];
$_SESSION['price_sell'] = $price;
$_SESSION['amount_sell'] = $amount;

$_SESSION['prev'] = "procsell";


if(checkamount($sellitemid, $amount)){
    $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    
    $sql3= "SELECT * FROM " . TBL_PRODUCTS. " WHERE kodas=".$sellitemid;
    $result = mysqli_query($db,$sql3); 
    $row = mysqli_fetch_array($result);
    $haveamount = $row['kiekis'];
    $newamount = $haveamount - $amount;
	$sql = "INSERT INTO " . TBL_SOLD. " (kiekis, suma, vadybininkoid, prekes_kodas)
          VALUES ('$amount', '$price', '$user', '$sellitemid')";

    $sql2 = "UPDATE " .TBL_PRODUCTS. " SET kiekis='$newamount' WHERE kodas='$sellitemid'";

    if(mysqli_query($db, $sql) && mysqli_query($db, $sql2)){
        $_SESSION['sold_message'] = "Sėkmingai parduota";
        
    }
    else{
        $_SESSION['sold_message'] = "Pardavimas nesėkmingas" .mysqli_error($db);
    }
    header("Location:items.php");
    exit;
}

 header("Location:sell.php?kodas='$sellitemid'");
 exit;
?>


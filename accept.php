<?php

session_start();

if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "offered")) {header("Location: logout.php");exit;}

include "include/nustatymai.php";
include "include/functions.php";
$user = $_SESSION['user'];
$userlevel = $_SESSION['ulevel'];
$role = "";
{foreach ($user_roles as $x => $x_value) {if ($x_value == $userlevel) {
    $role = $x;
}
}
}

$_SESSION['prev'] = "accept";
$kodas = $_GET['kodas'];
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT * FROM " . TBL_PRODUCTS . " WHERE kodas=" . $kodas;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);

$offeramount = $row['kiekis'];

?>

<html>

<head>
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
			<title>Registracija</title>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

            <link href="include/styles.css" rel="stylesheet" type="text/css" >
        </head>
        <body>
		    <div class="topnav">
                <a href="index.php">Pagrindinis</a>
                <a href="admin.php">Vartotojai</a>
                <a href="items.php">Sandėlis</a>
                <a href="offer.php">Siūlyti prekę</a>
                <a href="offered.php">Siūlomos prekės</a>
                <a href="logout.php">Atsijungti</a>
                <p id="currentUser">Prisijunges vartotojas: <?php echo $user; ?> Rolė: <?php echo $role; ?></p>
            </div>
        </body>

        <center><font size="5">Nurodykite norimą kiekį</font></center></td></tr></table> <br>
    <form id="myForm" method="POST" action="procaccept.php">
    <div class="form-group">
                <label for="exampleInputEmail1">Siūlomas kiekis: <?php echo $offeramount ?></label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="amount" min=1 max=<?php echo $offeramount ?> value="<?php echo $_SESSION['amount_sell']; ?>">
                <?php echo $_SESSION['amount_accept_error'];
?>
            </div>

            <button type="submit" class="btn btn-primary" name="accept" value="<?php echo $kodas ?>">Priimti</button>
    </form>
</html>
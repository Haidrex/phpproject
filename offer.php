<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
include "include/nustatymai.php";
include "include/functions.php";
// cia sesijos kontrole
if (empty($_SESSION['prev'])) {header("Location:logout.php");exit;}
$user = $_SESSION['user'];
$userlevel = $_SESSION['ulevel'];
$role = "";
{foreach ($user_roles as $x => $x_value) {if ($x_value == $userlevel) {
    $role = $x;
}
}
}
$_SESSION['prev'] = "offer";
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Prekės</title>
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
            <center><b><?php echo $_SESSION['offer_message']; ?></b></center>
        <form action="procoffer.php" method="POST" id="myForm">
            <div class="form-group">
                <label for="exampleInputEmail1">Pavadinimas</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="item" value="<?php echo $_SESSION['name_offer']; ?>">
                <?php echo $_SESSION['item_error'];
?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Kiekis</label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="amount" min=1 value="<?php echo $_SESSION['amount_offer']; ?>">
                <?php echo $_SESSION['amount_error'];
?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Kaina</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="price" step=".01" min=.01 value="<?php echo $_SESSION['price_offer']; ?>">
                <?php echo $_SESSION['price_error'];
?>
            </div>
            <button type="submit" class="btn btn-primary" name="offer" value="Prisijungti">Siūlyti</button>
        </form>
        </body>
</html>
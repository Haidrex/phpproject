<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']))
{ header("Location:logout.php");exit;}
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
}
$_SESSION['prev'] = "items";
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
            <center><font size="5">Turimos prekės ir jų likučiai sandėlyje</font></center></td></tr></table> <br>
            <table id="t01">
                <tr>
                    <th>ID</th>
                    <th>Pavadinimas</th>
                    <th>Tiekėjas</th>
                    <th>Kiekis sandėlyje</th>
                    <th>Pirkimo kaina</th>
                    <th></th>
                </tr>
                <?php
                $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

                $sql = "SELECT * FROM " . TBL_PRODUCTS. " WHERE busena=2";
                $result = mysqli_query($db,$sql);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr><td>".$row['kodas']."</td><td>".$row['pavadinimas']."</td><td>".$row['tiekejoid']."</td><td>".$row['kiekis'].
                    "</td><td>".$row['kaina']."€</td><td><button id=\"regButton\">Parduoti</button></td></tr>";
                }
                ?>
            </table>
        </body>
</html>
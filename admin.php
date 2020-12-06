<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta

session_start();
include "include/nustatymai.php";
include "include/functions.php";
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL])) {header("Location: logout.php");exit;}
$_SESSION['prev'] = "admin";
$user = $_SESSION['user'];
$userlevel = $_SESSION['ulevel'];
$role = "";
{foreach ($user_roles as $x => $x_value) {if ($x_value == $userlevel) {
    $role = $x;
}
}
}
date_default_timezone_set("Europe/Vilnius");
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
		<title>Administratoriaus sąsaja</title>
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

		<center><font size="5">Vartotojų registracija, peržiūra ir įgaliojimų keitimas</font></center></td></tr></table> <br>
		<center><b><?php echo $_SESSION['message']; ?></b></center>
		<center><a href="register.php"><button id="regButton">Registruoti</button></a></center>
		<table id="t01">
		<tr>
			<th>Prisijungimo Vardas</th>
			<th>Email</th>
			<th>Rolė</th>
			<th></th>
		</tr>

		<?php
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

$sql = "SELECT vartotojo_id,slapyvardis, email, role.pavadinimas FROM " . TBL_USERS . " u JOIN role ON u.roles_id=role.id";
$result = mysqli_query($db, $sql);
while ($row = mysqli_fetch_array($result)) {
    echo "<tr><td>" . $row['slapyvardis'] . "</td><td>" . $row['email'] . "</td><td>" . $row['pavadinimas'] . "</td><td><a href=\"useredit.php?id=" . $row['vartotojo_id'] . "\"><button id=\"regButton\"	>Redaguoti</button></a></td></tr>";
}
?>

		</table>
	</body>
</html>

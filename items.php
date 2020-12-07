<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
include "include/meniu.php";
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] == $user_roles[SUPPLIER_LEVEL])) {header("Location:logout.php");exit;}
$user = $_SESSION['user'];
$userlevel = $_SESSION['ulevel'];
$role = "";
{foreach ($user_roles as $x => $x_value) {if ($x_value == $userlevel) {
    $role = $x;
}
}
}
$_SESSION['prev'] = "items";
?>


            <center><font size="5">Turimos prekės ir jų likučiai sandėlyje</font></center></td></tr></table> <br>
            <center><b><?php echo $_SESSION['sold_message']; ?></b></center>
            <table id="t01">
                <tr>
                    <th>ID</th>
                    <th>Pavadinimas</th>
                    <th>Tiekėjo id</th>
                    <th>Kiekis sandėlyje</th>
                    <th>Pirkimo kaina</th>
                    <th></th>
                </tr>
                <?php
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

$sql = "SELECT * FROM " . TBL_PRODUCTS;
$result = mysqli_query($db, $sql);
while ($row = mysqli_fetch_array($result)) {
    echo "<tr><td>" . $row['kodas'] . "</td><td>" . $row['pavadinimas'] . "</td><td>" . $row['tiekejoid'] . "</td><td>" . $row['kiekis'] .
        "</td><td>" . $row['kaina'] . "€</td>";
    if (($userlevel == $user_roles["Vadybininkas"]) || ($userlevel == $user_roles[MANAGER_LEVEL])) {
        echo "<td><a href=\"sell.php?kodas=" . $row['kodas'] . "\"><button id=\"regButton\"	>Parduoti</button></a></td></tr>";
    } else {
        echo "<td> </td></tr>";
    }
}
?>
            </table>
        </body>
</html>
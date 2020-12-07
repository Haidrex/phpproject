<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
include "include/meniu.php";
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] == $user_roles[WAREHOUSE_LEVEL]) || ($_SESSION['ulevel'] == $user_roles[SUPPLIER_LEVEL])) {header("Location:logout.php");exit;}
$user = $_SESSION['user'];
$userlevel = $_SESSION['ulevel'];
$role = "";
{foreach ($user_roles as $x => $x_value) {if ($x_value == $userlevel) {
    $role = $x;
}
}
}
$_SESSION['message'] = "";
$_SESSION['prev'] = "sold";
?>


            <center><font size="5">Atliktų pardavimų sąrašas</font></center></td></tr></table> <br>
            <center><b><?php echo $_SESSION['sold_message']; ?></b></center>
            <table id="t01">
                <tr>
                    <th>ID</th>
                    <th>Parduotas kiekis</th>
                    <th>Pardavimo kaina</th>
                    <th>Vadybininko ID</th>
                    <th>Prekės kodas</th>
                </tr>
                <?php
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

$sql = "SELECT * FROM " . TBL_SOLD;
$result = mysqli_query($db, $sql);
while ($row = mysqli_fetch_array($result)) {
    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['kiekis'] . "</td><td>" . $row['suma'] . "€</td><td>" . $row['vadybininkoid'] .
        "</td><td>" . $row['prekes_kodas'] . "</td></tr>";
}
?>
            </table>
        </body>
</html>
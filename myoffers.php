<?php
// operacija3.php  Parodoma registruotų vartotojų lentelė

session_start();
include("include/meniu.php");
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[SUPPLIER_LEVEL]))
{ header("Location: logout.php");exit;}
$_SESSION['prev']="offered";
$userid=$_SESSION['userid'];
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
}
?>

            <center><font size="5">Mano siūlomos prekės</font></center></td></tr></table> <br>
            <center><b><?php echo $_SESSION['offered_message']; ?></b></center>
            <table id="t01">
                <tr>
                    <th>ID</th>
                    <th>Pavadinimas</th>
                    <th>Siūlomas kiekis</th>
                    <th>Vnt. Kaina</th>
                    <th>Būsena</th>
                </tr>
            <?php
                $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

                $sql = "SELECT * FROM " . TBL_OFFER. " WHERE busena=1 AND tiekejoid='$userid'";
                
                $sql1 = "SELECT u.kodas, u.pavadinimas, u.kiekis, u.kaina, busena.busena FROM " . TBL_OFFER . " u JOIN busena ON u.busena=busena.id WHERE tiekejoid='$userid'";
                $result = mysqli_query($db,$sql1);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr><td>".$row['kodas']."</td><td>".$row['pavadinimas']."</td><td>".$row['kiekis'].
                    "</td><td>".$row['kaina']."€</td><td>".$row['busena']."</td></tr>";
                }
            ?>

                
            </table>
  </body></html>

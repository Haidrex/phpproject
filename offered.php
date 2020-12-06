<?php
// operacija3.php  Parodoma registruotų vartotojų lentelė

session_start();
include("include/meniu.php");
if (!isset($_SESSION['prev']))
{ header("Location: logout.php");exit;}
$_SESSION['prev']="offered";
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
}
?>

            <center><font size="5">Siūlomos prekės iš tiekėjų</font></center></td></tr></table> <br>
            <center><b><?php echo $_SESSION['offered_message']; ?></b></center>
            <table id="t01">
                <tr>
                    <th>ID</th>
                    <th>Pavadinimas</th>
                    <th>Tiekėjas</th>
                    <th>Siūlomas kiekis</th>
                    <th>Vnt. Kaina</th>
                    <th></th>
                </tr>
            <?php
                $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

                $sql = "SELECT * FROM " . TBL_OFFER. " WHERE busena=1";
                $result = mysqli_query($db,$sql);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr><td>".$row['kodas']."</td><td>".$row['pavadinimas']."</td><td>".$row['tiekejoid']."</td><td>".$row['kiekis'].
                    "</td><td>".$row['kaina']."€</td><td><a href=\"accept.php?kodas=".$row['kodas']."\"><button id=\"regButton\" >Priimti</button></a>
                    <a href=\"deny.php?kodas=".$row['kodas']."\"><button id=\"regButton\">Atmesti</button></form></td></tr>";
                }
            ?>

                
            </table>
  </body></html>

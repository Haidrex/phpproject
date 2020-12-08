<?php

session_start();
include "include/meniu.php";
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[WAREHOUSE_LEVEL])) {header("Location: logout.php");exit;}

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
$sql = "SELECT * FROM " . TBL_OFFER . " WHERE kodas=" . $kodas;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);

$offeramount = $row['kiekis'];

?>


        <center><font size="5">Nurodykite norimą kiekį</font></center></td></tr></table> <br>
    <form id="myForm" method="POST" action="procaccept.php">
    <div class="form-group">
                <label for="exampleInputEmail1">Siūlomas kiekis: <?php echo $offeramount ?></label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="amount" min=1 max="<?php echo $offeramount; ?>" value="<?php echo $_SESSION['amount_sell']; ?>">
                <?php echo $_SESSION['amount_accept_error'];
?>
            </div>

            <button type="submit" class="btn btn-primary" id="accept" name="accept" value="<?php echo $kodas ?>">Priimti</button>
    </form>
    <script>
        var $input = $('input'),
            $register = $('#accept');    
        $register.attr('disabled', true);

        $input.keyup(function() {
            var trigger = false;
            $input.each(function() {
                if (!$(this).val()) {
                    trigger = true;
                }
            });
            trigger ? $register.attr('disabled', true) : $register.removeAttr('disabled');
        });
        </script>
</html>
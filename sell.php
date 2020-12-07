<?php

session_start();

include "include/meniu.php";

if (!isset($_SESSION['prev'])|| ($_SESSION['ulevel'] != $user_roles[MANAGER_LEVEL])) {header("Location: logout.php");exit;}


$user = $_SESSION['user'];
$userlevel = $_SESSION['ulevel'];
$role = "";
{foreach ($user_roles as $x => $x_value) {if ($x_value == $userlevel) {
    $role = $x;
}
}
}
$sellitemid = $_GET['kodas'];
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT * FROM " . TBL_PRODUCTS . " WHERE kodas=" . $sellitemid;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);
$haveamount = $row['kiekis'];
$boughtprice = $row['kaina'];
$_SESSION['prev'] = "sell";
?>


        <center><font size="5">Nurodykite parduodamą kiekį ir kainą</font></center></td></tr></table> <br>
        <form action="procsell.php" method="POST" id="myForm">
        <div class="form-group">
                <label for="exampleInputEmail1">Kiekis(Turime: <?php echo $haveamount ?>)</label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="amount" min=1 value="<?php echo $_SESSION['amount_sell']; ?>">
                <?php echo $_SESSION['amount_sell_error'];
?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Kaina(Pirkimo kaina: <?php echo $boughtprice ?>€)</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="price" step=".01" min=.01 value="<?php echo $_SESSION['price_sell']; ?>">
                <?php echo $_SESSION['price_sell_error'];
?>
            </div>
            <button type="submit" class="btn btn-primary" name="sell" id="register" value="<?php echo $sellitemid ?>">Parduoti</button>
        </form>

        <script>
        var $input = $('input'),
            $register = $('#register');    
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
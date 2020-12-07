<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
include "include/meniu.php";
// cia sesijos kontrole
if (empty($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[SUPPLIER_LEVEL])) {header("Location:logout.php");exit;}
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

        <center><font size="5">Pateikti pasiūlymo informaciją</font></center></td></tr></table> <br>
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
            <button type="submit" class="btn btn-primary" name="offer" id="offer" value="Prisijungti">Siūlyti</button>
        </form>
        </body>
        <script>
        var $input = $('input'),
            $register = $('#offer');    
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
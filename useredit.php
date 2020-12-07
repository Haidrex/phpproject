<?php
// register.php registracijos forma
// jei pats registruojasi rolė = DEFAULT_LEVEL, jei registruoja ADMIN_LEVEL vartotojas, rolę parenka
// Kaip atsiranda vartotojas: nustatymuose $uregister=
//                                         self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai galimi
// formos laukus tikrins procregister.php

session_start();
// registracija galima kai nera userio arba adminas
// kitaip kai sesija expirinasi blogai, laikykim, kad prev vistik visada nustatoma
include "include/meniu.php";
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL])) {header("Location: logout.php");exit;}
// pradinis bandymas registruoti
$user = $_SESSION['user'];
$userlevel = $_SESSION['ulevel'];
$edituserid = $_GET['id'];
$role = "";
{foreach ($user_roles as $x => $x_value) {if ($x_value == $userlevel) {
    $role = $x;
}
}
}
$_SESSION['prev'] = "useredit";

$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT * FROM " . TBL_USERS . " WHERE vartotojo_id=" . $edituserid;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);
$username = $row['slapyvardis'];
$firstname = $row['vardas'];
$lastname = $row['pavarde'];
$email = $row['email'];
$password = $row['slaptazodis'];
$decryptedpass = substr(hash('sha256', $password), 5, 32)
?>
			<form action="procuseredit.php" method="POST" id="myForm">
        <div class="form-group">
            <label for="exampleInputEmail1">Prisijungimo vardas</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user"  value="<?php echo $username ?>">
            <?php echo $_SESSION['name_error'];
?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Vardas</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="firstname" value="<?php echo $firstname ?>">
            <?php echo $_SESSION['name_error'];
?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Pavardė</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="lastname" value="<?php echo $lastname ?>">
            <?php echo $_SESSION['name_error'];
?>
		</div>
		<div class="form-group">
            <label for="exampleInputEmail1">Elektroninis paštas</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $email ?>">
            <?php echo $_SESSION['name_error'];
?>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Slaptazodis</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="pass" value="<?php echo $_SESSION['pass_login'] ?>">
            <?php echo $_SESSION['pass_error'];
?>
        </div>
        <label for="role">Pasirinkite rolę</label>
		<select class="custom-select" name="role">
            <?php
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$sql = mysqli_query($db, "SELECT id,pavadinimas FROM role");
while ($row = $sql->fetch_assoc()) {
    echo "<option value=" . $row['id'] . ">" . $row['pavadinimas'] . "</option>";
}
?>
			</select>
        <button type="submit" class="btn btn-primary" name="edituser" value="<?php echo $edituserid ?>">Registruoti</button>
        </form>
    </html>


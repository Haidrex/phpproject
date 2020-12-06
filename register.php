<?php
// register.php registracijos forma
// jei pats registruojasi rolė = DEFAULT_LEVEL, jei registruoja ADMIN_LEVEL vartotojas, rolę parenka
// Kaip atsiranda vartotojas: nustatymuose $uregister=
//                                         self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai galimi
// formos laukus tikrins procregister.php

session_start();
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "admin")) { header("Location: logout.php");exit;} // registracija galima kai nera userio arba adminas
// kitaip kai sesija expirinasi blogai, laikykim, kad prev vistik visada nustatoma
include("include/nustatymai.php");
include("include/functions.php");
if ($_SESSION['prev'] != "procregister")  inisession("part");  // pradinis bandymas registruoti
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
}
$_SESSION['prev']="register";
?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
			<title>Registracija</title>
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
            <center><font size="5">Naujo vartotojo registracija</font></center>
			<form action="procregister.php" method="POST" id="myForm">
        <div class="form-group">
            <label for="exampleInputEmail1">Prisijungimo vardas</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user" value="<?php echo $_SESSION['name_login'];  ?>">
            <?php echo $_SESSION['name_error']; 
			?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Vardas</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="firstname" value="<?php echo $_SESSION['first_name_login'];  ?>">
            <?php echo $_SESSION['name_error']; 
			?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Pavardė</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="lastname" value="<?php echo $_SESSION['last_name_login'];  ?>">
            <?php echo $_SESSION['name_error']; 
			?>
		</div>
		<div class="form-group">
            <label for="exampleInputEmail1">Elektroninis paštas</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $_SESSION['mail_login'];  ?>">
            <?php echo $_SESSION['name_error']; 
			?>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Slaptazodis</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="pass" value="<?php echo $_SESSION['pass_login']; ?>">
            <?php echo $_SESSION['pass_error']; 
			?>
        </div>
        <label for="role">Pasirinkite rolę</label>
		<select class="custom-select" name="role">
            <?php 
                $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
                $sql = mysqli_query($db, "SELECT id,pavadinimas FROM role");
                while ($row = $sql->fetch_assoc()){
                echo "<option value=".$row['id'].">" . $row['pavadinimas'] . "</option>";
                }
            ?>
			</select>
        <button type="submit" class="btn btn-primary" name="register" value="Registruoti">Registruoti</button>
        </form>          
        </body>
    </html>
   

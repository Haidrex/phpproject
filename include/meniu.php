<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 
    /*
     echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b> <br>";
        echo "</td></tr><tr><td>"; */
        //if ($_SESSION['user'] != "guest") echo "[<a href=\"useredit.php\">Redaguoti paskyrą</a>] &nbsp;&nbsp;";
        //echo "[<a href=\"operacija1.php\">Demo operacija1</a>] &nbsp;&nbsp;";
       // echo "[<a href=\"operacija2.php\">Demo operacija2</a>] &nbsp;&nbsp;";
     //Trečia operacija tik rodoma pasirinktu kategoriju vartotojams, pvz.:
     ?>
     <?php
        if (($userlevel == $user_roles["Administratorius"]) || ($userlevel == $user_roles[ADMIN_LEVEL] )) {
            ?>
            <!--echo "[<a href=\"operacija3.php\">Demo operacija3</a>] &nbsp;&nbsp;";-->
            
            <head>
                <title>IT Projektas</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
                <link rel="stylesheet" href="include/styles.css">
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
            <div id="introMessage"><center>Sandėlio infomacinė sistema</center></td></tr></table> <br></div>
            </body>
            
            <?php
       		}
        ?>       
    <?php
        if (($userlevel == $user_roles["Vadybininkas"]) || ($userlevel == $user_roles[MANAGER_LEVEL] )) {
            ?>
            <!--echo "[<a href=\"operacija3.php\">Demo operacija3</a>] &nbsp;&nbsp;";-->
            
            <head>
                <title>IT Projektas</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
                <link rel="stylesheet" href="include/styles.css">
            </head>
            <body>
            <div class="topnav">
                <a href="index.php">Pagrindinis</a>
                <a href="items.php">Sandėlis</a>
                <a href="logout.php">Atsijungti</a>
                <p id="currentUser">Prisijunges vartotojas: <?php echo $user; ?> Rolė: <?php echo $role; ?></p>
            </div> 
            <div id="introMessage"><center>Sandėlio infomacinė sistema</center></td></tr></table> <br></div>
            </body>
            
            <?php
       		}
        ?> 
 
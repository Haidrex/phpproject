<?php
// login.php - tai prisijungimo forma, index.php puslapio dalis
// formos reikšmes tikrins proclogin.php. Esant klaidų pakartotinai rodant formą rodomos klaidos
// formos laukų reikšmės ir klaidų pranešimai grįžta per sesijos kintamuosius
// taip pat iš čia išeina priminti slaptažodžio.
// perėjimas į registraciją rodomas jei nustatyta $uregister kad galima pačiam registruotis

if (!isset($_SESSION)) {header("Location: logout.php");exit;}
$_SESSION['prev'] = "login";
include "include/nustatymai.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>IT Projektas</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="include/loginstyle.css">
</head>
<body>
    <div id="loginMessage"><center>Sandėlio infomacinė sistema Rytis Kačinskis IFA-8/1</center></td></tr></table> <br></div>
        <form action="proclogin.php" method="POST" id="myForm">
        <div class="form-group">
            <label for="exampleInputEmail1">Prisijungimo vardas</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user" value="<?php echo $_SESSION['name_login']; ?>">
            <?php echo $_SESSION['name_error'];
?>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Slaptazodis</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="pass" value="<?php echo $_SESSION['pass_login']; ?>">
            <?php echo $_SESSION['pass_error'];
?>
        </div>
        <button type="submit" class="btn btn-primary" name="login" value="Prisijungti">Prisijungti</button>
        </form>
</body>
</html>



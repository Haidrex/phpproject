<?php

session_start();

if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "offered")) {header("Location: logout.php");exit;}

include "include/nustatymai.php";
include "include/functions.php";

$itemid = $_GET['kodas'];

$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

$sql = "UPDATE " . TBL_OFFER . " SET busena='3' WHERE kodas='$itemid'";

mysqli_query($db, $sql);
$_SESSION['offered_message'] = mysqli_error($db);
header("Location:offered.php");
exit;

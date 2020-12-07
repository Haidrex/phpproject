<?php

session_start();
include "include/nustatymai.php";
include "include/functions.php";

if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[WAREHOUSE_LEVEL])) {header("Location: logout.php");exit;}



$itemid = $_GET['kodas'];

$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

$sql = "UPDATE " . TBL_OFFER . " SET busena='3' WHERE kodas='$itemid'";

mysqli_query($db, $sql);
$_SESSION['offered_message'] = mysqli_error($db);
header("Location:offered.php");
exit;

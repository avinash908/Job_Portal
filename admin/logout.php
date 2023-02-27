<?php 
include '../Db.php';
$logout = Db::logout();
header("location:login.php");
?>
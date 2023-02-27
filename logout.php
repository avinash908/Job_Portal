<?php
include 'Db.php';
Db::logout();
header("location:login.php");
?>
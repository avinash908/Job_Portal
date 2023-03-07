<?php
include 'Db.php';
if (isset($_POST['reg'])) {
	@$dob = $_POST['bday']."/".$_POST['bmonth']."/".$_POST['byear'];
	$reg_rec = array('fname'=>$_POST['fname'],'lname'=>$_POST['lname'],'email'=>$_POST['email'],'pass'=>$_POST['pass'],'dob'=>$dob, 'gender'=>$_POST['gender'],'status'=>$_POST['status']);

		$Db = new Db;
		$registered = $Db->reg_user($reg_rec);
		if ($registered) {
			echo "<script>alert('you are successfuly registered');</script>";
			echo "<script>window.location.href = 'login.php';</script>";
		}
		else{
			echo "<script>alert('there is error');</script>";
			echo "<script>window.location.replace('login.php');</script>";
		}
}
else{
	header("location:index.php");
}
?>
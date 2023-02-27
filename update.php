<?php 
include 'Db.php';
session_start();
if (!isset($_SESSION['user-id'])) {
  header("location:login.php");
}
?>
<?php
if (isset($_POST['fname'])) {
	@$user_rec_4_update = array(
		'fname'=>$_POST['fname'],
		'lname'=>$_POST['lname'],
		'fathername'=>$_POST['fathername'],
		'dob'=>$_POST['dob'],
		 'gender'=>$_POST['gender'],
		 'martial_status'=>$_POST['martial_status'],
		 'nationality'=>$_POST['nationality'],
		  'religion'=>$_POST['religion'],
		  'cnic'=>$_POST['cnic'],
		  'country'=>$_POST['country'],
		  'city'=>$_POST['city'],
		  'area'=>$_POST['area'],
		  'phone'=>$_POST['phone'],
		  'language'=>$_POST['language'],
		  'qualification'=>$_POST['qualification'],
		  'skills'=>$_POST['skills'],
		  'experience'=>$_POST['experience'],
		  'salary'=>$_POST['salary'],
		  'about'=>$_POST['about'],
		  'company'=>$_POST['company'],
			'uid'=>$_POST['uid']);
		$update = Db::update_user_rec($user_rec_4_update);
		if ($update) {
			echo "
			<script>
				$(document).ready(function(){
					swal('UPDATED', '', 'success');
					setInterval(function(){
						window.location.replace('profile.php?id=".$_POST['uid']."');
					},1500);
				})
			</script>";
		}
		else{
			echo "
			<script>
				$(document).ready(function(){
					swal('Somthing is missing', '', 'info');
					setInterval(function(){
						window.location.replace('profile.php?id=".$_POST['uid']."');
					},1500);
				})
			</script>";
		}
}

?>
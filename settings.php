<?php 
include 'Db.php';
session_start();
if (!isset($_SESSION['user-id'])) {
  header("location:login.php");
}
 $id = $_SESSION['user-id'];
 $settings_rec = Db::user_rec($id);
 if ($st = $settings_rec->fetch_object()) {}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo$st->firstname." "; ?>Settings</title>
	<?php require 'links.php'; ?>
	<style type="text/css">
		.change_input {padding: 20px;border-radius: 0px;}
	</style>
</head>
<body>

<?php require 'header.php'; ?>
<?php 
if (isset($_POST['change'])) {
	$current_pass = $_POST['current_pass'];
	$new_pass = $_POST['new_pass2'];
	$old_pass = $st->password;
	$id = $st->uid;
	if ($old_pass==$current_pass) {
		$changed = Db::change_password($id,$new_pass);
		if ($changed) {
			$message = "
			<br>
			<p class='alert alert-success'>
			<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			Password Has Been Changed
			</p>";
		}
	}
	else{
		$message = "
		<br>
		<p class='alert alert-danger'>
		<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		Wrong Old Password ..
		</p>";
	}
}
?>
<div class="container">
	<div class="col-md-8 col-md-offset-2">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                        	<li><h4>Settings : &nbsp;</h4></li>
                            <li class="active"><a href="#tab1default" data-toggle="tab">Change Password</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Change Email</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
                       	<div class="row">
							<div class="col-sm-10 col-sm-offset-1">
							   <form action="" method="post">
							    <label>Current Password</label>
							    <div class="form-group "> 
					                <input type="password"  class="form-control change_input" name="current_pass" placeholder="Current Password" required> <div>
					                	<?php
					                if (isset($message)) {echo $message;} ?> 	
					                </div>
					            </div> 
							       <label>New Password</label>
					            <div class="form-group "> 
					                <input type="password" id="pass_1" name="new_pass1"  class="form-control pass change_input" placeholder="New Password" required> 
					            </div> 
							       <label>Confirm Password</label>
					            <div class="form-group pass_show"> 
					                <input type="password" id="pass_2" name="new_pass2"  class="form-control pass change_input" placeholder="Confirm Password" required>
					               <p id="msg"></p> 
					            </div> 
					            <div class="form-group">
					            	<input type="submit" value="Change" name="change" class="btn btn-primary btn-block btn-lg" style="border-radius:0px;">
					            </div>
					           </form>
							</div>  
						</div>
                    	</div>
                        <div class="tab-pane fade" id="tab2default">
                        	<div class="col-sm-10 col-sm-offset-1">
							 <form action="" method="post">
							   	<label>Old Email</label>
							   <div class="form-group "> 
							   	<input type="email" name="old_email" <?php echo "value='".$st->email."' "; ?> class="form-control change_input" placeholder="Old Email" required>
							   </div>
							   	<label>New Email</label>
							   <div class="form-group">
							   	<input type="email" name="new_email" class="form-control change_input" placeholder="New Email .." required>
							   </div>
							   <p><?php if (isset($email_msg)) { echo $email_msg; } ?></p>
							   <label>&nbsp;</label>
							   <div class="form-group">
							   	<input type="submit" name="change_email" value="Change Email" class="btn btn-primary btn-lg btn-block" style="border-radius:0px;">
							   	</div>
							   	<br>
					         </form>
							</div>
                        </div>
                    </div>
                </div>
                <?php 
                	if (isset($_POST['change_email'])) {
                		$new_email = $_POST['new_email'];
                		$id = $st->uid;
                		if ($new_email != ' ') {
                			$email_changed = Db::change_email($id,$new_email);
	                		if ($email_changed) {
	                			echo "
	                			<script>
	                			$(document).ready(function(){
	                				swal('Email Has Been Changed', '','success');
	                				setInterval(function(){
	                					window.location.replace('settings.php');
	                				},1500);
	                			})
	                			</script>";
	                		}
	                		else{
	                			$email_msg = "Wrong Old Email";
	                		}
	                	}
                	}
                ?>
                <p>&nbsp;</p>
            </div>
        </div>
</div>
<?php require 'footer.php'; ?>
</body>
</html>
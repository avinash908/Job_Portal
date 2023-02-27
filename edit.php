<?php 
include 'Db.php';
session_start();
if (!isset($_SESSION['user-id'])) {
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
<?php 
require 'links.php';
?>
	<link rel="stylesheet" type="text/css" href="css/user-profile.css">
<style type="text/css">
	body {
    background: #F1F3FA;
}
.form-control{
	border-radius: 0px;
}
	.profile-img{
    text-align: center;
}
.profile-img img{
    width: 99%;
    height: 100%;
}

td{
	padding: 14px !important;
}
</style>
</head>
<body>
<?php 
require 'header.php';
?>
<?php 
 $uid =$_GET['id'];
 if ($uid != $_SESSION['user-id']) {
 	header("location:index.php");
 }
  $records = Db::rec_4_update($uid);
  if ($res = $records->fetch_object()) {
  }
?>
<div class='container'>
	<p id="msg"></p>
	<div class="col-md-3">
		<div class="profile-sidebar">
			 <div class="profile-img">
                <?php echo "<img src='".$res->uid."/".$res->profile_img."' >"; ?>
              </div>
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?php echo $res->firstname." ".$res->lastname; ?>
					</div>
					<div class="profile-usertitle-job">
						<?php echo $res->status; ?>
					</div>
				</div>
				<?php if ($_SESSION['user-id'] == $res->uid) {?>
				<div class="profile-userbuttons">
				</div>
				<div class="profile-usermenu">
					<ul class="nav">
						<li>
							<?php echo "<a href='profile.php?id=".$res->uid."'>" ;?>
							<i class="glyphicon glyphicon-home"></i>
							Overview </a>
						</li>
						<?php if ($res->status == 'Employer') { ?>
              <li>
              <?php echo "<a href='posted-jobs.php?id=".$res->uid."'>" ;?>
              <i class="glyphicon glyphicon-list-alt"></i>
              Posted Jobs </a>
            </li>
            <li >
              <?php echo "<a href='job-applications.php?id=".$res->uid."'>" ;?>
              <i class="glyphicon glyphicon-file"></i>
              Job Applications </a>
            </li>
            <?php }?>
					</ul>
				</div>
        <?php }?>
				<!-- END MENU -->
			</div>
	</div>
	<div class="col-md-9">
	<div class="profile-content">
		<div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title" >Edit Info</h3>
            </div>
        <div class="panel-body">
		<table class="table ">
			<form action="" method="post" id="myform">
				<tr>
					<td><b>First Name :</b></td>
					<td><input type="text" id='fname' name="fname" class="form-control" <?php echo "value='".$res->firstname."' "; ?> required></td>
					<td><b>Last Name :</b></td>
					<td><input type="text" id='lname' name="lname" class="form-control" <?php echo "value='".$res->lastname."' "; ?> required></td>
				</tr>
				<tr>
					<td><b>Email :</b></td>
					<td><label class="form-control"> <?php echo $res->email; ?></label></td>
					<td><b>Father Name :</b></td>
					<td><input type="text" id='fathername' name="fathername" class="form-control" <?php echo "value='".$res->father_name."' "; ?> required></td>
				</tr>
				<tr>
					<td><b>Date Of Birth :</b></td>
					<td><input type="text" id='dob' name="dob" class="form-control" <?php echo "value='".$res->dob."' "; ?> required></td>
					<td><b>Gender :</b></td>
					<td>
						<select id='gender' name="gender" class='form-control'>
							<?php echo "<option value='".$res->gender."' >".$res->gender."</option>"; 
								if ($res->gender=='Male') {
									echo "<option value='Female'>Female</option>";
								}
								else{
									echo "<option value='Male'>Male</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><b>Martial Status :</b></td>
					<td> 
						<select id='martial_status' name="martial_status" class="form-control">
							<?php echo "<option value='".$res->martial_status."' >".$res->martial_status."</option>"; 
								if ($res->martial_status=='Married') {
									echo "<option value='Single'>Sinlge</option>";
								}
								else if(($res->martial_status=='Single')){
									echo "<option value='Married'>Married</option>";
								}
								else{
									echo "<option value='Married'>Married</option>";
									echo "<option value='Single'>Single</option>";
								}
							?>
						</select>
					</td>
	                              
					<td><b>Nationality :</b></td>
					<td><input type="text" id='nationality' name="nationality" class="form-control" <?php echo "value='".$res->nationality."' "; ?> required></td>
				</tr>
				<tr>
					<td><b>Religion :</b></td>
					<td><input type="text" id='religion' name="religion" class="form-control" <?php echo "value='".$res->religion."' "; ?> required></td>
					<td><b>CNIC :</b></td>
					<td><input type="text" id='cnic' name="cnic" class="form-control" <?php echo "value='".$res->cnic."' "; ?> required></td>
				</tr>
				<tr>
					
					<td><b>Country :</b></td>
					<td><input type="text" id='country' name="country" class="form-control" <?php echo "value='".$res->country."' "; ?> required></td>
					<td><b>City :</b></td>
					<td><input type="text" id='city' name="city" class="form-control" <?php echo "value='".$res->city."' "; ?> required></td>
				</tr>
				<tr>	
					<td><b>Area :</b></td>
					<td><?php echo "<textarea id='area' name='area' class='form-control'>".$res->area."</textarea>"?></td>
					<td><b>Phone :</b></td>
					<td><input type="text" id='phone' name="phone" class="form-control" <?php echo "value='".$res->phone_num."' "; ?> required></td>
				</tr>
				<tr>	
					<td><b>Language Know :</b></td>
					<td>
					<textarea id="language" name="language" class="form-control"><?php echo $res->language;?></textarea>
					<?php if ($res->status == 'Job Seeker') { ?>
					<td><b>Qualification :</b></td>
					<td>
					<select class="form-control" id='qualification' name="qualification">
							<?php 
								echo "<option value='".$res->qualification."'>".$res->qualification."</option>";
							?>
							<option value="Under Matriculation">Under Matriculation</option>
							<option value="Matriculation">Matriculation</option>
							<option value="Intermediate">Intermediate</option>
							<option value="Bachelor">Bachelor</option>
							<option value="Master">Master</option>
							<option value="MPhil">MPhil</option>
							<option value="PHD">PHD</option>
						</select>
					</td>
				</td>
				</tr>
				<tr>
				
				<td><b>Skills :</b></td>
					<td>
							<textarea id='skills' name="skills" class="form-control">
							<?php 
								echo $res->skills;
							?>
							</textarea>
					</td>
					<td><b>Experience :</b></td>
					<td>
						<select id='experience' name="experience" class="form-control">
							<?php
						echo "<option value='".$res->experience."'>".$res->experience."</option>";
							echo "<option value='less than 1 year'>less than 1 year</option>";
							echo "<option value='1 year'>1 year</option>";
								for($i=2; $i<=35; $i++){
									echo "<option value='".$i." years'>".$i." years</option>";				
								}
							?>
							<option value="More than 35 years">More than 35 years</option>
						</select>
					</td>	
				</tr>
				<tr>
					
					<td><b>Expected Salary :</b></td>
					<td>
						<input type="text" <?php echo "value='".$res->expected_salary."'"; ?> id='salary' name="salary" class='form-control'>
					</td>
					<?php } ?>
					<td><b>About :</b></td>
					<td><textarea id="about" name="about" class="form-control"><?php echo $res->about; ?></textarea></td>
				</tr>
				<?php 
						if ($res->status == 'Employer') {				
					?>
					<tr>
					<td><b>Company :</b></td>
					<td><?php echo "<input type='text' id='company' name='company' value='".$res->company."'  class='form-control'>"; ?></td>
				<?php }?>
					</tr>
				<tr>
					<td colspan="4">
						<div class="panel-footer">
        	<input type='submit' id="update" name="update" value="UPDATE" class="btn btn-success">
        	<?php echo "<a  href='profile.php?id=".$res->uid."' class='btn btn-danger'
        	style='float:right;'>CANCEL</a>"; ?>
        				</div>
        			</td>
        		</tr>
        		<?php 
        		echo "<input type='hidden' id='uid' name='uid' value='".$res->uid."'> ";
        		?>
			</form>
		</table>
		</div>
		
	</div>
	</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function (e) {
			$("#myform").on('submit', function (e) {
				e.preventDefault();
				$.ajax({
					url : 'update.php',
					method : "post",
					data : new FormData(this),
					contentType: false,
		         	cache: false,
		   			processData:false,
					success:function (data) {
						$("#msg").html(data);
					}
				})
			})
		})
	</script>
</div>
<?php 
require 'footer.php';
?>
</body>
</html>
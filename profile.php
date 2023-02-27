<?php 
include 'Db.php';
session_start();
if (!isset($_SESSION['user-id'])) {
  header("location:login.php");
}
?>
<?php 
	$uid = $_GET['id'];
	$result = Db::user_rec($uid);
	if ($res = $result->fetch_object()) {
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $res->firstname." ".$res->lastname; ?></title>
	<?php 
		require 'links.php';
	?>
	<link rel="stylesheet" type="text/css" href="css/user-profile.css">
  <link rel="stylesheet" type="text/css" href="css/cards.css">
	<style type="text/css">
		  .profile-img{
    text-align: center;
}
.profile-img img{
    width: 99%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 100%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
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


<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">File upload form</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form method='post' action='' enctype="multipart/form-data" id="profile">
          Select file : <input type='file' name='img' id='img' class='form-control' required><br>
          <input type="hidden" id="id" name="id"<?php echo "value='".$res->uid."' "; ?>  > 
          <input type='submit' class='btn btn-info' value='Upload' id='upload'>

        </form>
      </div>
 
    </div>

  </div>
</div>
<script type="text/javascript">
		$(document).ready(function (e) {
			$("#profile").on('submit', (function (e) {
				e.preventDefault();
				$.ajax({
					url : 'upload.php',
					type : 'POST',
					data:  new FormData(this),
		   			contentType: false,
		         	cache: false,
		   			processData:false,
					success:function (data) {
						$(".profile-img").html(data);
					}
				})
			}))
		})
	</script>


<div class="container">
    <div class="row profile">
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
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadModal">Change Photo</button>
				</div>
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
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
            <li>
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
      <div class="row">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <span style="float: right"></span>
              <h3 class="panel-title">Profile Info</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class=" col-md-12 col-lg-12 "> 
                  <script>
                        $(document).ready(function(){
                          $("td:empty").html("<b><font color='#FF0000'>No Data</font></b>");
                          $("#more_info:empty").html("<b>No additional information.</b>");
                        });
                  </script>
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><b>First Name</b></td>
                        <td><?php echo $res->firstname; ?></td>
                        <td><b>Last Name</b></td>
                        <td><?php echo $res->lastname; ?></td>
                      </tr>
                      <tr>
                        <td><b>Email</b></td>
                        <td><?php echo $res->email; ?></td>
                        <td><b>Father Name</b></td>
                        <td><?php echo $res->father_name ?></td>
                      </tr>
                      <tr>
                        <td><b>Date of Birth</b></td>
                        <td ><?php echo $res->dob; ?></td>
                        <td><b>Gender</b></td>
                        <td><?php echo $res->gender; ?></td>
                      </tr>
                      <tr>
                        <td><b>Martial Status</b></td>
                        <td><?php echo $res->martial_status; ?></td>
                        <td><b>Nationality</b></td>
                        <td><?php echo $res->nationality; ?></td>
                      </tr>
                      <tr>
                        <td><b>Religion</b></td>
                        <td><?php echo $res->religion; ?></td>
                        <td><b>Language</b></td>
                        <td><?php echo $res->language; ?></td>
                      </tr>
                      <tr>
                        <td><b>CNIC</b></td>
                        <td><?php echo $res->cnic; ?></td>
                        <td><b>Country</b></td>
                        <td><?php echo $res->country; ?></td>
                      </tr>
                      <tr>
                        <td><b>City</b></td>
                        <td><?php echo $res->city; ?></td>
                        <td><b>Area</b></td>
                        <td><?php echo $res->area; ?></td>
                      </tr>
                      	<tr>
	                        <td><b>Mobile or Phone</b></td>
	                        <td><?php echo $res->phone_num; ?></td>
                     		<?php if ($res->status == 'Job Seeker') { ?>
                        <td><b>Qualification</b></td>
                     		<td><?php echo $res->qualification; ?></td>
                     	</tr>
                     	<tr>
                     		<td><b>Skills</b></td>
                     		<td><?php echo $res->skills; ?></td>
                     		<td><b>Experience</b></td>
                     		<td><?php echo $res->experience; ?></td>
                     	</tr>
                      <tr>
                        <td><b>Expected Salary</b></td>
                        <td><?php echo $res->expected_salary; ?></td>
                      <?php }?>

                        <td><b>About</b></td>
                        <td><?php echo $res->about; ?></td>
                      </tr>
                      <?php 
            if ($res->status == 'Employer') {       
          ?>
          <tr>
          <td><b>Company :</b></td>
          <td><?php echo $res->company; ?></td>
        <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        <?php if ($_SESSION['user-id'] == $res->uid) {?>
                 <div class="panel-footer">
                    <p align="right">
                      <?php echo"<a href='edit.php?id=".$res->uid."' class='btn btn-success'>" ?>Edit Profile</a>
                    </p>
                 </div>
          <?php }?>
          </div>
      </div>
    </div>
		</div>
	</div>
</div>
<?php 
require 'footer.php';
?>
</body>
</html>

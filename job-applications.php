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
                <?php echo "<img src='".$res->uid."/".$res->profile_img."'  class='thumbnail'>"; ?>
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
            <li class="active">
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
              <h3 class="panel-title">Job Applications</h3>
            </div>
            <div class="panel-body">
              <?php 
  if ($res->status == 'Employer') {?>
              <div class="table-responsive ">
                <table class="table table-bordered">
                  <tr>
                    <th>Serial NO #</th>
                    <th>Job Name</th>
                    <th>Applicant Profile</th>
                    <th>Applicant Email</th>
                    <th>Applicant Phone</th>
                    <th>Action</th>
                  </tr>
                  <?php
                  $id = $_GET['id'];
                  $application = Db::applications($id);
                  $sno = 1;
                  while ($ap = $application->fetch_object()) {
                    echo "<tr class='ap_rec'>";
                    echo "<td align='center'>".$sno++."</td>";
                    echo "<td>".$ap->job_name."</td>";
                    echo "<td><a href='profile.php?id=".$ap->applicant_id."' target=blank''>".$ap->applicant_name."</a></td>";
                    echo "<td>".$ap->applicant_email."</td>";
                    echo "<td>".$ap->applicant_phone."</td>";
                    echo "<td>
                    <input type='hidden' value='".$ap->id."' class='aid'>
                    <a href='' class='delete btn btn-danger'>DELETE</a></td>";
                    echo "</tr>";
                  }
                   ?>
                </table>
              </div>
            <?php }?>
            <script type="text/javascript">
                $(".delete").on("click", function() {
                  var $div = $(this).closest(".ap_rec");
                  var aid = $div.find(".aid").val();

                  $.ajax({
                    url: 'action.php',
                    method: 'POST',
                    data: {
                      apid: aid,
                    },
                    success: function(data) {
                      swal('Deleted','','success');
                    },
                  });
                });
              </script>
                </div>
          </div>
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

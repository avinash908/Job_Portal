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
						  <li class="active">
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
              <h3 class="panel-title">Job Posted</h3>
            </div>
            <div class="panel-body">
              <?php 
  if ($res->status == 'Employer') {?>

                <div class="job-posts" id="msg">
                    <?php 
              $my_posted_jobs = Db::user_posted_jobs($res->uid);
              while ($jb = $my_posted_jobs->fetch_object()) {
            ?>
                      <div class="col-sm-6">
                          <div class="card-box" style="word-break: break-word;">
                            <b>Job title</b>
                              <div class="card-title">
                                  <h2><?php echo $jb->title?></h2>
                              </div>
                              <div class="job-details"> 
                                  <p><b>Company :</b> <?php echo $jb->company; ?></p>
                                  <p><b>Type :</b> <?php echo $jb->type; ?> </p> 
                                  <p><b>Salary :</b> <?php echo $jb->salary; ?> </p> 
                                  <p><b>Location :</b> <?php echo $jb->province." /".$jb->city; ?> </p> 
                                  <p><b>Desricption :</b> <?php echo $jb->descrimination?></p>
                                  <p><b>Posted  on :</b> <?php echo $jb->date_time ?></p>
                                  <?php 
                                  echo "<input type='hidden' value='".$jb->id."' class='jid'> ";
                                  ?>
                                  
                                 <?php echo "<a href='edit-job.php?id=".$jb->id."' class='btn btn-warning'>Edit</a>";
                                 ?>

                            <a href="" class="Delete btn btn-default" alt='Delete' style="float: right;">Delete &times;</a>
                              </div>
                          </div>
                      </div> 
              <?php }?>
                </div>
              <script type="text/javascript">
                $(".Delete").on("click", function() {
                  var $div = $(this).closest(".card-box");
                  var jid = $div.find(".jid").val();

                  $.ajax({
                    url: 'action.php',
                    method: 'POST',
                    data: {
                      jobid: jid,
                    },
                    success: function(data) {
                      swal('Deleted','job has been deleted','success');
                    },
                  });
                });
              </script>
            <?php }?>
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

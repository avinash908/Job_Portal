<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/sweetlib.js"></script>

<?php 
include 'Db.php';
session_start();
if (!isset($_SESSION['user-id'])) {
  header("location:login.php");
}
?>
<?php 
if (isset($_POST['pro_id'])) {
	$province = $_POST['pro_id'];
	 $result = Db::city($province);
	 echo "<option value=' '>Select City</option>";
	while ($cities = $result->fetch_object()) {
		echo "<option value='".$cities->city."'>".$cities->city."</option>";
	}
}
?>
<?php 
if (isset($_POST['title'])) {
	$job_rec = array(
		'title'=>$_POST['title'],
		'province'=>$_POST['province'],
		'country'=>$_POST['country'],
		'city'=>$_POST['city'],
		'type'=>$_POST['type'],
		'category'=>$_POST['category'],
		'salary'=>$_POST['salary'],
		'decription'=>$_POST['decription'],
		'empoyername'=>$_POST['name'],
		'empic'=>$_POST['empic'],
		'company'=>$_POST['company'],
		'date'=>$_POST['date'],
		'pid'=>$_POST['pid']
	);
	$post_job = Db::post_job($job_rec);
	if ($post_job) {
		echo "
		<script type='text/javascript'>
			$(document).ready(function(){
				swal('JOB POSTED', '', 'success');
				$('#POST')[0].reset();
			})
		</script>";
	}
}

?>
<?php 
if (isset($_POST['jobid'])) {
	$job_id = $_POST['jobid'];
	$deleted = Db::delete_job($job_id);	
	if ($deleted) {
		
	}
}
?>
<?php 
if (isset($_POST['job-update'])) {
	@$id = $_POST['pid'];
	$job_update_rec = array(
		'title'=>$_POST['jtitle'],
		'company'=>$_POST['company'],
		'type'=>$_POST['type'],
		'salary'=>$_POST['salary'],
		'province'=>$_POST['province'],
		'city'=>$_POST['city'],
		'description'=>$_POST['description'],
		'ujid'=>$_POST['id']
	);
	$updated = Db::update_job($job_update_rec);
	if ($updated) {
		echo "
		<script type='text/javascript'>
			$(document).ready(function(){
				swal('UPDATED', '', 'success');
				setInterval(function(){
					window.location.replace('posted-jobs.php?id=$id');	
				},1000);
			})
		</script>";
	}
}
?>
<?php 
if (isset($_POST['apname'])) {
	$apply_rec = array(
		'apname'=>$_POST['apname'],
		'apemail'=>$_POST['apemail'],
		'apphone'=>$_POST['apphone'],
		'apjob'=>$_POST['apjob'],
		'em_id'=>$_POST['em_id'],
		'apuid'=>$_POST['apuid']
	);
	$apply = Db::apply_4_job($apply_rec);
	if ($apply) {
		echo "
			<script>
					$(document).ready(function(){
						swal('APPLICATION DONE', '', 'success');
						setInterval(function(){
							window.location.replace('index.php');	
						},1000);
					})
			</script>";
	}
}
?>
<?php 
if (isset($_POST['apid'])) {
	$apid = $_POST['apid'];
	$delete = Db::delete_application($apid);
}
?>
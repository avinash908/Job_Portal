<?php 
include '../Db.php';
session_start();
if (!isset($_SESSION['admin-id'])) {
  header("location:login.php");
}
?>
<?php 
if (isset($_POST['delete'])) {
	$job_id = $_POST['jid'];
	$deleted = Db::delete_job($job_id);
	if ($deleted) {
		header("location:jobs.php");
	}
}
?>
<?php 
if (isset($_POST['catgry'])) {
	$value = $_POST['catgry'];
	$added = Db::add_category($value);
	if ($added) {
		echo "<div id='alert-box'><p class='alert alert-success'>INSERTED</p></div>";
		echo "<script>
			  	$(document).ready(function(){
			  		setTimeout(function(){
              			$('#alert-box').fadeOut('slow');
					}, 1500)
              	})
              </script>";
?>
<h4><b>Categories</b></h4>
<ul style="list-style-type:circle">          
<?php
  $categories = Db::categories();
  while ($ctgry = $categories->fetch_object())
  echo "<li>".$ctgry->category. ", &nbsp; </li>";
   ?>
</ul>
<?php }
}?>
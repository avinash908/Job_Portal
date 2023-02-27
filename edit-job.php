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
	<title></title>
	<?php 
		require 'links.php';
	?>
	<script type="text/javascript">
	    $(window).on('load',function(){
	        $('#myModal').modal('show');
	    });
	</script>
</head>
<body>
  <?php
   $result = Db::edit_job($_GET['id']);
   if ($jb = $result->fetch_object()) {
   ?>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
 <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
     <?php echo "<a href='posted-jobs.php?id=".$jb->pid."' class='btn btn-default' style='float:right'> &times; </a>" ?>
       
      <h4 class="modal-title"><b>Edit :</b> Job Details</h4>
    </div>
    <form action="action.php" method="post" class="form-group">
    <div class="modal-body">
      
        <div class="col-md-8">
          <label>Job title :</label>
          <input type="text" name="jtitle" class="form-control"
          <?php echo "value='".$jb->title."'"; ?>>
        </div>
        <div class="col-md-4">
          <label>Type :</label>
          <select  name="type" class="form-control">
          <?php echo "<option value='".$jb->type."'>".$jb->type."</option>"; ?>
            <option value="Full Time">Full Time</option>
            <option value="Part Time">Part Time</option>
            <option value="Contract">Contract Based</option>
            <option value="Internship">Internship</option>
            <option value="Commission">Commission</option>
          </select>
        </div>
        <div class="col-md-6">
        <label>Company :</label>
        <input type="text" name="company" class='form-control'
        <?php echo "value='".$jb->company."'"; ?>>
        </div>
        <div class="col-md-6">
           <label>Salary :</label>
          <input type="text" name="salary" class="form-control"
          <?php echo "value='".$jb->salary."'"; ?>> 
        </div>
        <div class="col-md-6">
          <label>Province :</label>
          <select id="province" name="province" class="form-control">
              <?php
               echo "<option value='".$jb->province."'>".$jb->province."</option>";
               $province = Db::province();
                while ($provin = $province->fetch_object()) {
                  echo "<option value='".$provin->province."'>".$provin->province."</option>";
                }
              ?>
          </select>
        </div>
        <div class="col-md-6">
        <label>City :</label>
        <select id="city" name="city" class="form-control" required>
        <?php echo "<option value='".$jb->city."'>".$jb->city."</option>"; ?>
        </select>
        </div>
        <div class="col-md-12">
          <label>Description :</label>
          <textarea name="description" class="form-control"><?php echo$jb->descrimination?></textarea>
        </div>
        <input type="hidden" name="id"
        <?php echo "value='".$jb->id."'"; ?>>
        <input type="hidden" name="pid"
        <?php echo "value='".$jb->pid."'"; ?>>
    </div>
    <div class="modal-footer">
      <input type="submit" class="btn btn-success" name="job-update" style="margin: 10px; float: right;">
      </form>
    </div>
  </div>
  <script type="text/javascript">
          $(document).ready(function () {
            $("#province").change(function () {
              var pro_id = $("#province").val();
              $.ajax({
                url : "action.php",
                method : "POST",
                data : {
                  pro_id:pro_id,
                },
                success:function (data) {
                  $("#city").html(data);
                }
              })
            })
          })
        </script>
</div>
<?php }

else{
 header("location:index.php");
 } ?>
</body>
</html>
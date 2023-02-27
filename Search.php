<?php 
include 'Db.php';
session_start();
$id = $_SESSION['user-id'];
 $records = Db::user_rec($id);
if ($res = $records->fetch_object()) {} 
if (isset($_POST['search'])) {
	if($_POST['city'] == ' '){
	$search_rec = array(
    'title'=>$_POST['search'],
		'province'=>$_POST['province']
	);
	$search = Db::search_job($search_rec);
	echo "<h4 style='padding:20px' align='left'>Search Results :</h4>";
			while ($job = $search->fetch_object()) {
		?>
		<div class="col-sm-3">
		    <div class="well">
		    <p><b>POSTED : BY</b></p>
		     <p><?php echo "<a href='profile.php?id=".$job->pid."'>".$job->employername."</a>"; ?></p>
		     <?php

		     echo " <img src='".$job->pid."/".$job->employer_pic."' class='img-circle' height='55' width='55' alt='".$job->employername."'>";
		     ?>
		    </div>
		</div>
		<div class="col-sm-9">
			<div class="well job-card">
			  <h3><b></b><?php echo $job->title;?></h3>
			  <span><b>Type : </b><?php echo $job->type; ?></span>
			  <br>
			  <span><b>Company : </b><?php echo $job->company; ?></span>
			  <br>
			  <span><b>Location : </b><?php echo $job->province."/".$job->city; ?></span>
			  <br>
			  <p><b>Description : </b><?php echo $job->descrimination; ?></p>
             <hr color='grey'>
              <span><b>posted on : </b><?php echo $job->date_time; ?></span>
           <span><?php echo "<a  data-toggle = 'modal' data-target = '#myModal'  class='btn btn-success pull-right'>APPLY</a>"; ?></span>
           <p>&nbsp;</p>
            </div>
  <div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   <div class = "modal-dialog " style="text-align: left">
      <div class = "modal-content">  
         <div class = "modal-header">
            <button class="close" data-dismiss="modal" aria-hidden="true">&times;
            </button>
            <h4 class = "modal-title" id = "myModalLabel">
              Your Info :
            </h4>
         </div>
         <form action="#" method="post" id="applyform">
         <div class = "modal-body">
              <div class="row field">
                <div class="col-md-6">
              <?php echo "<input type='text' value='".$res->firstname." ".$res->lastname."' id='apname' name='apname' class='form-control' required>"; ?>
                </div>
                <div class="col-md-6">
              <?php echo "<input type='email' value='".$res->email."'  class='form-control' id='apemail' name='apemail' required>"; ?>
                </div>
              </div>
              <div class="row field">
                <div class="col-md-6">
              <?php echo "<input type='text' value='".$res->phone_num."'  class='form-control' id='apphone' name='apphone' required>"; ?>
                </div>
                <div class="col-md-6">
              <?php echo "<input type='hidden' id='em_id' name='em_id' value='".$job->pid."'  class='form-control'>"; ?>
              <?php echo "<input type='hidden' id='apjob' name='apjob' value='".$job->title."'  class='form-control'>"; ?>
              <?php echo "<input type='hidden' id='apuid' name='apuid' value='".$res->uid."'  class='form-control'>"; ?>
                <input type="submit" value=" GO " class="btn btn-success" style="float: right;"> 
                </div>
              </div>
              <div class="row field">
                <div class="col-md-12">
                </div>
              </div>
         </div> 
         <div class = "modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
               Close
          </button> 
            
        </form>
         </div> 
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog --> 
</div>
<script type="text/javascript">
  $(document).ready(function (e) {
    $("#applyform").on('submit',function (e) {
      e.preventDefault();
      $.ajax({
        url:'action.php',
        method:'POST',
        data: new FormData(this),
        processData: false,
        cache:false,
        contentType:false,
        success:function (data) {
          $("#msg").html(data);
        }
      })
    })
  })
    // var $div = $(this).closest(".field");
    // var jid = $div.find(".jid").val();
</script>
			</div>
		</div>
	<?php } ?>
	<?php }
  else{
	$search_rec = array(
    'title'=>$_POST['search'],
    'province'=>$_POST['province'],
    'city'=>$_POST['city']);
	$search = Db::search_job_with_city($search_rec);
	echo "<h4 style='padding:20px' align='left'>Search Results :</h4>";
	while ($job = $search->fetch_object()) { ?>
<div class="col-sm-3">
    <div class="well">
    <p><b>POSTED : BY</b></p>
     <p><?php echo "<a href='profile.php?id=".$job->pid."'>".$job->employername."</a>"; ?></p>
     <?php

     echo " <img src='".$job->pid."/".$job->employer_pic."' class='img-circle' height='55' width='55' alt='".$job->employername."'>";
     ?>
    </div>
</div>
<div class="col-sm-9">
	<div class="well job-card">
	  <h3><b></b><?php echo $job->title;?></h3>
	  <span><b>Type : </b><?php echo $job->type; ?></span>
	  <br>
	  <span><b>Company : </b><?php echo $job->company; ?></span>
	  <br>
	  <span><b>Location : </b><?php echo $job->province."/".$job->city; ?></span>
	  <br>
	  <p><b>Description : </b><?php echo $job->descrimination; ?></p>
       <hr color='grey'>
       <span><b>posted on : </b><?php echo $job->date_time; ?></span>
       <span><?php echo "<a  data-toggle = 'modal' data-target = '#myModal'  class='btn btn-success pull-right'>APPLY</a>"; ?></span>
        <p>&nbsp;</p>
            </div>
  <div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   <div class = "modal-dialog " style="text-align: left">
      <div class = "modal-content">  
         <div class = "modal-header">
            <button class="close" data-dismiss="modal" aria-hidden="true">&times;
            </button>
            <h4 class = "modal-title" id = "myModalLabel">
              Your Info :
            </h4>
         </div>
         <form action="#" method="post" id="applyform">
         <div class = "modal-body">
              <div class="row field">
                <div class="col-md-6">
              <?php echo "<input type='text' value='".$res->firstname." ".$res->lastname."' id='apname' name='apname' class='form-control' required>"; ?>
                </div>
                <div class="col-md-6">
              <?php echo "<input type='email' value='".$res->email."'  class='form-control' id='apemail' name='apemail' required>"; ?>
                </div>
              </div>
              <div class="row field">
                <div class="col-md-6">
              <?php echo "<input type='text' value='".$res->phone_num."'  class='form-control' id='apphone' name='apphone' required>"; ?>
                </div>
                <div class="col-md-6">
              <?php echo "<input type='hidden' id='em_id' name='em_id' value='".$job->pid."'  class='form-control'>"; ?>
              <?php echo "<input type='hidden' id='apjob' name='apjob' value='".$job->title."'  class='form-control'>"; ?>
              <?php echo "<input type='hidden' id='apuid' name='apuid' value='".$res->uid."'  class='form-control'>"; ?>
                <input type="submit" value=" GO " class="btn btn-success" style="float: right;"> 
                </div>
              </div>
              <div class="row field">
                <div class="col-md-12">
                </div>
              </div>
         </div> 
         <div class = "modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
               Close
          </button> 
            
        </form>
         </div> 
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog --> 
</div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function (e) {
    $("#applyform").on('submit',function (e) {
      e.preventDefault();
      $.ajax({
        url:'action.php',
        method:'POST',
        data: new FormData(this),
        processData: false,
        cache:false,
        contentType:false,
        success:function (data) {
          $("#msg").html(data);
        }
      })
    })
  })
    // var $div = $(this).closest(".field");
    // var jid = $div.find(".jid").val();
</script>
		<?php } ?>
	<?php } ?>
<?php } ?>